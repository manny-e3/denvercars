@extends('layouts.app')

@section('title', 'Booking Confirmation | Denver Limo Cars')

@section('content')
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
    
    <!-- Progress Indicator -->
    <div class="max-w-3xl mx-auto mb-12">
        <div class="flex items-center justify-between text-xs md:text-sm uppercase tracking-widest font-semibold font-body-sm">
            <span class="text-primary flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-primary/20 border border-primary text-primary">1</span> Select Vehicle</span>
            <span class="w-12 md:w-24 h-[1px] bg-primary"></span>
            <span class="text-primary flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-primary/20 border border-primary text-primary">2</span> Checkout</span>
            <span class="w-12 md:w-24 h-[1px] bg-primary"></span>
            <span class="text-primary flex items-center gap-2"><span class="w-6 h-6 flex items-center justify-center rounded-full bg-primary/20 border border-primary text-primary">3</span> Confirmation</span>
        </div>
    </div>

    <!-- 2-Column Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
        
        <!-- Left: Booking Summary & Payment Selection -->
        <div class="lg:col-span-8 space-y-8">
            <!-- 1. Review Booking Details -->
            <div class="bg-surface-container p-6 rounded-xl border border-outline/15 shadow-md space-y-6">
                <h2 class="font-headline-md text-headline-md text-primary flex items-center gap-2 border-b border-outline/10 pb-4">
                    <span class="material-symbols-outlined text-[24px]">assignment_turned_in</span>
                    Review Reservation Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-body-md text-on-surface-variant">
                    <div class="space-y-4">
                        <div>
                            <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-1">Passenger Name</p>
                            <p class="text-white font-semibold">{{ $booking['first_name'] }} {{ $booking['last_name'] }}</p>
                        </div>
                        <div>
                            <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-1">Email Address</p>
                            <p class="text-white font-semibold">{{ $booking['email'] }}</p>
                        </div>
                        <div>
                            <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-1">Phone Number</p>
                            <p class="text-white font-semibold">{{ $booking['phone'] }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-1">Travelers & Luggage</p>
                            <p class="text-white font-semibold">{{ $booking['passengers'] }} passengers, {{ $booking['luggage'] }} bags</p>
                        </div>
                        @if(!empty($booking['flight_number']))
                            <div>
                                <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-1">Flight Details</p>
                                <p class="text-white font-semibold">{{ $booking['flight_number'] }}</p>
                            </div>
                        @endif
                        @if(!empty($booking['notes']))
                            <div>
                                <p class="font-label-sm text-label-sm text-primary uppercase tracking-wider mb-1">Concierge Instructions</p>
                                <p class="text-white font-semibold italic">"{{ $booking['notes'] }}"</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 2. Payment Gateway Selection Form -->
            <form action="/checkout/store" method="POST" class="space-y-8">
                @csrf
                
                <div class="bg-surface-container p-6 rounded-xl border border-outline/15 shadow-md space-y-6">
                    <div class="flex justify-between items-center">
                        <h2 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined text-[24px]">payments</span>
                            Select Payment Method
                        </h2>
                        <span class="material-symbols-outlined text-primary text-xl" title="SSL Secure 256-bit encryption">lock</span>
                    </div>

                    <!-- Gateway Tabs / Radios -->
                    @if($gateways->isEmpty())
                        <div class="p-5 rounded-xl bg-surface border border-outline/10 space-y-4">
                            <div class="flex items-center gap-2 text-primary">
                                <span class="material-symbols-outlined">info</span>
                                <span class="font-semibold text-sm uppercase tracking-wider">Offline Booking Confirmation</span>
                            </div>
                            <p class="text-body-sm text-on-surface-variant/80">No payment gateways are currently active. You can confirm your booking reservation now. Our admin team will contact you to coordinate payment details.</p>
                            <input type="hidden" name="payment_method" value="none">
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($gateways as $gateway)
                                <label class="relative flex flex-col p-4 rounded-xl border cursor-pointer transition-all duration-300 bg-surface/50 hover:bg-surface select-none {{ $loop->first ? 'border-primary shadow-[0_0_15px_rgba(197,160,89,0.15)]' : 'border-outline/15' }}" id="gateway-label-{{ $gateway->slug }}">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-semibold text-white text-body-md flex items-center gap-2">
                                            @if($gateway->slug === 'bank_transfer')
                                                <span class="material-symbols-outlined text-primary">account_balance</span>
                                            @else
                                                <span class="material-symbols-outlined text-primary">credit_card</span>
                                            @endif
                                            {{ $gateway->name }}
                                        </span>
                                        <input type="radio" name="payment_method" value="{{ $gateway->slug }}" class="accent-primary w-4 h-4" {{ $loop->first ? 'checked' : '' }} onchange="switchPaymentMethod('{{ $gateway->slug }}')">
                                    </div>
                                    <span class="text-xs text-on-surface-variant/70">
                                        @if($gateway->slug === 'bank_transfer')
                                            Direct bank deposit or wire transfer
                                        @else
                                            Pay online securely via {{ $gateway->name }}
                                        @endif
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Payment Details Area -->
                        @foreach($gateways as $gateway)
                            <div id="payment-details-{{ $gateway->slug }}" class="payment-method-details space-y-6 mt-6 {{ $loop->first ? '' : 'hidden' }}">
                                @if($gateway->slug === 'bank_transfer')
                                    <!-- Bank Transfer Details -->
                                    <div class="p-5 rounded-xl bg-surface border border-outline/10 space-y-4">
                                        <div class="flex items-center gap-2 text-primary">
                                            <span class="material-symbols-outlined">info</span>
                                            <span class="font-semibold text-sm uppercase tracking-wider">Bank Wire Instructions</span>
                                        </div>
                                        <p class="text-body-sm text-on-surface-variant/80">Please transfer the total amount to the account below. After booking, please send your confirmation receipt to our customer concierge.</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-2">
                                            <div class="p-3 bg-surface-container-high rounded-lg border border-outline/5">
                                                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Bank Name</p>
                                                <p class="text-white text-sm font-semibold">{{ $gateway->config['bank_name'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="p-3 bg-surface-container-high rounded-lg border border-outline/5">
                                                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Account Number</p>
                                                <p class="text-white text-sm font-mono font-semibold tracking-wider">{{ $gateway->config['account_number'] ?? 'N/A' }}</p>
                                            </div>
                                            <div class="p-3 bg-surface-container-high rounded-lg border border-outline/5">
                                                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Account Name</p>
                                                <p class="text-white text-sm font-semibold">{{ $gateway->config['account_name'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Online Payment Info -->
                                    <div class="p-5 rounded-xl bg-surface border border-outline/10 space-y-4">
                                        <div class="flex items-center gap-2 text-primary">
                                            <span class="material-symbols-outlined">payments</span>
                                            <span class="font-semibold text-sm uppercase tracking-wider">Secure Online Payment</span>
                                        </div>
                                        <p class="text-body-sm text-on-surface-variant/80">You will be securely redirected to the <strong>{{ $gateway->name }}</strong> payment portal to complete your transaction once you click the button below.</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Secure Confirmation Submit Button -->
                <div class="pt-4 flex flex-col items-center gap-3">
                    <button type="submit" class="w-full bg-primary text-on-primary font-label-lg text-label-lg py-4 rounded-md hover:bg-primary-fixed transition-all duration-300 shadow-[0_4px_20px_rgba(197,160,89,0.4)] flex items-center justify-center gap-2">
                        @if($gateways->isEmpty())
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                            Send Booking Request
                        @else
                            <span class="material-symbols-outlined text-[20px]">verified_user</span>
                            Confirm &amp; Book Reservation
                        @endif
                    </button>
                    <p class="font-body-sm text-body-sm text-on-surface-variant opacity-60 text-center flex items-center gap-1.5">
                        @if($gateways->isEmpty())
                            <span class="material-symbols-outlined text-sm">support_agent</span>
                            Our concierge team will reach out to you to arrange payment and finalize your booking.
                        @else
                            <span class="material-symbols-outlined text-sm">lock</span>
                            Your booking is encrypted and securely processed by premium SSL protocols.
                        @endif
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
            <div class="space-y-4 border-b border-outline/10 pb-4 text-body-md text-on-surface-variant">
                <div class="flex gap-3">
                    <span class="material-symbols-outlined text-primary text-xl">event</span>
                    <div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Date &amp; Time</p>
                        <p class="font-body-md text-body-md text-white">{{ \Carbon\Carbon::parse($booking['date'])->format('M d, Y') }} at {{ $booking['time'] }}</p>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <span class="material-symbols-outlined text-primary text-xl">my_location</span>
                    <div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Pickup</p>
                        <p class="font-body-md text-body-md text-white">{{ $booking['pickup'] }}</p>
                    </div>
                </div>

                @if($booking['service_type'] === 'airport')
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">location_on</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Dropoff</p>
                            <p class="font-body-md text-body-md text-white">{{ $booking['dropoff'] }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">schedule</span>
                        <div>
                            <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Duration</p>
                            <p class="font-body-md text-body-md text-white">{{ $booking['duration'] }} Hours (As-Directed)</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Cost Breakdown -->
            <div class="space-y-3 font-body-md">
                @php
                    $rate = $booking['service_type'] === 'airport' ? $vehicle['airport_rate'] : ($vehicle['hourly_rate'] * $booking['duration']);
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
                    <span class="text-primary font-bold">${{ number_format($booking['total'], 2) }}</span>
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- =====================================================
     Offline Booking Success Modal
     Shown via JS after a successful fetch() submission
     ===================================================== -->
<div id="offline-success-modal" class="fixed inset-0 z-[9999] flex items-center justify-center hidden" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" id="modal-backdrop"></div>

    <!-- Panel -->
    <div class="relative z-10 w-full max-w-md mx-4 bg-surface-container rounded-2xl border border-outline/20 shadow-2xl overflow-hidden"
         style="animation: modalSlideIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both">

        <!-- Gold top bar -->
        <div class="h-1.5 w-full bg-gradient-to-r from-primary via-yellow-400 to-primary"></div>

        <div class="p-8 flex flex-col items-center text-center gap-5">
            <!-- Animated check icon -->
            <div class="w-20 h-20 rounded-full bg-primary/10 border-2 border-primary flex items-center justify-center"
                 style="animation: pulseBadge 1.8s ease-in-out infinite">
                <span class="material-symbols-outlined text-primary" style="font-size:42px">check_circle</span>
            </div>

            <div class="space-y-2">
                <h2 id="modal-title" class="font-headline-md text-headline-md text-white">Booking Request Received</h2>
                <p class="text-on-surface-variant/80 text-body-sm">Your reservation has been submitted successfully.</p>
            </div>

            <!-- Reference badge -->
            <div class="w-full bg-surface rounded-xl border border-outline/10 px-5 py-4 space-y-1">
                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Reservation Reference</p>
                <p id="modal-ref-id" class="text-primary font-mono font-bold text-lg tracking-widest">---</p>
            </div>

            <p class="text-on-surface-variant/70 text-body-sm leading-relaxed">
                Our concierge team will contact you shortly at
                <span id="modal-email" class="text-white font-semibold"></span>
                to coordinate payment and confirm your trip details.
            </p>

            <!-- Actions -->
            <div class="w-full flex flex-col gap-3 pt-1">
                <a href="/" class="w-full bg-primary text-on-primary font-label-lg py-3 rounded-md hover:bg-primary-fixed transition-all duration-300 flex items-center justify-center gap-2 shadow-[0_4px_20px_rgba(197,160,89,0.35)]">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    Back to Homepage
                </a>
                <button type="button" onclick="document.getElementById('offline-success-modal').classList.add('hidden')" class="text-on-surface-variant/60 text-body-sm hover:text-white transition-colors">
                    Stay on this page
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes modalSlideIn {
    from { opacity: 0; transform: translateY(30px) scale(0.95); }
    to   { opacity: 1; transform: translateY(0)   scale(1); }
}
@keyframes pulseBadge {
    0%, 100% { box-shadow: 0 0 0 0   rgba(197,160,89,0.4); }
    50%       { box-shadow: 0 0 0 12px rgba(197,160,89,0);   }
}
</style>

<script>
const IS_OFFLINE = {{ $gateways->isEmpty() ? 'true' : 'false' }};

function switchPaymentMethod(slug) {
    document.querySelectorAll('.payment-method-details').forEach(el => {
        el.classList.add('hidden');
        el.querySelectorAll('input').forEach(input => {
            input.disabled = true;
            input.removeAttribute('required');
        });
    });
    document.querySelectorAll('[id^="gateway-label-"]').forEach(label => {
        label.classList.remove('border-primary', 'shadow-[0_0_15px_rgba(197,160,89,0.15)]');
        label.classList.add('border-outline/15');
    });
    const selectedDetails = document.getElementById('payment-details-' + slug);
    if (selectedDetails) {
        selectedDetails.classList.remove('hidden');
        selectedDetails.querySelectorAll('input').forEach(input => input.disabled = false);
    }
    const selectedLabel = document.getElementById('gateway-label-' + slug);
    if (selectedLabel) {
        selectedLabel.classList.remove('border-outline/15');
        selectedLabel.classList.add('border-primary', 'shadow-[0_0_15px_rgba(197,160,89,0.15)]');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
    if (checkedRadio) switchPaymentMethod(checkedRadio.value);

    // ── Offline AJAX interception ──────────────────────────────
    if (!IS_OFFLINE) return;

    const form = document.querySelector('form[action="/checkout/store"]');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        const originalHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[20px]">progress_activity</span> Sending&hellip;';

        try {
            const data = new FormData(form);
            const res = await fetch(form.action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                body: data,
            });

            const json = await res.json();

            if (res.ok && json.success) {
                // Populate modal
                document.getElementById('modal-ref-id').textContent = json.reservation_id ?? '---';
                document.getElementById('modal-email').textContent  = json.email ?? '';
                // Show modal
                const modal = document.getElementById('offline-success-modal');
                modal.classList.remove('hidden');
                // Close on backdrop click
                document.getElementById('modal-backdrop').addEventListener('click', () => modal.classList.add('hidden'));
            } else {
                alert(json.message ?? 'Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        } catch (err) {
            console.error(err);
            alert('Network error. Please check your connection and try again.');
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        }
    });
});
</script>
@endsection
