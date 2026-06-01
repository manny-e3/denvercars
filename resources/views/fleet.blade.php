@extends('layouts.app')

@section('title', 'Luxury Fleet Details | Denver Limo Cars')

@section('content')
<!-- Hero Section -->
<section class="relative h-[300px] md:h-[400px] w-full flex items-center justify-center overflow-hidden border-b border-outline/10">
    <div class="absolute inset-0 z-0">
        <img alt="Luxury car lineup" class="w-full h-full object-cover opacity-30 mix-blend-luminosity scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsyejjO2p3XWJPueL65eaD1Dz8MPeDiPZFAxinPzwoXjq-34JFjXV7nI8gSZUvH-4H-_3MuTqr7-y6asXq76Mvy1FOa0ytqnVIEIocux9BP9jzRpsLcOPzC0CPsGRnXjIOAY6okz1GW8sz_pZKdQLxSHscgkssInfC7gqEuj_fP8P29qZCIbVmv5p1pF7JuuCTwNQAtblBzHTdTyeBtvrhNzucbDu9L-b2aJPI9T6rkM8-4e_7bhs3IOnbYqMsg2xqWsmVh5NdlJPC"/>
        <div class="absolute inset-0 image-overlay"></div>
    </div>
    <div class="relative z-10 text-center px-margin-mobile">
        <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest">Our Selection</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-white mt-4 tracking-tight">The Denver Limo Cars Fleet</h1>
    </div>
</section>

<!-- Fleet Grid -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-24 space-y-20">
    
    @foreach(($vehicles ?? \App\Models\Vehicle::all()) as $index => $vehicle)
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center pt-12 {{ $index > 0 ? 'border-t border-outline/10' : '' }}">
        <!-- Left: Image -->
        <div class="lg:col-span-6 {{ $index % 2 == 1 ? 'order-1 lg:order-2 lg:col-start-7' : '' }} relative rounded-xl overflow-hidden border border-outline/20 group">
            <img class="w-full aspect-[16/9] object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $vehicle->image }}" alt="{{ $vehicle->name }}"/>
            <div class="absolute inset-0 bg-black/10"></div>
        </div>
        <!-- Right: Specs -->
        <div class="lg:col-span-5 {{ $index % 2 == 1 ? 'order-2 lg:order-1' : 'lg:col-start-8' }} space-y-6">
            <div>
                <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest bg-primary/10 px-3 py-1 rounded">{{ $vehicle->class }}</span>
                <h2 class="font-headline-lg text-headline-lg text-white mt-3">{{ $vehicle->name }}</h2>
            </div>
            
            <p class="font-body-md text-body-md text-on-surface-variant">
                {{ $vehicle->description }}
            </p>
            
            <!-- Quick specs -->
            <div class="grid grid-cols-3 gap-4 border-y border-outline/10 py-4 text-on-surface-variant">
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">group</span>
                    <span class="font-label-sm text-label-sm font-semibold">{{ $vehicle->passengers }} Passengers</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">work</span>
                    <span class="font-label-sm text-label-sm font-semibold">{{ $vehicle->luggage }} Bags</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">wifi</span>
                    <span class="font-label-sm text-label-sm font-semibold">Free Wi-Fi</span>
                </div>
            </div>

            <!-- Cabin Amenities -->
            <div>
                <h3 class="font-label-sm text-label-sm uppercase tracking-widest text-primary mb-3 font-semibold">Premium Amenities</h3>
                <ul class="grid grid-cols-2 gap-x-6 gap-y-2 text-body-md font-body-md text-on-surface-variant">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Leather Seating</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Climate Control</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Premium Sound System</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Complimentary Water</li>
                </ul>
            </div>

            <!-- Pricing & CTA -->
            <div class="flex items-center justify-between pt-4 border-t border-outline/10">
                <div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Rates starting at</p>
                    <p class="font-headline-md text-headline-md text-primary font-bold">${{ number_format($vehicle->hourly_rate) }} <span class="text-sm font-normal text-on-surface-variant">/ hr</span></p>
                </div>
                <a href="/?pickup=DEN+Airport&dropoff=The+Brown+Palace+Hotel&passengers={{ $vehicle->passengers }}&luggage={{ $vehicle->luggage }}" class="bg-primary text-on-primary font-label-lg text-label-lg px-6 py-3 rounded hover:bg-primary-fixed transition-colors shadow-[0_4px_14px_rgba(197,160,89,0.3)]">
                    Reserve Now
                </a>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection
