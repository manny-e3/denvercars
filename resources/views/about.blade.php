@extends('layouts.app')

@section('title', 'About Us | Denver Elite')

@section('content')
<!-- Hero Section -->
<header class="relative w-full h-[500px] flex items-center justify-center overflow-hidden border-b border-outline/10">
    <img alt="Denver Elite Hero" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-luminosity scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsyejjO2p3XWJPueL65eaD1Dz8MPeDiPZFAxinPzwoXjq-34JFjXV7nI8gSZUvH-4H-_3MuTqr7-y6asXq76Mvy1FOa0ytqnVIEIocux9BP9jzRpsLcOPzC0CPsGRnXjIOAY6okz1GW8sz_pZKdQLxSHscgkssInfC7gqEuj_fP8P29qZCIbVmv5p1pF7JuuCTwNQAtblBzHTdTyeBtvrhNzucbDu9L-b2aJPI9T6rkM8-4e_7bhs3IOnbYqMsg2xqWsmVh5NdlJPC"/>
    <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
    <div class="relative z-10 text-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto translate-y-4">
        <p class="font-label-lg text-label-lg text-primary uppercase tracking-widest mb-unit-md opacity-80">The Denver Elite Story</p>
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-background max-w-4xl mx-auto leading-tight">
            Excellence in Motion.
        </h1>
    </div>
</header>

<!-- Our Heritage Section -->
<section class="py-unit-xl md:py-[120px] px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-unit-xl items-center">
        <div class="lg:col-span-5 relative group">
            <div class="absolute -inset-4 border border-outline/20 z-0 hidden lg:block transition-transform duration-700 group-hover:scale-105"></div>
            <div class="relative z-10 overflow-hidden bg-surface">
                <img class="w-full aspect-[4/5] object-cover opacity-80 mix-blend-luminosity hover:opacity-100 transition-opacity duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAp7Z_yddDCpWPVQ76P2wHFeNzjvGAqrr9f04melbNzRBQL0UpyQ_yLzAUW6y_6mjrdIEYC0bn1oDEsCaUagOx7Axmz5rskNSNUIHCqaSg_cp8LqZg3TWPehNGeOKBJpxPuQhLltL0gxfPmq-3c0OCM1Yfwojq7lclEKwGG89Q7BL0nmFe5rrxGVUruJlmZsb6g6_R3VKz3EnrhRqmsH8Yva_cWvbaacDb8hfXKVC1dMikld2274h2AkjDDyP2VDy0WD4SkvD4un4I-" alt="Chauffeur steering wheel"/>
            </div>
        </div>
        <div class="lg:col-span-6 lg:col-start-7 space-y-unit-lg">
            <div class="inline-flex items-center space-x-3 mb-unit-sm">
                <div class="w-8 h-[1px] bg-primary"></div>
                <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest">Est. 2014</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-background">Our Heritage</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant">For over a decade, Denver Elite has redefined luxury transportation in the heart of Colorado. Born from a vision of uncompromising quality, we have meticulously grown from a boutique car service into Denver's premier executive transport provider.</p>
            <p class="font-body-md text-body-md text-on-surface-variant">We understand that we don't just move people; we curate seamless transitions. Whether navigating rugged mountain passes to Aspen or gliding through bustling city avenues, our legacy is built on unyielding punctuality, absolute discretion, and a profound commitment to our clients' serenity.</p>
        </div>
    </div>
</section>

<!-- Fleet & Chauffeurs Grid -->
<section class="py-unit-xl px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto border-t border-outline/10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
        <!-- Fleet Card -->
        <div class="bg-surface border border-outline/20 p-unit-xl flex flex-col justify-end min-h-[500px] relative overflow-hidden group">
            <img class="absolute inset-0 w-full h-full object-cover opacity-30 group-hover:opacity-40 transition-opacity duration-700 mix-blend-luminosity scale-100 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwdQOl_gEikFr8S56LY87vmh4n4T8Os96QusQHy_xCw3e_FGw-AKH_9_HDQkXuHRIoeUKPb3R5W1duTKCiRHfkfuttg8Co3muxab46pIDiDk3EZzUpb6mo6AGoX8wqlwLM1jZrInNnZ_3I4pUNDeZ5JX-x5guIDlXsknVGldwFcpiz__GkBWfv5z1JVAlsOJBicn7YKUeeYJjp2cIcrGgBz4nygltAm9o94StJ9rg-nexFOFU51pLi-Zs9rXSrS_txEOscFDJPEL5c" alt="Denver Elite luxury SUV"/>
            <div class="absolute inset-0 bg-gradient-to-t from-surface via-surface/80 to-transparent"></div>
            <div class="relative z-10 transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                <h3 class="font-headline-md text-headline-md text-primary mb-unit-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[24px]">directions_car</span>
                    Our Fleet
                </h3>
                <p class="font-body-md text-body-md text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">An impeccable collection of late-model luxury vehicles, meticulously maintained to ensure flawless performance. From elegant executive sedans to spacious commanding SUVs, our fleet represents the absolute pinnacle of modern automotive comfort.</p>
                <a href="/fleet" class="inline-block mt-4 text-primary hover:text-primary-fixed font-semibold transition-colors duration-300">View Fleet details &rarr;</a>
            </div>
        </div>
        <!-- Chauffeurs Card -->
        <div class="bg-surface border border-outline/20 p-unit-xl flex flex-col justify-end min-h-[500px] relative overflow-hidden group">
            <img class="absolute inset-0 w-full h-full object-cover opacity-30 group-hover:opacity-40 transition-opacity duration-700 mix-blend-luminosity scale-100 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAogFEebYJY9v29FtddMqli3oerqS_vRnj0lSRITgCbtUzht6g-jXGvoTdQ0X3W2xd6hiM1kvC7Xl7Hh9efhcg43NO_cGvlPLU8v9wZTs4XiWb9WKY3LPEuK-Op5QEQAA_V8YT_9-1MfkFIE8PEtsmszbBjrAU2lT1xw2AXgwxdPuQMaZCl0-4VmzkoEnofH8SXb66JSjLza5TLYvYsosAyWIFN03llBo6TZXUI1-ESBYg_lunZVa0nrAvL_iQstGfqxsTJfM_XjKUK" alt="Denver Elite Chauffeur"/>
            <div class="absolute inset-0 bg-gradient-to-t from-surface via-surface/80 to-transparent"></div>
            <div class="relative z-10 transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                <h3 class="font-headline-md text-headline-md text-primary mb-unit-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[24px]">person_pin</span>
                    Our Chauffeurs
                </h3>
                <p class="font-body-md text-body-md text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">More than mere drivers, they are dedicated concierges of the road. Vetted for supreme safety, trained in advanced defensive driving, and possessing profound local expertise, our professionals guarantee a journey that is as secure as it is serene.</p>
                <a href="/contact" class="inline-block mt-4 text-primary hover:text-primary-fixed font-semibold transition-colors duration-300">Speak with our Concierge &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- Commitment Section -->
<section class="py-[100px] md:py-[140px] bg-surface-container-lowest border-y border-outline/10 relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center max-w-4xl relative z-10 font-body-md">
        <span class="material-symbols-outlined text-primary mb-unit-lg text-[48px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
        <h2 class="font-headline-lg text-headline-lg text-on-background mb-unit-lg">Commitment to Excellence</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-unit-xl max-w-3xl mx-auto">At Denver Elite, good is never enough. We hold ourselves to the most rigorous quality standards in the industry. Reliability is merely our baseline; perfection is our daily pursuit. Every ride, every route, every interaction is a testament to our dedication to delivering an unparalleled luxury experience.</p>
        <a href="/contact" class="inline-block bg-primary text-on-primary px-10 py-4 font-label-lg text-label-lg hover:bg-primary-fixed transition-colors duration-300">
            Experience the Difference
        </a>
    </div>
</section>
@endsection
