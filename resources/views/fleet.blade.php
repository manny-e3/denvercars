@extends('layouts.app')

@section('title', 'Luxury Fleet Details | Denver Elite')

@section('content')
<!-- Hero Section -->
<section class="relative h-[300px] md:h-[400px] w-full flex items-center justify-center overflow-hidden border-b border-outline/10">
    <div class="absolute inset-0 z-0">
        <img alt="Luxury car lineup" class="w-full h-full object-cover opacity-30 mix-blend-luminosity scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsyejjO2p3XWJPueL65eaD1Dz8MPeDiPZFAxinPzwoXjq-34JFjXV7nI8gSZUvH-4H-_3MuTqr7-y6asXq76Mvy1FOa0ytqnVIEIocux9BP9jzRpsLcOPzC0CPsGRnXjIOAY6okz1GW8sz_pZKdQLxSHscgkssInfC7gqEuj_fP8P29qZCIbVmv5p1pF7JuuCTwNQAtblBzHTdTyeBtvrhNzucbDu9L-b2aJPI9T6rkM8-4e_7bhs3IOnbYqMsg2xqWsmVh5NdlJPC"/>
        <div class="absolute inset-0 image-overlay"></div>
    </div>
    <div class="relative z-10 text-center px-margin-mobile">
        <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest">Our Selection</span>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-white mt-4 tracking-tight">The Denver Elite Fleet</h1>
    </div>
</section>

