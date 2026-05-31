@extends('layouts.app')

@section('title', 'Contact Us & FAQ | Denver Elite')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-[350px] md:h-[400px] flex flex-col items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAYVik8z-cBGN8CKzmGx48Bwfq0ji1css6vrkl6zU_kAyZsjKjxfbDCfmRgSvPtn_V1oshya51ciQReQtTa9mgIntbWZc5IQWt_rh7zTCFV7qLQ_PvL3ucZC_YNvMz7Iljle1Xq5UJv4Gpzxtlk3gAuE1BmmYdOqHzTleTFDffvBUWkSgf92zydsIs53HragnRsTmB_fqQAV5nYH3XOYRY4yLi1_C_CtlEHoamRsY4fO-njGpkWhqwVjZQNdJplZ-LUwsHxnGHfUZxi');">
        <div class="absolute inset-0 bg-black/70"></div>
    </div>
    <div class="relative z-10 text-center px-margin-mobile">
        <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight mb-4">
            We're At Your Service.
        </h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
            Experience unparalleled luxury and precision. Reach out to coordinate your next journey.
        </p>
    </div>
</section>

<!-- Contact Form & Info Grid -->
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-unit-xl md:py-[96px]">
    
    @if(session('success'))
        <div class="mb-8 p-4 bg-primary/10 border border-primary text-primary rounded text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-unit-xl">
        <!-- Left Column: Contact Form -->
        <div class="bg-surface-container-low p-unit-lg rounded-DEFAULT border border-outline/10 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.4)]">
            <h2 class="font-headline-md text-headline-md text-primary mb-8">Send an Inquiry</h2>
            <form action="/contact/submit" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="sr-only" for="name">Full Name</label>
                    <input class="w-full luxury-input text-on-surface font-body-md text-body-md px-4 py-3 placeholder:text-on-surface-variant/50" id="name" name="name" placeholder="Full Name" required type="text"/>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="sr-only" for="email">Email Address</label>
                        <input class="w-full luxury-input text-on-surface font-body-md text-body-md px-4 py-3 placeholder:text-on-surface-variant/50" id="email" name="email" placeholder="Email Address" required type="email"/>
                    </div>
                    <div>
                        <label class="sr-only" for="phone">Phone Number</label>
                        <input class="w-full luxury-input text-on-surface font-body-md text-body-md px-4 py-3 placeholder:text-on-surface-variant/50" id="phone" name="phone" placeholder="Phone Number" required type="tel"/>
                    </div>
                </div>
                <div>
                    <label class="sr-only" for="message">Message</label>
                    <textarea class="w-full luxury-input text-on-surface font-body-md text-body-md px-4 py-3 placeholder:text-on-surface-variant/50 resize-none" id="message" name="message" placeholder="How can we assist you?" required rows="4"></textarea>
                </div>
                <div class="pt-4">
                    <button class="w-full md:w-auto bg-primary-container text-on-primary-container px-unit-lg py-4 rounded-DEFAULT font-label-lg text-label-lg uppercase tracking-widest hover:bg-primary transition-colors duration-300" type="submit">
                        Request Service
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Right Column: Info & Map -->
        <div class="flex flex-col gap-unit-lg">
            <!-- Contact Information Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Phone -->
                <div class="flex items-start gap-4 p-6 bg-surface-container-low rounded-DEFAULT border border-outline/10">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">call</span>
                    <div>
                        <h3 class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant mb-1">Direct Line</h3>
                        <p class="font-body-lg text-body-lg text-on-surface whitespace-nowrap">+1 (303) 555-0199</p>
                    </div>
                </div>
                <!-- Email -->
                <div class="flex items-start gap-4 p-6 bg-surface-container-low rounded-DEFAULT border border-outline/10">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">mail</span>
                    <div>
                        <h3 class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant mb-1">Inquiries</h3>
                        <p class="font-body-md text-body-md text-on-surface">concierge@denverelite.com</p>
                    </div>
                </div>
            </div>
            
            <!-- Address & Socials -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-6 border-t border-outline/20 pt-8">
                <div>
                    <h3 class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant mb-2">Headquarters</h3>
                    <p class="font-body-md text-body-md text-on-surface">
                        1701 Wynkoop St<br/>
                        Denver, CO 80202
                    </p>
                </div>
                <div class="flex gap-4">
                    <a class="w-12 h-12 flex items-center justify-center rounded-full border border-outline/30 text-on-surface hover:text-primary hover:border-primary transition-all duration-300" href="#">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                </div>
            </div>
            
            <!-- Stylized Map Area -->
            <div class="relative w-full h-[250px] rounded-DEFAULT overflow-hidden border border-outline/20 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.5)] mt-auto">
                <img alt="Map of Denver" class="w-full h-full object-cover opacity-80 mix-blend-luminosity grayscale hover:grayscale-0 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgf1reKPHYukUg-dSY6eraKqMcxSqDCICMigKuCVsbsWIwHWW-EIa4ZvhvlLFGKfES9w_AnxDccwhgnNdqDT-igEgPKzWKTjfZ2g0saGdFFDBN69wdKJWueLlQ9OxpOdBowG1bZVhItZPS9X6TDBzfGBFnbSTV7Q5RUYpijIDXFvqnsQBRioeE5HTnPxMSqCi1GGB0i3mvPcxbx2q1tKMT_fe427PbcCrr5bkJa3rREcrBv0tbTzJpMO_BfA3GO1HcLkcKHJAsUeYx"/>
                <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest/80 to-transparent pointer-events-none"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                    <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                    <div class="w-4 h-4 bg-primary/20 rounded-full animate-ping absolute top-4"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section (Asymmetric / Minimalist Layout) -->
