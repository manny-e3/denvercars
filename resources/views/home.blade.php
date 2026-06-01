@extends('layouts.app')

@section('title', 'Elevate Your Colorado Journey | Denver Limo Cars')

@section('content')

{{-- ============================================================
     RESPONSIVE STYLES
     ============================================================ --}}
<style>
/* ---- Widget grids ---- */
.widget-row1 { display:grid; grid-template-columns:2fr 1.1fr 120px 120px; gap:10px; margin-bottom:10px; align-items:end; }
.widget-row2 { display:grid; grid-template-columns:185px 1fr 1.1fr; gap:10px; align-items:end; }

/* ---- Hero ---- */
.hero-inner  { min-height:560px; padding-top:96px; padding-bottom:180px; }
.hero-text   { max-width:520px; }
.widget-wrap { margin-top:-90px; }
.widget-box  { max-width:860px; margin-left:auto; margin-right:auto; }

/* ---- Tablet (≤900px) ---- */
@media (max-width:900px) {
    .widget-row1 { grid-template-columns:1fr 1fr; }
    .widget-row1 > :nth-child(3),
    .widget-row1 > :nth-child(4) { grid-column: span 1; }  /* Luggage + Passengers share row */
    .widget-row2 { grid-template-columns:1fr 1fr; }
    .widget-row2 > :last-child  { grid-column: 1 / -1; }  /* Reserve Now full-width */
    .widget-wrap { margin-top:-60px; }
    .hero-inner  { padding-bottom:100px; }
}

/* ---- Mobile (≤600px) ---- */
@media (max-width:600px) {
    .widget-row1 { grid-template-columns:1fr; gap:8px; margin-bottom:8px; }
    .widget-row2 { grid-template-columns:1fr; gap:8px; }
    .widget-wrap { margin-top:0; padding:0 1rem; }
    .widget-box  { max-width:100%; border-radius:12px; }
    .hero-inner  { min-height:420px; padding-top:80px; padding-bottom:32px; }
    .hero-text   { max-width:100%; }
    #tab-airport, #tab-hourly { padding:12px 18px !important; font-size:.8rem !important; }
    .widget-form { padding:16px !important; }
    /* Ensure button is tall enough to tap */
    .widget-btn  { padding:13px 20px !important; font-size:.85rem !important; }
}
</style>

{{-- ============================================================
     HERO SECTION
     Dark background with Escalade image right-aligned, headline left
     ============================================================ --}}
