@extends('layouts.app')

@section('title', 'Secure Checkout | Denver Elite')

@section('content')
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
    
    <!-- Progress Indicator -->
    <div class="max-w-3xl mx-auto mb-12">
        <div class="flex items-center justify-between text-xs md:text-sm uppercase tracking-widest font-semibold font-body-sm">
            <span class="text-primary flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-primary/20 border border-primary text-primary">1</span> Select Vehicle</span>
            <span class="w-12 md:w-24 h-[1px] bg-primary"></span>
            <span class="text-primary flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-primary/20 border border-primary text-primary">2</span> Checkout</span>
            <span class="w-12 md:w-24 h-[1px] bg-outline/25"></span>
            <span class="text-on-surface-variant/50 flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-surface-container border border-outline/10 text-on-surface-variant/50">3</span> Confirmation</span>
        </div>
    </div>

    <!-- 2-Column Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
        
        <!-- Left: Forms -->
        <div class="lg:col-span-8 space-y-8">
            <form action="/checkout/store" method="POST" class="space-y-8">
                @csrf
                
                <!-- Hidden fields to pass booking criteria -->
                <input type="hidden" name="vehicle" value="{{ $vehicle['name'] }}">
                <input type="hidden" name="pickup" value="{{ $search['pickup'] }}">
                <input type="hidden" name="dropoff" value="{{ $search['dropoff'] ?? '' }}">
                <input type="hidden" name="date" value="{{ $search['date'] }}">
                <input type="hidden" name="time" value="{{ $search['time'] }}">
                <input type="hidden" name="passengers" value="{{ $search['passengers'] }}">
                <input type="hidden" name="luggage" value="{{ $search['luggage'] }}">
                <input type="hidden" name="service_type" value="{{ $search['service_type'] }}">
                <input type="hidden" name="duration" value="{{ $search['duration'] ?? '' }}">
                <input type="hidden" name="total" value="{{ $total }}">

                <!-- 1. Passenger Details -->
                <div class="bg-surface-container p-6 rounded-xl border border-outline/15 shadow-md space-y-6">
                    <h2 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-[24px]">person</span>
                        Passenger Information
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="first_name">First Name</label>
                            <input class="w-full luxury-input px-4 py-3 text-on-surface" type="text" id="first_name" name="first_name" required value="Alexander"/>
                        </div>
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="last_name">Last Name</label>
                            <input class="w-full luxury-input px-4 py-3 text-on-surface" type="text" id="last_name" name="last_name" required value="Hamilton"/>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="email">Email Address</label>
                            <input class="w-full luxury-input px-4 py-3 text-on-surface" type="email" id="email" name="email" required value="alexander@hamilton.com"/>
                        </div>
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="phone">Phone Number</label>
                            <input class="w-full luxury-input px-4 py-3 text-on-surface" type="tel" id="phone" name="phone" required value="+1 (303) 555-0100"/>
                        </div>
                    </div>
                </div>

                <!-- 2. Flight Tracking / Additional Notes -->
                <div class="bg-surface-container p-6 rounded-xl border border-outline/15 shadow-md space-y-6">
                    <h2 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-[24px]">flight</span>
                        Flight Tracking &amp; Notes
                    </h2>
                    
                    @if($search['service_type'] === 'airport')
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="flight_number">Airline &amp; Flight Number (Optional)</label>
                            <input class="w-full luxury-input px-4 py-3 text-on-surface placeholder:text-on-surface-variant/30" type="text" id="flight_number" name="flight_number" placeholder="e.g. United Airlines UA1234"/>
                            <p class="font-body-sm text-body-sm text-on-surface-variant opacity-60 mt-1">We track flights dynamically to align chauffeur arrival with landing.</p>
                        </div>
                    @endif
                    
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="notes">Special Instructions (Optional)</label>
                        <textarea class="w-full luxury-input px-4 py-3 text-on-surface placeholder:text-on-surface-variant/30 resize-none" id="notes" name="notes" placeholder="Child seat specifications, gate codes, or luggage requests" rows="3"></textarea>
                    </div>
                </div>

                <!-- 3. Billing details -->
                <div class="bg-surface-container p-6 rounded-xl border border-outline/15 shadow-md space-y-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined text-[24px]">credit_card</span>
                            Secure Payment Information
                        </h2>
                        <span class="material-symbols-outlined text-primary text-xl" title="SSL Secure 256-bit encryption">lock</span>
                    </div>

                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="card_name">Cardholder Name</label>
                        <input class="w-full luxury-input px-4 py-3 text-on-surface" type="text" id="card_name" name="card_name" required value="Alexander Hamilton"/>
                    </div>
                    
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="card_number">Credit Card Number</label>
                        <div class="relative">
                            <input class="w-full luxury-input pl-4 pr-12 py-3 text-on-surface font-mono" type="text" id="card_number" name="card_number" required placeholder="•••• •••• •••• ••••" value="4111 1111 1111 1111"/>
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant">credit_card</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="card_expiry">Expiration Date</label>
                            <input class="w-full luxury-input px-4 py-3 text-on-surface" type="text" id="card_expiry" name="card_expiry" required placeholder="MM/YY" value="12/28"/>
                        </div>
                        <div>
                            <label class="block font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-2" for="card_cvv">CVV</label>
                            <input class="w-full luxury-input px-4 py-3 text-on-surface" type="password" id="card_cvv" name="card_cvv" required placeholder="•••" value="123"/>
                        </div>
                    </div>
                </div>

                <!-- Secure Confirmation -->
                <div class="pt-4 flex flex-col items-center gap-3">
                    <button type="submit" class="w-full bg-primary text-on-primary font-label-lg text-label-lg py-4 rounded-md hover:bg-primary-fixed transition-all duration-300 shadow-[0_4px_20px_rgba(197,160,89,0.4)] flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">verified_user</span>
                        Confirm Secure Booking
                    </button>
                    <p class="font-body-sm text-body-sm text-on-surface-variant opacity-60 text-center flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        Your details are encrypted and protected by industry-standard SSL protocols.
                    </p>
                </div>
            </form>
        </div>

        <!-- Right: Order Summary Sidebar -->
        <aside class="lg:col-span-4 bg-surface p-6 rounded-xl border border-outline/20 shadow-lg space-y-6">
            <h2 class="font-headline-md text-headline-md text-white border-b border-outline/10 pb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">assignment</span>
                Booking Summary
            </h2>
            
            <!-- Vehicle Highlight -->
            <div class="flex items-center gap-4 border-b border-outline/10 pb-4">
                <div class="w-20 h-16 rounded overflow-hidden flex-shrink-0 bg-surface-container border border-outline/10">
                    <img class="w-full h-full object-cover" src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}"/>
                </div>
                <div>
                    <h3 class="font-body-md text-body-md text-white font-semibold">{{ $vehicle['name'] }}</h3>
                    <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider">{{ $vehicle['class'] }}</p>
                </div>
            </div>

            <!-- Route Details -->
            <div class="space-y-4 border-b border-outline/10 pb-4 text-body-md">
                <div class="flex gap-3">
                    <span class="material-symbols-outlined text-primary text-xl">event</span>
                    <div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Date &amp; Time</p>
                        <p class="font-body-md text-body-md text-white">{{ \Carbon\Carbon::parse($search['date'])->format('M d, Y') }} at {{ $search['time'] }}</p>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <span class="material-symbols-outlined text-primary text-xl">my_location</span>
                    <div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Pickup</p>
                        <p class="font-body-md text-body-md text-white">{{ $search['pickup'] }}</p>
                    </div>
                </div>

                @if($search['service_type'] === 'airport')
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">location_on</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Dropoff</p>
                            <p class="font-body-md text-body-md text-white">{{ $search['dropoff'] }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">schedule</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Duration</p>
                            <p class="font-body-md text-body-md text-white">{{ $search['duration'] }} Hours (As-Directed)</p>
                        </div>
                    </div>
                @endif
                
                <div class="flex gap-3">
                    <span class="material-symbols-outlined text-primary text-xl">group</span>
                    <div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Travelers</p>
                        <p class="font-body-md text-body-md text-white">{{ $search['passengers'] }} passengers, {{ $search['luggage'] }} bags</p>
                    </div>
                </div>
            </div>

            <!-- Cost Breakdown -->
            <div class="space-y-3 font-body-md">
                @php
                    $rate = $search['service_type'] === 'airport' ? $vehicle['airport_rate'] : ($vehicle['hourly_rate'] * $search['duration']);
                    $tax = $rate * 0.0825;
                    $fee = 15.00;
                @endphp
                <div class="flex justify-between text-on-surface-variant">
                    <span>Base Ride Fare</span>
                    <span class="text-white">${{ number_format($rate, 2) }}</span>
                </div>
                <div class="flex justify-between text-on-surface-variant">
                    <span>Local Taxes (8.25%)</span>
                    <span class="text-white">${{ number_format($tax, 2) }}</span>
                </div>
                <div class="flex justify-between text-on-surface-variant font-body-sm">
                    <span>Airport Gate / Admin Fee</span>
                    <span class="text-white">${{ number_format($fee, 2) }}</span>
                </div>
                
                <div class="flex justify-between border-t border-outline/20 pt-4 font-headline-md text-headline-md">
                    <span class="text-white font-semibold">Total Cost</span>
                    <span class="text-primary font-bold">${{ number_format($total, 2) }}</span>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
