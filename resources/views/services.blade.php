@extends('layouts.app')

@section('title', 'Our Services | Denver Limo Cars')

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
        
     
        
        <!-- Special Events (Wide Feature) -->
        <div class="md:col-span-12 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 h-auto md:h-[400px]">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"  src="{{ asset('assets/img/weddingytan.jpg') }}" alt="Wedding Transportation"/>
                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-black/30"></div>
            </div>
            <div class="relative z-10 p-unit-xl flex flex-col justify-center h-full w-full md:w-2/3">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-unit-sm">Wedding Transportation</h2>
                <h3 class="font-label-lg text-label-lg text-on-surface-variant mb-unit-md uppercase tracking-wider"> Luxury &amp; Guest Shuttles</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg max-w-xl">
                    Your wedding day is one of the most important days of your life, and we want to help make it perfect. We offer a range of wedding transportation services, including limousines and luxury vehicles for the bride and groom, as well as shuttle buses for your guests.
                </p>
                <div>
                    <a href="/contact?subject=event" class="inline-block bg-primary-container text-on-primary-container font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-primary-fixed-dim transition-colors duration-300">
                        Plan Your Event
                    </a>
                </div>
            </div>
        </div>



           <!-- Corporate Accounts (Standard Card) -->
        <div class="md:col-span-6 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[600px]">
            <div class="relative h-[250px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"  src="{{ asset('assets/img/skip.jpg') }}" alt="Ski Resort and Mountain Trips">
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Ski Resort & Mountain Trips</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Vail, Aspen & Breckenridge</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                  Whether you're headed to Vail, Aspen, or Breckenridge, we offer comfortable and luxurious transportation that will make your trip unforgettable.
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
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('assets/img/Concerts.jpg') }}" alt="Concerts and Red Rocks"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Concerts &amp; Red Rocks</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Red Rocks Amphitheatre is one of the most iconic concert venues in the world</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Red Rocks Amphitheatre is one of the most iconic concert venues in the world, and our limousine service can take you there in style. We offer transportation to and from concerts and other events at Red Rocks, ensuring you arrive in comfort and style.
                </p>
                <div>
                    <a href="/?service=hourly" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Reserve Hourly
                    </a>
                </div>
            </div>
        </div>

       
        <!-- Additional Services Row - 3 per row -->

        <!-- Ski Resort and Mountain Trips -->
        <!-- <div class="md:col-span-4 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[520px]">
            <div class="relative h-[220px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('assets/img/skip.jpg') }}" alt="Ski Resort and Mountain Trips"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Ski Resort &amp; Mountain Trips</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Vail, Aspen &amp; Breckenridge</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Colorado is home to some of the best ski resorts and mountain destinations in the world, and our limousine service can take you there in style. Whether you're headed to Vail, Aspen, or Breckenridge, we offer comfortable and luxurious transportation that will make your trip unforgettable.
                </p>
                <div>
                    <a href="/?service=ski" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Book Mountain Trip
                    </a>
                </div>
            </div>
        </div> -->

        <!-- Wedding Transportation -->
        <!-- <div class="md:col-span-4 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[520px]">
            <div class="relative h-[220px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('assets/img/weddingytan.jpg') }}" alt="Wedding Transportation"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Wedding Transportation</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Luxury &amp; Guest Shuttles</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Your wedding day is one of the most important days of your life, and we want to help make it perfect. We offer a range of wedding transportation services, including limousines and luxury vehicles for the bride and groom, as well as shuttle buses for your guests.
                </p>
                <div>
                    <a href="/contact?subject=wedding" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Plan Your Wedding
                    </a>
                </div>
            </div>
        </div> -->

        <!-- Executive Transportation -->
        <!-- <div class="md:col-span-4 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[520px]">
            <div class="relative h-[220px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('assets/img/Executive_tran1.jpg') }}" alt="Executive Transportation"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Executive Transportation</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Business Class &amp; VIP</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Our executive transportation service is perfect for business travelers who demand the best. We offer luxury vehicles and experienced drivers who will get you to your destination on time and in style.
                </p>
                <div>
                    <a href="/?service=executive" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Book Executive Ride
                    </a>
                </div>
            </div>
        </div> -->

        <!-- Concerts and Red Rocks -->
        <!-- <div class="md:col-span-4 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[520px]">
            <div class="relative h-[220px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('assets/img/Concerts.jpg') }}" alt="Concerts and Red Rocks"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Concerts &amp; Red Rocks</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Events &amp; Entertainment</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Red Rocks Amphitheatre is one of the most iconic concert venues in the world, and our limousine service can take you there in style. We offer transportation to and from concerts and other events at Red Rocks, ensuring you arrive in comfort and style.
                </p>
                <div>
                    <a href="/?service=concert" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Book Concert Ride
                    </a>
                </div>
            </div>
        </div> -->

        <!-- School Students Pickup and Drop-off -->
        <!-- <div class="md:col-span-4 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[520px]">
            <div class="relative h-[220px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('assets/img/Students.jpg') }}" alt="School Students Pickup and Drop-off"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Student Pickup &amp; Drop-off</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Safe &amp; Reliable School Transport</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    We understand the importance of safety and reliability when it comes to transporting students. That's why we offer a range of transportation services for schools, including pickup and drop-off services for students of all ages.
                </p>
                <div>
                    <a href="/contact?subject=school" class="inline-block border border-primary text-primary font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-surface-variant transition-colors duration-300">
                        Enquire Now
                    </a>
                </div>
            </div>
        </div> -->

        <!-- Hourly Bookings -->
        <!-- <div class="md:col-span-4 relative group rounded-lg overflow-hidden bg-surface-container border border-outline/10 flex flex-col h-auto md:h-[520px]">
            <div class="relative h-[220px] overflow-hidden">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('assets/img/dsl_banner.jpg') }}" alt="Hourly Bookings"/>
                <div class="absolute inset-0 bg-black/40"></div>
            </div>
            <div class="p-unit-lg flex flex-col flex-grow bg-surface-container">
                <h2 class="font-headline-md text-headline-md text-primary mb-unit-sm">Hourly Bookings</h2>
                <h3 class="font-label-sm text-label-sm text-on-surface-variant mb-unit-md uppercase tracking-widest">Flexible By The Hour</h3>
                <p class="font-body-md text-body-md text-on-surface mb-unit-lg flex-grow">
                    Whether you need transportation for a few hours or an entire day, our hourly booking service is perfect for your needs. We offer flexible and affordable transportation options, allowing you to customize your itinerary and make the most of your time in Denver.
                </p>
                <div>
                    <a href="/?service=hourly" class="inline-block bg-primary-container text-on-primary-container font-label-lg text-label-lg px-unit-lg py-unit-sm rounded hover:bg-primary-fixed-dim transition-colors duration-300">
                        Reserve Hourly
                    </a>
                </div>
            </div>
        </div> -->

    </div>
</section>
@endsection
