<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|in:Sedan,SUV,Van,Limousine',
            'description' => 'required|string',
            'passengers' => 'required|integer|min:1',
            'luggage' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'airport_rate' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|string|in:Active,Maintenance,Retired',
        ]);

        $data['key'] = Str::slug($data['name']);
        
        // Ensure key is unique
        $count = Vehicle::where('key', 'like', $data['key'] . '%')->count();
        if ($count > 0) {
            $data['key'] = $data['key'] . '-' . ($count + 1);
        }

        if ($request->hasFile('image')) {
            if (!file_exists(public_path('uploads/vehicles'))) {
                mkdir(public_path('uploads/vehicles'), 0755, true);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/vehicles'), $filename);
            $data['image'] = asset('uploads/vehicles/' . $filename);
        } else {
            $data['image'] = null;
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|in:Sedan,SUV,Van,Limousine',
            'description' => 'required|string',
            'passengers' => 'required|integer|min:1',
            'luggage' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'airport_rate' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|string|in:Active,Maintenance,Retired',
        ]);

        if ($request->hasFile('image')) {
            // Delete old file if it exists and is local
            if ($vehicle->image) {
                $path = parse_url($vehicle->image, PHP_URL_PATH);
                $oldPath = public_path(ltrim($path, '/'));
                if (file_exists($oldPath) && is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            if (!file_exists(public_path('uploads/vehicles'))) {
                mkdir(public_path('uploads/vehicles'), 0755, true);
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/vehicles'), $filename);
            $data['image'] = asset('uploads/vehicles/' . $filename);
        } else {
            // Keep the old image
            unset($data['image']);
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
