@extends('layouts.app')

@section('title', 'Available Vehicles | Denver Limo Cars')

@section('content')
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
    
    <!-- Progress Indicator -->
    <div class="max-w-3xl mx-auto mb-12">
        <div class="flex items-center justify-between text-xs md:text-sm uppercase tracking-widest font-semibold font-body-sm">
            <span class="text-primary flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-primary/20 border border-primary text-primary">1</span> Select Vehicle</span>
            <span class="w-12 md:w-24 h-[1px] bg-outline/25"></span>
            <span class="text-on-surface-variant/50 flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-surface-container border border-outline/10 text-on-surface-variant/50">2</span> Checkout</span>
            <span class="w-12 md:w-24 h-[1px] bg-outline/25"></span>
            <span class="text-on-surface-variant/50 flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-surface-container border border-outline/10 text-on-surface-variant/50">3</span> Confirmation</span>
        </div>
    </div>

    <!-- Search Criteria Summary Header -->
    <div class="bg-surface-container p-6 rounded-xl border border-outline/15 shadow-md flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div class="space-y-2">
            <h1 class="font-headline-md text-headline-md text-white font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">directions_car</span>
                Available Vehicles
            </h1>
            <div class="flex flex-wrap gap-x-6 gap-y-1 text-on-surface-variant text-body-md font-body-md">
                <p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm text-primary">my_location</span> <span class="font-medium text-on-surface">Pickup:</span> {{ $search['pickup'] }}</p>
                @if($search['service_type'] === 'airport')
                    <p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm text-primary">location_on</span> <span class="font-medium text-on-surface">Dropoff:</span> {{ $search['dropoff'] }}</p>
                    @if(!empty($search['distance_miles']) && $search['distance_miles'] > 0)
                        <p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm text-primary">route</span> <span class="font-medium text-on-surface">Distance:</span> ~{{ number_format($search['distance_miles'], 1) }} miles</p>
                    @endif
                @else
                    <p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm text-primary">schedule</span> <span class="font-medium text-on-surface">Duration:</span> {{ $search['duration'] }} Hours</p>
                @endif
                <p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm text-primary">calendar_month</span> {{ \Carbon\Carbon::parse($search['date'])->format('M d, Y') }} at {{ $search['time'] }}</p>
                <p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm text-primary">group</span> {{ $search['passengers'] }} passenger(s)</p>
                <p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm text-primary">luggage</span> {{ $search['luggage'] }} bag(s)</p>
            </div>
        </div>
        <a href="/?pickup={{ urlencode($search['pickup']) }}&dropoff={{ urlencode($search['dropoff'] ?? '') }}&passengers={{ $search['passengers'] }}&luggage={{ $search['luggage'] }}&date={{ $search['date'] }}&time={{ $search['time'] }}" class="border border-primary text-primary px-5 py-3 rounded-md hover:bg-surface-variant text-label-lg font-label-lg transition-colors whitespace-nowrap">
            Modify Search
        </a>
    </div>

    <!-- Vehicles List -->
    <div class="space-y-8">
        @php $shownCount = 0; @endphp
        @foreach($vehicles as $vehicle)
            
            <!-- Vehicle Card -->
            <div class="bg-surface p-6 rounded-xl border {{ $vehicle['eligible'] ? 'border-outline/20 hover:border-primary/50' : 'border-outline/5 opacity-50' }} flex flex-col lg:flex-row justify-between items-stretch gap-6 transition-all duration-300">
                <!-- Vehicle Image -->
                <div class="lg:w-1/3 relative rounded-lg overflow-hidden h-48 lg:h-auto min-h-[180px]">
                    <img class="w-full h-full object-cover mix-blend-luminosity hover:mix-blend-normal transition-all duration-500" src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}"/>
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <!-- Vehicle Details -->
                <div class="lg:w-5/12 flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h2 class="font-headline-md text-headline-md text-white font-semibold">{{ $vehicle['name'] }}</h2>
                            <span class="font-label-sm text-label-sm text-primary bg-primary/10 px-2 py-0.5 rounded">{{ $vehicle['class'] }}</span>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ $vehicle['description'] }}</p>
                    </div>

                    <div class="flex gap-x-6 text-on-surface-variant text-label-sm font-label-sm flex-wrap gap-y-2">
                        <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">group</span> {{ $vehicle['passengers'] }} Max Passengers</span>
                        <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">work</span> {{ $vehicle['luggage'] }} Max Bags</span>
                        @if($search['service_type'] === 'hourly' && isset($vehicle['miles_allowed']))
                            <span class="flex items-center gap-1.5 text-primary"><span class="material-symbols-outlined text-[18px]">route</span> {{ $vehicle['miles_allowed'] }} Miles Included</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 text-on-surface-variant text-body-sm font-body-sm">
                        <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-sm">check_circle</span> Wi-Fi</span>
                        <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-sm">check_circle</span> Bottled Water</span>
                        <span class="flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-sm">check_circle</span> Real-time flight tracking</span>
                    </div>
                </div>

                <!-- Price & CTA -->
                <div class="lg:w-3/12 border-t lg:border-t-0 lg:border-l border-outline/10 pt-6 lg:pt-0 lg:pl-6 flex flex-col justify-between items-stretch lg:items-end text-left lg:text-right">
                    <div class="space-y-1">
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest">Estimated Total Fare</p>
                        <p class="font-headline-lg text-headline-lg text-primary font-bold">${{ number_format($vehicle['total_fare'], 2) }}</p>
                        <div class="font-body-sm text-body-sm text-on-surface-variant opacity-60 space-y-0.5 mt-1">
                            <p>${{ number_format($vehicle['base_rate'], 2) }} base fare</p>
                            @if($vehicle['luggage_surcharge'] > 0)
                                <p>+${{ number_format($vehicle['luggage_surcharge'], 2) }} luggage ({{ max(0, (int)($search['luggage'] ?? 0) - 2) }} extra bag{{ max(0, (int)($search['luggage'] ?? 0) - 2) > 1 ? 's' : '' }})</p>
                            @endif
                            @if($vehicle['passenger_surcharge'] > 0)
                                <p>+${{ number_format($vehicle['passenger_surcharge'], 2) }} extra passengers</p>
                            @endif
                            @if(isset($vehicle['peak_surcharge']) && $vehicle['peak_surcharge'] > 0)
                                <p class="text-primary font-medium">+${{ number_format($vehicle['peak_surcharge'], 2) }} peak surcharge</p>
                            @endif
                            <p>+${{ number_format($vehicle['gate_fee'], 2) }} gate fee</p>
                        </div>
                    </div>

                    @if($vehicle['eligible'])
                        @php $shownCount++; @endphp
                        <a href="/checkout?vehicle={{ $vehicle['key'] }}&pickup={{ urlencode($search['pickup']) }}&dropoff={{ urlencode($search['dropoff'] ?? '') }}&passengers={{ $search['passengers'] }}&luggage={{ $search['luggage'] }}&date={{ $search['date'] }}&time={{ $search['time'] }}&service_type={{ $search['service_type'] }}&duration={{ $search['duration'] ?? '' }}&distance_miles={{ $search['distance_miles'] ?? 0 }}&total={{ $vehicle['total_fare'] }}" class="w-full bg-primary text-on-primary font-label-lg text-label-lg py-4 px-6 rounded-md hover:bg-primary-fixed transition-all duration-300 text-center shadow-[0_4px_14px_rgba(197,160,89,0.3)]">
                            Select &amp; Continue
                        </a>
                    @else
                        <button disabled class="w-full bg-surface-container border border-outline/10 text-on-surface-variant/30 font-label-lg text-label-lg py-3 px-6 rounded-md cursor-not-allowed text-center">
                            {{ $vehicle['ineligible_reason'] }}
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
        
        @if($shownCount === 0)
            <div class="bg-surface p-12 rounded-xl border border-outline/20 text-center space-y-4">
                <span class="material-symbols-outlined text-primary text-6xl">warning</span>
                <h2 class="font-headline-lg text-headline-lg text-white">No Vehicles Match Your Requirements</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg mx-auto">No vehicle in our fleet can accommodate {{ $search['passengers'] }} passenger(s) with {{ $search['luggage'] }} bag(s). Please reduce your counts or contact us to arrange custom transportation.</p>
                <a href="/" class="inline-block bg-primary text-on-primary px-8 py-3 rounded text-label-lg font-label-lg">Modify Booking Details</a>
            </div>
        @endif
    </div>
</div>
@endsection
