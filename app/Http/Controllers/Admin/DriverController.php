<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $query = Driver::with('vehicle')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('license_type')) {
            $query->where('license_type', $request->license_type);
        }

        if ($request->filled('compliance')) {
            $now = now();
            $soon = now()->addDays(30);
            match ($request->compliance) {
                'expired'       => $query->where(function ($q) use ($now) {
                    $q->where('license_expiry', '<', $now)
                      ->orWhere('medical_card_expiry', '<', $now);
                }),
                'expiring_soon' => $query->where(function ($q) use ($now, $soon) {
                    $q->whereBetween('license_expiry', [$now, $soon])
                      ->orWhereBetween('medical_card_expiry', [$now, $soon]);
                }),
                default         => null,
            };
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('license_number', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $drivers = $query->paginate(15)->withQueryString();

        $counts = [
            'all'           => Driver::count(),
            'active'        => Driver::where('status', 'Active')->count(),
            'inactive'      => Driver::where('status', 'Inactive')->count(),
            'suspended'     => Driver::where('status', 'Suspended')->count(),
            'expired'       => Driver::where('license_expiry', '<', now())
                                     ->orWhere('medical_card_expiry', '<', now())->count(),
            'expiring_soon' => Driver::whereBetween('license_expiry', [now(), now()->addDays(30)])
                                     ->orWhereBetween('medical_card_expiry', [now(), now()->addDays(30)])->count(),
        ];

        return view('admin.drivers.index', compact('drivers', 'counts'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'Active')->orderBy('name')->get();
        return view('admin.drivers.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'email'                => 'nullable|email|unique:drivers,email',
            'phone'                => 'nullable|string|max:50',
            'photo'                => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'license_number'       => 'required|string|max:100|unique:drivers,license_number',
            'license_type'         => 'required|in:Class A CDL,Class B CDL,Class C CDL,Non-CDL',
            'license_expiry'       => 'required|date',
            'cdl_certifications'   => 'nullable|array',
            'cdl_certifications.*' => 'in:Hazmat,Passenger,Tank Vehicle,School Bus,Doubles/Triples,Air Brakes',
            'medical_card_number'  => 'nullable|string|max:100',
            'medical_card_expiry'  => 'nullable|date',
            'vehicle_id'           => 'nullable|exists:vehicles,id',
            'status'               => 'required|in:Active,Inactive,Suspended',
            'notes'                => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $this->ensureDir('uploads/drivers');
            $file = $request->file('photo');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers'), $filename);
            $data['photo'] = asset('uploads/drivers/' . $filename);
        }

        Driver::create($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver profile created successfully.');
    }

    public function show(Driver $driver)
    {
        $driver->load('vehicle');
        return view('admin.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $vehicles = Vehicle::where('status', 'Active')->orderBy('name')->get();
        return view('admin.drivers.edit', compact('driver', 'vehicles'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'email'                => 'nullable|email|unique:drivers,email,' . $driver->id,
            'phone'                => 'nullable|string|max:50',
            'photo'                => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'license_number'       => 'required|string|max:100|unique:drivers,license_number,' . $driver->id,
            'license_type'         => 'required|in:Class A CDL,Class B CDL,Class C CDL,Non-CDL',
            'license_expiry'       => 'required|date',
            'cdl_certifications'   => 'nullable|array',
            'cdl_certifications.*' => 'in:Hazmat,Passenger,Tank Vehicle,School Bus,Doubles/Triples,Air Brakes',
            'medical_card_number'  => 'nullable|string|max:100',
            'medical_card_expiry'  => 'nullable|date',
            'vehicle_id'           => 'nullable|exists:vehicles,id',
            'status'               => 'required|in:Active,Inactive,Suspended',
            'notes'                => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($driver->photo) {
                $path = parse_url($driver->photo, PHP_URL_PATH);
                $old  = public_path(ltrim($path, '/'));
                if (file_exists($old)) @unlink($old);
            }
            $this->ensureDir('uploads/drivers');
            $file = $request->file('photo');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers'), $filename);
            $data['photo'] = asset('uploads/drivers/' . $filename);
        } else {
            unset($data['photo']);
        }

        $driver->update($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver profile updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->photo) {
            $path = parse_url($driver->photo, PHP_URL_PATH);
            $old  = public_path(ltrim($path, '/'));
            if (file_exists($old)) @unlink($old);
        }
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Driver profile deleted.');
    }

    private function ensureDir(string $relativePath): void
    {
        $path = public_path($relativePath);
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }
}
