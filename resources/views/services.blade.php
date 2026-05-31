@extends('layouts.app')

@section('title', 'Our Services | Denver Elite')

@section('content')
<!-- Hero Section -->
<section class="relative h-[450px] min-h-[400px] w-full flex items-center justify-center">
    <div class="absolute inset-0 z-0">
        <img alt="Chauffeur opening car door" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJhwzBg-WczzW0abEPVE-barK5nJ6FD-EBK2SmbpO85B3at13HzRuJ4nJaUJFzzW523KR7Pafqg6I5UJ4A4TwHowTy9bw2lJAovFAIqimDo4gidHHay7lKjNYwh6Zme7S7zqKJhJZE2Rmffmr3A-fo2nb5aG7muYFvKXbkubwHR_AH_wwcKLoy1FmenzmO4qsjimnNEzF9IEch3IDpSDLGvFxNw3v5HQsR3v_uLZkehSjfyROhi6SBnGIEflQ0mX9HworMsC6fpThZ"/>
        <div class="absolute inset-0 image-overlay"></div>
    </div>
    <div class="relative z-10 text-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-white mb-unit-lg tracking-tight">Our Premium Services</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">Impeccable timing, unmatched comfort, and absolute discretion for every journey.</p>
    </div>
</section>

<!-- Services Grid - Bento Style -->
<section class="py-24 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
        
        <!-- Airport Transfers (Large Feature) -->
        <div class="md:col-span-12 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col md:flex-row h-auto md:h-[500px]">
            <div class="md:w-1/2 relative h-[300px] md:h-full overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCtCUbxB6cFUyNwNpTxJaKGlY7LQPMbsfYMIFa4BiW8-2IoHxGKjZBbacVzpSkNuTfAx_VaYeSGeYSLLtBB0qmkda1_EcFwMSce7D5FM6YSNAMbutl71LQPUZIx6fcYJ2GGwTDMPIAxXyOTETpgxTFc8jad3QfTBr78NLKk7ZPn3JK_yNtNCwfmwWh7IT-Iu2_iucjIvIyfeBM2ju3YvSA15A5z7SIY-7D0g_ySs1I3lWkMXEPTgJ3SpefDqs4BPDhQ0LGa4h7f6V_F" alt="Private jet on tarmac"/>
                <div class="absolute inset-0 bg-black/30"></div>
            </div>
            <div class="md:w-1/2 p-unit-xl flex flex-col justify-center bg-surface-container relative z-10">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-unit-sm">Airport Transfers</h2>
                <h3 class="font-label-lg text-label-lg text-on-surface-variant mb-unit-md uppercase tracking-wider">DIA &amp; Private Terminals</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg">
                    Seamless transitions from air to ground. Our chauffeurs track your flight in real-time, ensuring we are waiting curbside or at the private terminal exactly when you need us. Experience stress-free departures and arrivals with our white-glove luggage service.
                </p>
                <div>
                    <a href="/?service=airport" class="inline-block bg-primary-container text-on-primary-container font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-primary-fixed-dim transition-colors duration-300">
                        Book Transfer
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Corporate Accounts (Standard Card) -->
        <div class="md:col-span-6 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[600px]">
            <div class="relative h-[250px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrzyGU53kEipbf-ijA1UQNwUXwXNP-hX2inBviF7smg9kiV3nU-8S3HWitlpXTa6S3gWa5XLsK3hGl34z0U074QqFhdW6ynzrsgvaAPc3-vCtVUGTuxUdFC3P3khd0PUYK_UdKUmI-DBeBW-32kPQPD2-6XZZl_TjzrZ07D4gAE-wvDndstiG-FX1zbEuZ7LSJ5Hu5KMQtUc7faCm-94gYUOeRcxMtlGPxsAjVFQ1sMVpbmEfdIIQLA_797wHrDIDEoUv6FjhXUJX3" alt="Corporate buildings"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Corporate Accounts</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Recurring &amp; Dedicated Support</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Designed for executives who demand consistency. Benefit from priority booking, streamlined recurring billing, and a dedicated account manager. We handle the logistics so you can focus on the business at hand.
                </p>
                <div>
                    <a href="/contact?subject=corporate" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Hourly Directed (Standard Card) -->
        <div class="md:col-span-6 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[600px]">
            <div class="relative h-[250px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH0Gru2JVDtgOYteoO8yQTTURBBLcatQbfZFs-fSyJjsuit7XekJGIqa86OLaZDUC_CRdr1csFeAjg-7A7CLBat7IqeXIQ9kkyk8NYKL8yJSz_1HQyeBGZriU55fSCdVPwgmsWYMjgGc-PR6aJ03aEDhuk8j9dRZoRbz6EFAGfr7_0pIhWpUkw1SuwJpakjbkZOwj3Tio4rZmMuEVs0Xq7kEbqr_GXe7MnrXfEVf-lSVi5FPcZ3jTljm2RTsTxhEIM-qvmLXHBs64o" alt="Luxury car interior"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Hourly Directed</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Flexible &amp; As-Directed</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Ultimate flexibility for dynamic itineraries. Reserve a vehicle and professional chauffeur for a block of time. Whether you have multiple meetings across town or are exploring the city, your car remains on standby, moving at your pace.
                </p>
                <div>
                    <a href="/?service=hourly" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Reserve Hourly
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Special Events (Wide Feature) -->
        <div class="md:col-span-12 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 h-auto md:h-[400px]">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkJa-KW0Zsl3aCDAH_rnmt7-1ZIaJcMSCxgkvvMggAlxNeFjf1DX4_frPaqZMjYyaGmFSpfyQjgbawq4lltJSwN6quavhUXr1VCIM4r1jIuQ1IWc6H1Gu0OSxVzfQIqmDkNxBN7Fv5bqPb400VQTSG6TWKJdSFYmAlPMS7vPE3f_ydMROu9vsLVQ_1FXkF-O5pD4fX04QxUFk61Bw5baAQ_7zDkE-NXAQD7CjoUNptchFFjwIoO6TdPjpsTVBzA-xdJX5_2YVnIr2G" alt="Special event setup"/>
                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-black/30"></div>
            </div>
            <div class="relative z-10 p-unit-xl flex flex-col justify-center h-full w-full md:w-2/3">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-unit-sm">Special Events</h2>
                <h3 class="font-label-lg text-label-lg text-on-surface-variant mb-unit-md uppercase tracking-wider">Weddings, Galas &amp; Concerts</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg max-w-xl">
                    Make a grand entrance. From pristine wedding transportation to VIP concert drop-offs, we provide flawlessly detailed vehicles and chauffeurs who understand the importance of your special occasion. Elevate your evening with unparalleled elegance.
                </p>
                <div>
                    <a href="/contact?subject=event" class="inline-block bg-primary-container text-on-primary-container font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-primary-fixed-dim transition-colors duration-300">
                        Plan Your Event
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection
