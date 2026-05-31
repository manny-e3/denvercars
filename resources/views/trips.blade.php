@extends('layouts.app')

@section('title', 'Trip Management | Denver Elite')

@section('content')
<div class="w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-unit-xl grid grid-cols-1 md:grid-cols-12 gap-gutter">
    
    <!-- Sidebar Navigation -->
    <aside class="md:col-span-3 space-y-unit-lg mb-unit-xl md:mb-0">
        <div class="bg-surface p-unit-lg rounded-xl border border-outline/20 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.4)]">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-unit-md">Account</h2>
            <nav class="flex flex-col space-y-unit-sm">
                <a class="font-body-md text-body-md text-primary font-semibold flex items-center p-unit-sm rounded-md bg-surface-container transition-colors" href="#">
                    <span class="material-symbols-outlined mr-unit-sm">dashboard</span>
                    Dashboard
                </a>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary flex items-center p-unit-sm rounded-md hover:bg-surface-container transition-colors" href="#">
                    <span class="material-symbols-outlined mr-unit-sm">person</span>
                    My Profile
                </a>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary flex items-center p-unit-sm rounded-md hover:bg-surface-container transition-colors" href="#">
                    <span class="material-symbols-outlined mr-unit-sm">credit_card</span>
                    Payment Methods
                </a>
                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary flex items-center p-unit-sm rounded-md hover:bg-surface-container transition-colors" href="#">
                    <span class="material-symbols-outlined mr-unit-sm">location_on</span>
                    Saved Locations
                </a>
            </nav>
        </div>
    </aside>
    
    <!-- Dashboard Canvas -->
    <section class="md:col-span-9 space-y-unit-xl">
        <!-- Welcome Header -->
        <header>
            <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-unit-sm">Welcome Back, Alexander</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Manage your reservations and executive travel details.</p>
        </header>
        
        @if(session('success'))
            <div class="p-4 bg-primary/10 border border-primary text-primary rounded font-semibold text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Account Overview Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <div class="bg-surface p-unit-lg rounded-xl border border-outline/20 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.4)] flex items-center justify-between relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div>
                    <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-unit-xs">Total Rides</p>
                    <p class="font-headline-lg text-headline-lg text-on-surface">{{ 42 + count($trips) - 1 }}</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-surface-variant">directions_car</span>
            </div>
            <div class="bg-surface p-unit-lg rounded-xl border border-outline/20 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.4)] flex items-center justify-between relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent pointer-events-none opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div>
                    <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-unit-xs">Loyalty Points</p>
                    <p class="font-headline-lg text-headline-lg text-on-surface">12,500</p>
                </div>
                <span class="material-symbols-outlined text-4xl text-primary/50">workspace_premium</span>
            </div>
        </div>
        
        <!-- Upcoming Trips -->
        <div>
            <div class="flex items-center justify-between mb-unit-md border-b border-outline/20 pb-unit-sm">
                <h2 class="font-headline-md text-headline-md text-on-surface">Upcoming Trips</h2>
            </div>
            
            <div class="space-y-unit-md">
                @forelse($trips as $index => $trip)
                    <!-- Trip Card -->
                    <div class="bg-surface p-unit-md md:p-unit-lg rounded-xl border border-outline/20 flex flex-col md:flex-row justify-between items-start md:items-center gap-unit-md hover:border-primary/50 transition-colors duration-300">
                        <div class="flex-grow space-y-unit-sm w-full">
                            <div class="flex justify-between items-center w-full">
                                <span class="font-label-sm text-label-sm text-primary bg-primary/10 px-2 py-1 rounded">ID: {{ $trip['id'] }}</span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant flex items-center">
                                    <span class="material-symbols-outlined text-sm mr-1">event</span> 
                                    {{ \Carbon\Carbon::parse($trip['date'])->format('M d, Y') }}
                                </span>
                            </div>
                            <div class="flex flex-col md:flex-row gap-unit-sm md:gap-gutter mt-unit-sm">
                                <div class="flex items-start">
                                    <span class="material-symbols-outlined text-primary mt-1 mr-2">flight_land</span>
                                    <div>
                                        <p class="font-label-sm text-label-sm text-on-surface-variant">Pickup</p>
                                        <p class="font-body-md text-body-md text-on-surface font-medium">{{ $trip['pickup'] }}</p>
                                        <p class="font-body-md text-body-md text-on-surface-variant">{{ $trip['time'] }}</p>
                                    </div>
                                </div>
                                <div class="hidden md:flex items-center px-unit-sm text-outline">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="material-symbols-outlined text-on-surface-variant mt-1 mr-2">business</span>
                                    <div>
                                        <p class="font-label-sm text-label-sm text-on-surface-variant">Dropoff</p>
                                        <p class="font-body-md text-body-md text-on-surface font-medium">{{ $trip['dropoff'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-unit-xs flex items-center">
                                <span class="font-body-md text-body-md text-on-surface-variant flex items-center">
                                    <span class="material-symbols-outlined text-sm mr-2 text-primary">airport_shuttle</span> 
                                    {{ $trip['vehicle'] }}
                                </span>
                            </div>
                        </div>
                        <div class="flex md:flex-col gap-unit-sm w-full md:w-auto mt-unit-md md:mt-0">
                            <!-- Modify Trigger -->
                            <button onclick="alert('To modify your booking details, please call our Concierge directly at +1 (303) 555-0199.')" class="flex-1 md:flex-none font-label-lg text-label-lg bg-primary text-on-primary py-3 px-6 rounded-md hover:bg-primary-fixed-dim transition-colors text-center shadow-[0_4px_14px_0_rgba(197,160,89,0.39)]">
                                Modify
                            </button>
                            <!-- Cancel Form -->
                            <form action="/trips/cancel/{{ $index }}" method="POST" class="flex-1 md:flex-none">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to cancel this booking?')" class="w-full font-label-lg text-label-lg border border-outline/50 text-on-surface py-3 px-6 rounded-md hover:bg-surface-variant transition-colors text-center">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-surface p-unit-lg rounded-xl border border-outline/20 text-center">
                        <p class="font-body-lg text-body-lg text-on-surface-variant">No upcoming reservations found.</p>
                        <a href="/" class="inline-block mt-4 bg-primary text-on-primary px-6 py-2 rounded font-label-lg text-label-lg">Book a Ride</a>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Past Trips -->
        <div>
            <div class="flex items-center justify-between mb-unit-md border-b border-outline/20 pb-unit-sm mt-unit-xl">
                <h2 class="font-headline-md text-headline-md text-on-surface">Past Trips</h2>
            </div>
            <div class="bg-surface rounded-xl border border-outline/20 overflow-hidden">
                <!-- List Header (Desktop) -->
                <div class="hidden md:grid grid-cols-4 gap-4 p-unit-md bg-surface-container-low border-b border-outline/10 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">
                    <div>Date</div>
                    <div class="col-span-2">Route</div>
                    <div class="text-right">Action</div>
                </div>
                <!-- Past Trip Item 1 -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-unit-md border-b border-outline/10 items-center hover:bg-surface-container transition-colors">
                    <div class="font-body-md text-body-md text-on-surface">Sep 12, 2024</div>
                    <div class="col-span-2 font-body-md text-body-md text-on-surface-variant flex items-center">
                        Downtown Office <span class="material-symbols-outlined text-xs mx-2 text-outline">arrow_forward</span> Cherry Creek
                    </div>
                    <div class="md:text-right mt-2 md:mt-0">
                        <a href="#" onclick="alert('Downloading Receipt...')" class="font-label-sm text-label-sm text-primary hover:text-primary-fixed flex items-center md:justify-end w-full md:w-auto transition-colors">
                            <span class="material-symbols-outlined text-sm mr-1">download</span> Receipt
                        </a>
                    </div>
                </div>
                <!-- Past Trip Item 2 -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-unit-md items-center hover:bg-surface-container transition-colors">
                    <div class="font-body-md text-body-md text-on-surface">Aug 28, 2024</div>
                    <div class="col-span-2 font-body-md text-body-md text-on-surface-variant flex items-center">
                        DEN Airport <span class="material-symbols-outlined text-xs mx-2 text-outline">arrow_forward</span> Vail Resorts
                    </div>
                    <div class="md:text-right mt-2 md:mt-0">
                        <a href="#" onclick="alert('Downloading Receipt...')" class="font-label-sm text-label-sm text-primary hover:text-primary-fixed flex items-center md:justify-end w-full md:w-auto transition-colors">
                            <span class="material-symbols-outlined text-sm mr-1">download</span> Receipt
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
