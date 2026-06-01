<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Display the welcome page with a selection of vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::where('status', 'Active')->take(3)->get();

        return view('welcome', compact('vehicles'));
    }
}