<section class="bg-surface-container-lowest border-t border-outline/10">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-unit-xl md:py-[96px]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-unit-xl">
            <div class="lg:col-span-4">
                <h2 class="font-headline-lg text-headline-lg text-primary sticky top-32">
                    Frequently Asked Questions
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mt-4">
                    Details regarding reservations, modifications, and our commitment to your schedule.
                </p>
            </div>
            <div class="lg:col-span-8 flex flex-col gap-8">
                
                <!-- FAQ Item 1 -->
                <div class="border-b border-outline/20 pb-8 cursor-pointer group" onclick="toggleFaq(1)">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-3 flex items-start gap-4 group-hover:text-primary transition-colors">
                        <span class="text-primary-container mt-1 material-symbols-outlined transition-transform" id="faq-icon-1" style="font-size: 20px;">keyboard_arrow_down</span>
                        How far in advance must I book a reservation?
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant pl-9 hidden transition-all duration-300" id="faq-ans-1">
                        For guaranteed availability, we recommend reserving your vehicle at least 24 hours prior to your required departure time. However, our dispatch team is equipped to handle immediate requests subject to fleet positioning.
                    </p>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="border-b border-outline/20 pb-8 cursor-pointer group" onclick="toggleFaq(2)">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-3 flex items-start gap-4 group-hover:text-primary transition-colors">
                        <span class="text-primary-container mt-1 material-symbols-outlined transition-transform" id="faq-icon-2" style="font-size: 20px;">keyboard_arrow_down</span>
                        What is the cancellation policy?
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant pl-9 hidden transition-all duration-300" id="faq-ans-2">
                        Cancellations made more than 12 hours before the scheduled pickup time incur no charges. Cancellations within the 12-hour window are subject to a 50% retention fee to compensate our chauffeurs for their reserved time.
                    </p>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="cursor-pointer group pb-4" onclick="toggleFaq(3)">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-3 flex items-start gap-4 group-hover:text-primary transition-colors">
                        <span class="text-primary-container mt-1 material-symbols-outlined transition-transform" id="faq-icon-3" style="font-size: 20px;">keyboard_arrow_down</span>
                        Are itineraries flexible during the journey?
                    </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant pl-9 hidden transition-all duration-300" id="faq-ans-3">
                        Absolutely. Our chauffeurs operate on an hourly retainer basis when requested, allowing for dynamic changes to your route, unexpected stops, and extended wait times at your discretion.
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</section>

<script>
    function toggleFaq(id) {
        var ans = document.getElementById('faq-ans-' + id);
        var icon = document.getElementById('faq-icon-' + id);
        if (ans.classList.contains('hidden')) {
            ans.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            ans.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }
</script>
@endsection