<section class="relative bg-black" style="min-height:560px;">

    {{-- Background: full-bleed image, dimmed --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero.png') }}"
             alt="Luxury Escalade on Airfield"
             class="w-full h-full object-cover"
             style="opacity:.55;object-position:center right;">
        {{-- Left-side darkening gradient so text stays readable --}}
        <div class="absolute inset-0"
             style="background:linear-gradient(to right,rgba(0,0,0,.85) 0%,rgba(0,0,0,.5) 50%,rgba(0,0,0,.1) 100%);"></div>
    </div>

    {{-- Hero content --}}
    <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-16 flex items-center hero-inner">
        <div class="hero-text">
            <h1 class="font-serif font-bold leading-tight text-white"
                style="font-size:clamp(2.6rem,6vw,4.2rem);font-family:'Playfair Display',serif;">
                <span style="color:#c5a059;font-style:italic;">Elevate</span> Your<br>
                <span style="color:#c5a059;">Colorado</span> Journey
            </h1>
            <p class="mt-5 text-gray-300" style="font-size:1.05rem;max-width:380px;font-family:Montserrat,sans-serif;">
                Experience premium transportation with professional chauffeurs.
            </p>
        </div>
    </div>

</section>

{{-- ============================================================
     BOOKING WIDGET — sits below hero, overlapping upward via negative margin
     ============================================================ --}}
<div class="relative z-20 bg-transparent px-6 md:px-16 widget-wrap">
    <div class="widget-box">
        <div class="bg-white rounded-xl shadow-2xl border border-gray-200" style="overflow:visible;">

            {{-- Tabs --}}
            <div style="display:flex;border-bottom:1px solid #e5e7eb;background:#f9fafb;border-radius:12px 12px 0 0;overflow:hidden;">
                <button type="button" id="tab-airport"
                        onclick="setServiceMode('airport')"
                        style="padding:14px 28px;font-family:Montserrat,sans-serif;font-size:.88rem;font-weight:600;color:#111;background:#fff;border:none;border-bottom:2px solid #c5a059;cursor:pointer;letter-spacing:.01em;">
                    Airport Transfer
                </button>
                <button type="button" id="tab-hourly"
                        onclick="setServiceMode('hourly')"
                        style="padding:14px 28px;font-family:Montserrat,sans-serif;font-size:.88rem;font-weight:600;color:#9ca3af;background:transparent;border:none;border-bottom:2px solid transparent;cursor:pointer;letter-spacing:.01em;">
                    Hourly Service
                </button>
            </div>

            {{-- Form --}}
            <form action="/search-results" method="GET" class="widget-form" style="padding:20px 24px 22px;">
                <input type="hidden" id="service_type" name="service_type" value="airport">
                {{-- Distance hidden field — populated by JS before submit --}}
                <input type="hidden" id="distance_miles" name="distance_miles" value="0">

                {{-- Row 1: Pickup | Drop-Off | Passengers --}}
                <div class="widget-row1">

                    {{-- Pickup Location --}}
                    <div>
                        <label style="display:block;font-family:Montserrat,sans-serif;font-size:.67rem;font-weight:600;color:#9ca3af;letter-spacing:.06em;text-transform:uppercase;margin-bottom:5px;">Pickup Location</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:17px;color:#c5a059;">my_location</span>
                            <input type="text" id="pickup" name="pickup" required
                                   placeholder="Pickup Location"
                                   autocomplete="off"
                                   value=""
                                   style="width:100%;padding:9px 12px 9px 34px;border:1px solid #e5e7eb;border-radius:4px;font-family:Montserrat,sans-serif;font-size:.83rem;color:#374151;outline:none;box-sizing:border-box;">
                            <div id="pickup-suggestions" class="dv-suggestions d-none" role="listbox"></div>
                        </div>
                    </div>

                    {{-- Drop-Off Location --}}
                    <div id="dropoff-wrapper">
                        <label style="display:block;font-family:Montserrat,sans-serif;font-size:.67rem;font-weight:600;color:#9ca3af;letter-spacing:.06em;text-transform:uppercase;margin-bottom:5px;">Drop-Off Location</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:17px;color:#c5a059;">location_on</span>
                            <input type="text" id="dropoff" name="dropoff"
                                   placeholder="Drop-Off Location"
                                   autocomplete="off"
                                   value=""
                                   style="width:100%;padding:9px 12px 9px 34px;border:1px solid #e5e7eb;border-radius:4px;font-family:Montserrat,sans-serif;font-size:.83rem;color:#374151;outline:none;box-sizing:border-box;">
                            <div id="dropoff-suggestions" class="dv-suggestions d-none" role="listbox"></div>
                        </div>
                        {{-- Distance badge shown after both fields are filled --}}
                        <div id="distance-badge" style="display:none;margin-top:5px;font-family:Montserrat,sans-serif;font-size:.72rem;color:#c5a059;font-weight:600;display:flex;align-items:center;gap:4px;">
                            <span class="material-symbols-outlined" style="font-size:13px;">route</span>
                            <span id="distance-text"></span>
                        </div>
                    </div>

                    {{-- Duration (hourly mode only) --}}
                    <div id="duration-wrapper" style="display:none;">
                        <label style="display:block;font-family:Montserrat,sans-serif;font-size:.67rem;font-weight:600;color:#9ca3af;letter-spacing:.06em;text-transform:uppercase;margin-bottom:5px;">Duration</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:17px;color:#c5a059;">schedule</span>
                            <select id="duration" name="duration"
                                    style="width:100%;padding:9px 32px 9px 34px;border:1px solid #e5e7eb;border-radius:4px;font-family:Montserrat,sans-serif;font-size:.83rem;color:#374151;outline:none;background:#fff;box-sizing:border-box;appearance:none;">
                                <option value="" disabled selected>Select Duration</option>
                                <option value="3">3 Hours</option>
                                <option value="4">4 Hours</option>
                                <option value="5">5 Hours</option>
                                <option value="6">6 Hours</option>
                                <option value="8">8 Hours</option>
                                <option value="12">12 Hours</option>
                            </select>
                            <span class="material-symbols-outlined" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:15px;color:#9ca3af;pointer-events:none;">expand_more</span>
                        </div>
                    </div>

                    {{-- Luggage --}}
                    <div>
                        <label style="display:block;font-family:Montserrat,sans-serif;font-size:.67rem;font-weight:600;color:#9ca3af;letter-spacing:.06em;text-transform:uppercase;margin-bottom:5px;">Luggage</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:17px;color:#c5a059;">luggage</span>
                            <select id="luggage" name="luggage"
                                    style="width:100%;padding:9px 28px 9px 34px;border:1px solid #e5e7eb;border-radius:4px;font-family:Montserrat,sans-serif;font-size:.83rem;color:#374151;outline:none;background:#fff;box-sizing:border-box;appearance:none;">
                                <option value="0">0 Bags</option>
                                <option value="1">1 Bag</option>
                                <option value="2" selected>2 Bags</option>
                                <option value="3">3 Bags</option>
                                <option value="4">4 Bags</option>
                                <option value="5">5 Bags</option>
                                <option value="6">6 Bags</option>
                                <option value="10">7–10 Bags</option>
                                <option value="14">10+ Bags</option>
                            </select>
                            <span class="material-symbols-outlined" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);font-size:15px;color:#9ca3af;pointer-events:none;">expand_more</span>
                        </div>
                    </div>

                    {{-- Passengers --}}
                    <div>
                        <label style="display:block;font-family:Montserrat,sans-serif;font-size:.67rem;font-weight:600;color:#9ca3af;letter-spacing:.06em;text-transform:uppercase;margin-bottom:5px;">Passengers</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:17px;color:#c5a059;">group</span>
                            <select id="passengers" name="passengers"
                                    style="width:100%;padding:9px 28px 9px 34px;border:1px solid #e5e7eb;border-radius:4px;font-family:Montserrat,sans-serif;font-size:.83rem;color:#374151;outline:none;background:#fff;box-sizing:border-box;appearance:none;">
                                <option value="1">1</option>
                                <option value="2" selected>2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="14">8–14</option>
                            </select>
                            <span class="material-symbols-outlined" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);font-size:16px;color:#9ca3af;pointer-events:none;">expand_more</span>
                        </div>
                    </div>
                </div>

                {{-- Row 2: Date | Time | Reserve Now --}}
                <div class="widget-row2">

                    {{-- Date --}}
                    <div>
                        <label style="display:block;font-family:Montserrat,sans-serif;font-size:.67rem;font-weight:600;color:#9ca3af;letter-spacing:.06em;text-transform:uppercase;margin-bottom:5px;">Date</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:17px;color:#c5a059;">calendar_month</span>
                            <input type="date" id="date" name="date" required
                                   placeholder="Centre. Date"
                                   style="width:100%;padding:9px 12px 9px 34px;border:1px solid #e5e7eb;border-radius:4px;font-family:Montserrat,sans-serif;font-size:.83rem;color:#9ca3af;outline:none;box-sizing:border-box;">
                        </div>
                    </div>

                    {{-- Time --}}
                    <div>
                        <label style="display:block;font-family:Montserrat,sans-serif;font-size:.67rem;font-weight:600;color:#9ca3af;letter-spacing:.06em;text-transform:uppercase;margin-bottom:5px;">Time</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:17px;color:#c5a059;">schedule</span>
                            <select name="time" id="time"
                                    style="width:100%;padding:9px 32px 9px 34px;border:1px solid #e5e7eb;border-radius:4px;font-family:Montserrat,sans-serif;font-size:.83rem;color:#9ca3af;outline:none;background:#fff;box-sizing:border-box;appearance:none;">
                                <option value="" disabled selected>Time</option>
                                @foreach(['06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','14:30','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00'] as $t)
                                    <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:16px;color:#9ca3af;pointer-events:none;">expand_more</span>
                        </div>
                    </div>

                    {{-- Reserve Now --}}
                    <div>
                        <button type="submit" class="widget-btn"
                                style="width:100%;height:100%;padding:10px 20px;background:linear-gradient(to right,#c8a45e,#d9b870);color:#fff;font-family:Montserrat,sans-serif;font-size:.82rem;font-weight:700;letter-spacing:.08em;border:none;border-radius:3px;cursor:pointer;transition:opacity .2s;white-space:nowrap;"
                                onmouseover="this.style.opacity='.9'" onmouseout="this.style.opacity='1'">
                            Reserve Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================
     OUR FLEET
     ============================================================ --}}