<!-- Fleet Grid -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-24 space-y-20">
    
    <!-- Vehicle Class 1: Cadillac Escalade -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
        <!-- Left: Image -->
        <div class="lg:col-span-6 relative rounded-xl overflow-hidden border border-outline/20 group">
            <img class="w-full aspect-[16/9] object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwdQOl_gEikFr8S56LY87vmh4n4T8Os96QusQHy_xCw3e_FGw-AKH_9_HDQkXuHRIoeUKPb3R5W1duTKCiRHfkfuttg8Co3muxab46pIDiDk3EZzUpb6mo6AGoX8wqlwLM1jZrInNnZ_3I4pUNDeZ5JX-x5guIDlXsknVGldwFcpiz__GkBWfv5z1JVAlsOJBicn7YKUeeYJjp2cIcrGgBz4nygltAm9o94StJ9rg-nexFOFU51pLi-Zs9rXSrS_txEOscFDJPEL5c" alt="Cadillac Escalade ESV"/>
            <div class="absolute inset-0 bg-black/10"></div>
        </div>
        <!-- Right: Specs -->
        <div class="lg:col-span-5 lg:col-start-8 space-y-6">
            <div>
                <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest bg-primary/10 px-3 py-1 rounded">Executive Class SUV</span>
                <h2 class="font-headline-lg text-headline-lg text-white mt-3">Cadillac Escalade ESV</h2>
            </div>
            
            <p class="font-body-md text-body-md text-on-surface-variant">
                The ultimate executive vehicle for corporate groups, mountain resort transfers, and large families. Combining commanding presence with unrivaled cabin space and advanced technology.
            </p>
            
            <!-- Quick specs -->
            <div class="grid grid-cols-3 gap-4 border-y border-outline/10 py-4 text-on-surface-variant">
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">group</span>
                    <span class="font-label-sm text-label-sm font-semibold">6 Passengers</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">work</span>
                    <span class="font-label-sm text-label-sm font-semibold">6 Bags</span>
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
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Leather Captain Chairs</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Tri-Zone Climate Control</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Premium Sound System</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Complimentary Water</li>
                </ul>
            </div>

            <!-- Pricing & CTA -->
            <div class="flex items-center justify-between pt-4 border-t border-outline/10">
                <div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Rates starting at</p>
                    <p class="font-headline-md text-headline-md text-primary font-bold">$150 <span class="text-sm font-normal text-on-surface-variant">/ hr</span></p>
                </div>
                <a href="/?pickup=DEN+Airport&dropoff=The+Brown+Palace+Hotel&passengers=6&luggage=4" class="bg-primary text-on-primary font-label-lg text-label-lg px-6 py-3 rounded hover:bg-primary-fixed transition-colors shadow-[0_4px_14px_rgba(197,160,89,0.3)]">
                    Reserve Now
                </a>
            </div>
        </div>
    </div>

    <!-- Vehicle Class 2: Mercedes-Benz S-Class -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center pt-12 border-t border-outline/10">
        <!-- Left: Specs (Reversed Layout on Desktop) -->
        <div class="lg:col-span-5 order-2 lg:order-1 space-y-6">
            <div>
                <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest bg-primary/10 px-3 py-1 rounded">Executive Class Sedan</span>
                <h2 class="font-headline-lg text-headline-lg text-white mt-3">Mercedes-Benz S-Class</h2>
            </div>
            
            <p class="font-body-md text-body-md text-on-surface-variant">
                The global benchmark for first-class automotive travel. Unmatched acoustic insulation, whisper-quiet cabin comfort, and legendary suspension smoothness make it the premium choice for corporate travelers.
            </p>
            
            <!-- Quick specs -->
            <div class="grid grid-cols-3 gap-4 border-y border-outline/10 py-4 text-on-surface-variant">
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">group</span>
                    <span class="font-label-sm text-label-sm font-semibold">3 Passengers</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">work</span>
                    <span class="font-label-sm text-label-sm font-semibold">3 Bags</span>
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
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Heated &amp; Cooled Seats</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Acoustic Privacy Glass</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Rear Sunshades</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Device Chargers</li>
                </ul>
            </div>

            <!-- Pricing & CTA -->
            <div class="flex items-center justify-between pt-4 border-t border-outline/10">
                <div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Rates starting at</p>
                    <p class="font-headline-md text-headline-md text-primary font-bold">$130 <span class="text-sm font-normal text-on-surface-variant">/ hr</span></p>
                </div>
                <a href="/?pickup=DEN+Airport&dropoff=The+Brown+Palace+Hotel&passengers=3&luggage=2" class="bg-primary text-on-primary font-label-lg text-label-lg px-6 py-3 rounded hover:bg-primary-fixed transition-colors shadow-[0_4px_14px_rgba(197,160,89,0.3)]">
                    Reserve Now
                </a>
            </div>
        </div>
        <!-- Right: Image -->
        <div class="lg:col-span-6 lg:col-start-7 order-1 lg:order-2 relative rounded-xl overflow-hidden border border-outline/20 group">
            <img class="w-full aspect-[16/9] object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsyejjO2p3XWJPueL65eaD1Dz8MPeDiPZFAxinPzwoXjq-34JFjXV7nI8gSZUvH-4H-_3MuTqr7-y6asXq76Mvy1FOa0ytqnVIEIocux9BP9jzRpsLcOPzC0CPsGRnXjIOAY6okz1GW8sz_pZKdQLxSHscgkssInfC7gqEuj_fP8P29qZCIbVmv5p1pF7JuuCTwNQAtblBzHTdTyeBtvrhNzucbDu9L-b2aJPI9T6rkM8-4e_7bhs3IOnbYqMsg2xqWsmVh5NdlJPC" alt="Mercedes S-Class"/>
            <div class="absolute inset-0 bg-black/10"></div>
        </div>
    </div>

    <!-- Vehicle Class 3: Chevrolet Suburban -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center pt-12 border-t border-outline/10">
        <!-- Left: Image -->
        <div class="lg:col-span-6 relative rounded-xl overflow-hidden border border-outline/20 group">
            <img class="w-full aspect-[16/9] object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkJa-KW0Zsl3aCDAH_rnmt7-1ZIaJcMSCxgkvvMggAlxNeFjf1DX4_frPaqZMjYyaGmFSpfyQjgbawq4lltJSwN6quavhUXr1VCIM4r1jIuQ1IWc6H1Gu0OSxVzfQIqmDkNxBN7Fv5bqPb400VQTSG6TWKJdSFYmAlPMS7vPE3f_ydMROu9vsLVQ_1FXkF-O5pD4fX04QxUFk61Bw5baAQ_7zDkE-NXAQD7CjoUNptchFFjwIoO6TdPjpsTVBzA-xdJX5_2YVnIr2G" alt="Chevrolet Suburban"/>
            <div class="absolute inset-0 bg-black/10"></div>
        </div>
        <!-- Right: Specs -->
        <div class="lg:col-span-5 lg:col-start-8 space-y-6">
            <div>
                <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest bg-primary/10 px-3 py-1 rounded">Luxury Class SUV</span>
                <h2 class="font-headline-lg text-headline-lg text-white mt-3">Chevrolet Suburban</h2>
            </div>
            
            <p class="font-body-md text-body-md text-on-surface-variant">
                A robust, spacious option designed for excellent passenger volume, luggage storage, and comfortable rides. Fully equipped with multi-link rear suspension and massive cargo compartments.
            </p>
            
            <!-- Quick specs -->
            <div class="grid grid-cols-3 gap-4 border-y border-outline/10 py-4 text-on-surface-variant">
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">group</span>
                    <span class="font-label-sm text-label-sm font-semibold">7 Passengers</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2 bg-surface-container rounded">
                    <span class="material-symbols-outlined text-primary text-xl mb-1">work</span>
                    <span class="font-label-sm text-label-sm font-semibold">6 Bags</span>
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
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Spacious 3rd Row</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Premium Audio Setup</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Privacy Tinted Windows</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Charging Plugs</li>
                </ul>
            </div>

            <!-- Pricing & CTA -->
            <div class="flex items-center justify-between pt-4 border-t border-outline/10">
                <div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Rates starting at</p>
                    <p class="font-headline-md text-headline-md text-primary font-bold">$135 <span class="text-sm font-normal text-on-surface-variant">/ hr</span></p>
                </div>
                <a href="/?pickup=DEN+Airport&dropoff=The+Brown+Palace+Hotel&passengers=7&luggage=6" class="bg-primary text-on-primary font-label-lg text-label-lg px-6 py-3 rounded hover:bg-primary-fixed transition-colors shadow-[0_4px_14px_rgba(197,160,89,0.3)]">
                    Reserve Now
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
