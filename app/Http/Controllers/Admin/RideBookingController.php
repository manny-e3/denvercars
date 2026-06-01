<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RideBooking;
use Illuminate\Http\Request;

class RideBookingController extends Controller
{
    /**
     * Display paginated list of all ride bookings.
     */
    public function index(Request $request)
    {
        $query = RideBooking::with('customer', 'vehicle')->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by service type
        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        // Search by reference, customer name, pickup, dropoff
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                  ->orWhere('pickup', 'like', "%{$search}%")
                  ->orWhere('dropoff', 'like', "%{$search}%")
                  ->orWhereHas('customer', function ($cq) use ($search) {
                      $cq->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name',  'like', "%{$search}%")
                         ->orWhere('email',      'like', "%{$search}%");
                  });
            });
        }

        $rides   = $query->paginate(15)->withQueryString();
        $counts  = [
            'all'       => RideBooking::count(),
            'pending'   => RideBooking::where('status', 'pending')->count(),
            'confirmed' => RideBooking::where('status', 'confirmed')->count(),
            'completed' => RideBooking::where('status', 'completed')->count(),
            'cancelled' => RideBooking::where('status', 'cancelled')->count(),
        ];

        return view('admin.rides.index', compact('rides', 'counts'));
    }

    /**
     * Show detail for a single ride booking.
     */
    public function show(RideBooking $ride)
    {
        $ride->load('customer', 'vehicle');
        return view('admin.rides.show', compact('ride'));
    }

    /**
     * Update the status of a ride.
     */
    public function updateStatus(Request $request, RideBooking $ride)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $ride->update(['status' => $request->status]);

        return back()->with('success', "Ride #{$ride->reference} status updated to " . ucfirst($request->status) . '.');
    }

    /**
     * Delete a ride booking.
     */
    public function destroy(RideBooking $ride)
    {
        $ref = $ride->reference;
        $ride->delete();
        return redirect()->route('admin.rides.index')->with('success', "Ride {$ref} has been deleted.");
    }
}