<section class="bg-white py-20">
    <div class="max-w-6xl mx-auto px-6 md:px-16">
        <div class="text-center mb-12">
            <h2 class="font-bold text-gray-900" style="font-size:2rem;font-family:'Playfair Display',serif;">Our Fleet</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(($vehicles ?? \App\Models\Vehicle::all()) as $vehicle)
            <div class="group text-center">
                <div class="relative rounded-lg overflow-hidden" style="aspect-ratio:4/3;">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         src="{{ $vehicle->image }}"
                         alt="{{ $vehicle->name }}">
                    <div class="absolute bottom-0 left-0 right-0 flex justify-center pb-3">
                        <span class="text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-sm"
                              style="background:#c5a059;font-family:Montserrat,sans-serif;">{{ $vehicle->class }}</span>
                    </div>
                </div>
                <p class="mt-4 font-bold text-gray-900" style="font-size:1rem;font-family:Montserrat,sans-serif;">{{ $vehicle->name }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     WHY CHOOSE US
     ============================================================ --}}
<section class="bg-white py-20 border-t border-gray-100">
    <div class="max-w-6xl mx-auto px-6 md:px-16">
        <div class="text-center mb-14">
            <h2 class="font-bold text-gray-900" style="font-size:2rem;font-family:'Playfair Display',serif;">Why Choose Us</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">

            {{-- Chauffeurs --}}
            <div class="flex flex-col items-center space-y-4 px-4">
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="28" cy="18" r="8" stroke="#c5a059" stroke-width="2"/>
                    <path d="M14 42c0-7.732 6.268-14 14-14s14 6.268 14 14" stroke="#c5a059" stroke-width="2" stroke-linecap="round"/>
                    <path d="M22 24l-4 6h20l-4-6" stroke="#c5a059" stroke-width="1.5" stroke-linecap="round"/>
                    <circle cx="28" cy="8" r="3" stroke="#c5a059" stroke-width="1.5"/>
                </svg>
                <h3 class="font-bold text-gray-900 text-base" style="font-family:Montserrat,sans-serif;">Professional Chauffeurs</h3>
                <p class="text-gray-500 text-sm leading-relaxed" style="font-family:Montserrat,sans-serif;max-width:260px;">
                    Rigorous vetting, ongoing safety training, and advanced driver monitoring ensure a secure, premium journey.
                </p>
            </div>

            {{-- Reliable Service --}}
            <div class="flex flex-col items-center space-y-4 px-4">
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="28" cy="28" r="18" stroke="#c5a059" stroke-width="2"/>
                    <path d="M20 28l5.5 5.5L37 22" stroke="#c5a059" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="font-bold text-gray-900 text-base" style="font-family:Montserrat,sans-serif;">Reliable Service</h3>
                <p class="text-gray-500 text-sm leading-relaxed" style="font-family:Montserrat,sans-serif;max-width:260px;">
                    Real-time tracking, guaranteed arrival times, and meticulous vehicle maintenance ensure absolute dependability.
                </p>
            </div>

            {{-- Effortless Booking --}}
            <div class="flex flex-col items-center space-y-4 px-4">
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="14" y="10" width="28" height="36" rx="3" stroke="#c5a059" stroke-width="2"/>
                    <path d="M20 20h16M20 27h16M20 34h10" stroke="#c5a059" stroke-width="1.5" stroke-linecap="round"/>
                    <circle cx="38" cy="38" r="7" fill="white" stroke="#c5a059" stroke-width="1.5"/>
                    <path d="M35 38l2 2 4-4" stroke="#c5a059" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="font-bold text-gray-900 text-base" style="font-family:Montserrat,sans-serif;">Effortless Booking</h3>
                <p class="text-gray-500 text-sm leading-relaxed" style="font-family:Montserrat,sans-serif;max-width:260px;">
                    Streamlined search, transparent receipts, and dynamic traveler dashboards make scheduling effortless.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     Location Autocomplete — travaiq API
     ============================================================ --}}
