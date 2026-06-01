<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a paginated list of all customers.
     */
    public function index(Request $request)
    {
        $query = Customer::withCount('rideBookings')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name',  'like', "%{$search}%")
                  ->orWhere('email',      'like', "%{$search}%")
                  ->orWhere('phone',      'like', "%{$search}%");
            });
        }

        $customers = $query->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show a single customer profile with booking history.
     */
    public function show(Customer $customer)
    {
        $customer->load(['rideBookings' => function ($q) {
            $q->latest();
        }]);

        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Delete a customer and all their bookings (cascade).
     */
    public function destroy(Customer $customer)
    {
        $name = $customer->full_name;
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', "Customer \"{$name}\" and all their bookings have been removed.");
    }
}
