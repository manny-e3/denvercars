<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/fleet', function () {
    return view('fleet');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact/submit', function (Request $request) {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'message' => 'required|string',
    ]);
    return redirect('/contact')->with('success', 'Thank you, ' . e($request->name) . '! Your inquiry has been received. Our concierge team will contact you within 2 hours.');
});

// Chauffeur Search & Booking Flow routes
Route::get('/search-results', [BookingController::class, 'search']);
Route::get('/checkout', [BookingController::class, 'checkout']);
Route::post('/checkout/store', [BookingController::class, 'store']);
Route::get('/trips', [BookingController::class, 'trips']);
Route::post('/trips/cancel/{index}', [BookingController::class, 'cancel']);