<style>
/* Suggestion dropdown */
.dv-suggestions {
    position: absolute;
    top: calc(100% + 3px);
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    box-shadow: 0 8px 24px rgba(0,0,0,.10);
    font-family: Montserrat, sans-serif;
    font-size: .83rem;
    max-height: 240px;
    overflow-y: auto;
    z-index: 9999;
    /* Hidden by default */
}
.dv-suggestions.d-none { display: none !important; }
.dv-suggestions.show   { display: block !important; }
.dv-suggestion-item {
    padding: 9px 14px;
    cursor: pointer;
    border-top: 1px solid #f3f4f6;
    color: #374151;
    line-height: 1.5;
    display: flex;
    align-items: center;
    gap: 8px;
}
.dv-suggestion-item:first-child { border-top: none; }
.dv-suggestion-item:hover {
    background: #fffbf2;
    color: #111827;
}
.dv-suggestion-item .dv-pin {
    color: #c5a059;
    font-size: 16px;
    flex-shrink: 0;
}
.dv-suggestion-item.dv-loading {
    color: #9ca3af;
    cursor: default;
    gap: 10px;
}
/* Keyboard-active item */
.dv-suggestion-item.dv-active {
    background: #fffbf2;
    color: #111827;
}
/* Spin animation for loading icon */
@keyframes dv-spin { to { transform: rotate(360deg); } }
.dv-spin { animation: dv-spin .7s linear infinite; display:inline-block; }
/* Two-line suggestion item layout */
.dv-item-body   { display:flex; flex-direction:column; gap:1px; min-width:0; }
.dv-item-name   { white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color:#374151; font-size:.83rem; }
.dv-item-type   { font-size:.68rem; color:#c5a059; font-weight:600; letter-spacing:.04em; text-transform:uppercase; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    /* ---- Tab switching ---- */
    window.setServiceMode = function(mode) {
        const svcInput     = document.getElementById('service_type');
        const dropoffWrap  = document.getElementById('dropoff-wrapper');
        const durationWrap = document.getElementById('duration-wrapper');
        const pickupInput  = document.getElementById('pickup');
        const dropoffInput = document.getElementById('dropoff');

        if (mode === 'airport') {
            svcInput.value = 'airport';
            document.getElementById('tab-airport').style.cssText = 'padding:14px 28px;font-family:Montserrat,sans-serif;font-size:.88rem;font-weight:600;color:#111;background:#fff;border:none;border-bottom:2px solid #c5a059;cursor:pointer;letter-spacing:.01em;';
            document.getElementById('tab-hourly').style.cssText  = 'padding:14px 28px;font-family:Montserrat,sans-serif;font-size:.88rem;font-weight:600;color:#9ca3af;background:transparent;border:none;border-bottom:2px solid transparent;cursor:pointer;letter-spacing:.01em;';
            dropoffWrap.style.display  = '';
            durationWrap.style.display = 'none';
            if (pickupInput)  pickupInput.placeholder = 'Pickup Location';
            if (dropoffInput) { dropoffInput.required = true; dropoffInput.placeholder = 'Drop-Off Location'; }
        } else {
            svcInput.value = 'hourly';
            document.getElementById('tab-hourly').style.cssText  = 'padding:14px 28px;font-family:Montserrat,sans-serif;font-size:.88rem;font-weight:600;color:#111;background:#fff;border:none;border-bottom:2px solid #c5a059;cursor:pointer;letter-spacing:.01em;';
            document.getElementById('tab-airport').style.cssText = 'padding:14px 28px;font-family:Montserrat,sans-serif;font-size:.88rem;font-weight:600;color:#9ca3af;background:transparent;border:none;border-bottom:2px solid transparent;cursor:pointer;letter-spacing:.01em;';
            dropoffWrap.style.display  = 'none';
            durationWrap.style.display = '';
            if (pickupInput)  pickupInput.placeholder = 'Pickup Location';
            if (dropoffInput) { dropoffInput.required = false; }
            // Clear distance when switching to hourly
            clearDistance();
        }
    };

    /* ================================================================
       PHOTON (Komoot/OSM) — POI Autocomplete
       ✅ Free, no API key — finds airports, hotels, addresses, venues
       ✅ Returns lat/lon per result → distance computed instantly
       ================================================================ */

    // Stored coords from the last-selected suggestion for each field
    const coords = { '#pickup': null, '#dropoff': null };

    const $distanceInput = $('#distance_miles');
    const $distanceBadge = $('#distance-badge');
    const $distanceText  = $('#distance-text');

    function haversineDistance(lat1, lon1, lat2, lon2) {
        const R    = 3958.8;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a    = Math.sin(dLat/2) * Math.sin(dLat/2)
                   + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180)
                   * Math.sin(dLon/2) * Math.sin(dLon/2);
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    }

    function clearDistance() {
        $distanceInput.val(0);
        $distanceBadge.hide();
        $distanceText.text('');
    }

    /** Called after a suggestion is selected — uses stored coords, no extra API call. */
    function tryComputeDistance() {
        const from = coords['#pickup'];
        const to   = coords['#dropoff'];
        if (!from || !to) { clearDistance(); return; }
        const roadMiles = haversineDistance(from.lat, from.lon, to.lat, to.lon) * 1.15;
        $distanceInput.val(roadMiles.toFixed(2));
        $distanceText.text('~' + roadMiles.toFixed(1) + ' miles drive');
        $distanceBadge.show();
    }

    /** Map Photon OSM type to a Material icon + label for the dropdown row. */
    function placeIcon(feature) {
        const type = (feature.properties.type      || '').toLowerCase();
        const osm  = (feature.properties.osm_value || feature.properties.osm_key || '').toLowerCase();
        if (type === 'aerodrome' || osm === 'aerodrome' || osm === 'airport')
            return { icon: 'flight',         label: 'Airport' };
        if (type === 'hotel' || osm === 'hotel' || type === 'motel' || type === 'hostel')
            return { icon: 'hotel',          label: 'Hotel' };
        if (osm === 'station' || type === 'station' || osm === 'bus_station')
            return { icon: 'train',          label: 'Station' };
        if (type === 'house' || type === 'street' || type === 'road')
            return { icon: 'home',           label: 'Address' };
        if (type === 'city' || type === 'town' || type === 'village')
            return { icon: 'location_city',  label: 'City' };
        return   { icon: 'location_on',     label: 'Place' };
    }

    /** Build "Name, Street, City, State" from a Photon feature. */
    function buildDisplayText(feature) {
        const p = feature.properties;
        return [p.name, p.street, p.city, p.state].filter(Boolean).join(', ') || 'Unknown location';
    }

    /* ---- Photon autocomplete setup ---- */
    function setupLocationSearch(inputId, suggestionsId) {
        let searchTimeout;
        const $input = $(inputId);
        const $box   = $(suggestionsId);

        const loadingHtml = `
            <div class="dv-suggestion-item dv-loading">
                <span class="material-symbols-outlined dv-spin dv-pin">refresh</span>
                <span>Searching places…</span>
            </div>`;

        $input.on('input', function () {
            const term = $(this).val().trim();
            clearTimeout(searchTimeout);
            coords[inputId] = null; // coords are stale when user types again
            clearDistance();

            if (term.length < 2) {
                $box.removeClass('show').addClass('d-none').html('');
                return;
            }

            $box.html(loadingHtml).removeClass('d-none').addClass('show');

            searchTimeout = setTimeout(function () {
                // Soft location bias toward Denver, CO (lat/lon) — NOT a hard filter.
                // Using bbox was blocking all results; lat/lon just ranks nearby results higher.
                const url = 'https://photon.komoot.io/api/'
                          + '?q='    + encodeURIComponent(term)
                          + '&limit=8&lang=en'
                          + '&lat=39.7392&lon=-104.9903'; // Denver, CO center

                fetch(url)
                    .then(r => r.json())
                    .then(function (data) {
                        const features = ((data || {}).features || [])
                            // Keep US results and results with no country tag
                            .filter(f => {
                                const c = f.properties.country || '';
                                return !c || c === 'United States of America' || c === 'United States';
                            });

                        if (!features.length) {
                            $box.html('<div class="dv-suggestion-item dv-loading"><span class="material-symbols-outlined dv-pin">search_off</span><span>No results found — try a different search</span></div>').addClass('show');
                            return;
                        }

                        let html = '';
                        features.forEach(function (feature) {
                            const text         = $('<div>').text(buildDisplayText(feature)).html();
                            const { icon, label } = placeIcon(feature);
                            const [lon, lat]   = feature.geometry.coordinates;
                            html += `<div class="dv-suggestion-item" role="option"
                                          data-lat="${lat}" data-lon="${lon}" data-text="${text}">
                                         <span class="material-symbols-outlined dv-pin">${icon}</span>
                                         <span class="dv-item-body">
                                             <span class="dv-item-name">${text}</span>
                                             <span class="dv-item-type">${label}</span>
                                         </span>
                                     </div>`;
                        });
                        $box.html(html).removeClass('d-none').addClass('show');
                    })
                    .catch(function () {
                        $box.html('<div class="dv-suggestion-item dv-loading"><span class="material-symbols-outlined dv-pin">wifi_off</span><span>Could not load suggestions</span></div>').addClass('show');
                    });
            }, 280);
        });

        // ---- Select a suggestion — store coords, compute distance immediately ----
        $box.on('click', '.dv-suggestion-item', function () {
            const $item = $(this);
            if ($item.hasClass('dv-loading')) return;
            const text = $item.data('text');
            const lat  = parseFloat($item.data('lat'));
            const lon  = parseFloat($item.data('lon'));
            if (!text) return;
            $input.val(text);
            $box.removeClass('show').addClass('d-none').html('');
            coords[inputId] = { lat, lon };
            tryComputeDistance();
        });

        // Block form submit on Enter while dropdown is visible
        $input.on('keydown', function (e) {
            if (e.key === 'Enter' && $box.hasClass('show')) {
                e.preventDefault();
            }
        });

        // Keyboard nav: highlight items with arrow keys + select with Enter
        $input.on('keydown', function (e) {
            if (!$box.hasClass('show')) return;
            const $items = $box.find('.dv-suggestion-item:not(.dv-loading)');
            const $active = $box.find('.dv-suggestion-item.dv-active');
            let idx = $items.index($active);

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                $items.removeClass('dv-active');
                idx = (idx + 1) % $items.length;
                $items.eq(idx).addClass('dv-active');
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                $items.removeClass('dv-active');
                idx = (idx - 1 + $items.length) % $items.length;
                $items.eq(idx).addClass('dv-active');
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if ($active.length) {
                    const text = $active.data('text');
                    const lat  = parseFloat($active.data('lat'));
                    const lon  = parseFloat($active.data('lon'));
                    $input.val(text);
                    $box.removeClass('show').addClass('d-none').html('');
                    coords[inputId] = { lat, lon };
                    tryComputeDistance();
                }
            } else if (e.key === 'Escape') {
                $box.removeClass('show').addClass('d-none').html('');
            }
        });

        // Close on outside click
        $(document).on('click', function (e) {
            if (!$(e.target).closest($input.parent()).length) {
                $box.removeClass('show').addClass('d-none').html('');
            }
        });
    }

    setupLocationSearch('#pickup',  '#pickup-suggestions');
    setupLocationSearch('#dropoff', '#dropoff-suggestions');

});
</script>

@endsection
