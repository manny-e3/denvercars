<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\PaymentGateway;
use App\Models\Customer;
use App\Models\RideBooking;
use App\Mail\AdminBookingNotification;
use App\Mail\CustomerBookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Search results showing matching vehicles and computed fares.
     */
    public function search(Request $request)
    {
        $search = $request->validate([
            'service_type'   => 'required|in:airport,hourly',
            'pickup'         => 'required|string',
            'dropoff'        => 'nullable|string',
            'duration'       => 'nullable|integer|min:3|max:12',
            'date'           => 'required|date',
            'time'           => 'required|string',
            'passengers'     => 'required|integer|min:1|max:14',
            'luggage'        => 'required|integer|min:0|max:14',
            'distance_miles' => 'nullable|numeric|min:0',
        ]);

        $vehicles = Vehicle::where('status', 'Active')->get()->map(function ($vehicle) use ($search) {
            $reqPassengers = (int) $search['passengers'];
            $reqLuggage    = (int) ($search['luggage'] ?? 0);

            // Eligibility check
            $eligible = ($reqPassengers <= $vehicle->passengers)
                     && ($reqLuggage    <= $vehicle->luggage);

            // Ineligibility reason
            $ineligibleReason = '';
            if (!$eligible) {
                if ($reqPassengers > $vehicle->passengers && $reqLuggage > $vehicle->luggage) {
                    $ineligibleReason = 'Exceeds passenger & luggage capacity';
                } elseif ($reqPassengers > $vehicle->passengers) {
                    $ineligibleReason = 'Exceeds passenger capacity';
                } elseif ($reqLuggage > $vehicle->luggage) {
                    $ineligibleReason = 'Exceeds luggage capacity';
                }
            }

            // Fetch pricing rates from DB
            $rates = \App\Models\PricingRate::all()->pluck('value', 'key');
            $getRate = function($key, $default) use ($rates) {
                return isset($rates[$key]) ? (float)$rates[$key] : (float)$default;
            };

            // Fare Calculation
            $distanceMiles   = (float) ($search['distance_miles'] ?? 0);
            $flatRate        = $vehicle->airport_rate;

            // 1. Base rate
            $milesAllowed = null;
            if ($search['service_type'] === 'airport') {
                $baseDistanceThreshold = $getRate('airport_base_distance', 20);
                $extraMileRate = $getRate('airport_extra_mile_rate', 5.00);

                if ($distanceMiles > 0) {
                    $baseRate = ($distanceMiles <= $baseDistanceThreshold)
                        ? $flatRate
                        : $flatRate + ($distanceMiles - $baseDistanceThreshold) * $extraMileRate;
                } else {
                    $baseRate = $flatRate;
                }
            } else {
                $duration = (int) ($search['duration'] ?? 3);
                $minHours = (int) $getRate('hourly_minimum_hours', 2);
                $extraHourDiscountPercent = $getRate('hourly_extra_hour_discount', 40.00);
                $milesPerHour = $getRate('hourly_miles_per_hour', 25);
                $maxMilesCapped = (int) $getRate('hourly_max_miles_capped', 1);

                $hourlyFlatRate = $vehicle->hourly_rate * $minHours;

                if ($duration <= $minHours) {
                    $baseRate = $hourlyFlatRate;
                    $milesAllowed = $minHours * $milesPerHour;
                } else {
                    $extraHours = $duration - $minHours;
                    $discountFactor = 1 - ($extraHourDiscountPercent / 100);
                    $extraHourlyRate = round($vehicle->hourly_rate * $discountFactor, 2);
                    $extraFare = $extraHourlyRate * $extraHours;
                    $baseRate = $hourlyFlatRate + $extraFare;
                    
                    if ($maxMilesCapped == 1) {
                        $milesAllowed = $minHours * $milesPerHour;
                    } else {
                        $milesAllowed = $duration * $milesPerHour;
                    }
                }
            }

            // 2. Luggage surcharge
            $luggageSurchargeRate = $getRate('luggage_surcharge_per_bag', 4.00);
            $luggageFreeLimit = (int) $getRate('luggage_free_limit', 2);
            $luggageSurcharge = max(0, $reqLuggage - $luggageFreeLimit) * $luggageSurchargeRate;

            // 3. Passenger surcharge
            $passengerSurchargeRate = $getRate('passenger_surcharge_per_person', 3.00);
            $passengerFreeLimit = (int) $getRate('passenger_free_limit', 2);
            $passengerSurcharge = max(0, $reqPassengers - $passengerFreeLimit) * $passengerSurchargeRate;

            $fee = $getRate('airport_gate_fee', 15.00);

            // 4. Peak-Hour Surcharge
            $peakSurcharge = 0;
            if ($getRate('peak_surcharge_enabled', 0) == 1) {
                $peakStart = (int) $getRate('peak_start_time', 17);
                $peakEnd   = (int) $getRate('peak_end_time', 20);
                $bookingHour = (int) date('H', strtotime($search['time']));

                $isPeak = false;
                if ($peakStart <= $peakEnd) {
                    $isPeak = ($bookingHour >= $peakStart && $bookingHour < $peakEnd);
                } else {
                    $isPeak = ($bookingHour >= $peakStart || $bookingHour < $peakEnd);
                }

                if ($isPeak) {
                    $surchargeVal = $getRate('peak_surcharge_value', 0.00);
                    $isPercent = (int) $getRate('peak_surcharge_is_percent', 0);
                    if ($isPercent == 1) {
                        $peakSurcharge = round($baseRate * ($surchargeVal / 100), 2);
                    } else {
                        $peakSurcharge = $surchargeVal;
                    }
                }
            }

            $total = $baseRate + $luggageSurcharge + $passengerSurcharge + $fee + $peakSurcharge;

            // Inject attributes
            $vehicle->setAttribute('eligible', $eligible);
            $vehicle->setAttribute('ineligible_reason', $ineligibleReason);
            $vehicle->setAttribute('base_rate', $baseRate);
            $vehicle->setAttribute('luggage_surcharge', $luggageSurcharge);
            $vehicle->setAttribute('passenger_surcharge', $passengerSurcharge);
            $vehicle->setAttribute('gate_fee', $fee);
            $vehicle->setAttribute('peak_surcharge', $peakSurcharge);
            $vehicle->setAttribute('total_fare', $total);
            $vehicle->setAttribute('miles_allowed', $milesAllowed);

            return $vehicle;
        });

        return view('search-results', [
            'search'   => $search,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Checkout form with receipt summaries.
     */
    public function checkout(Request $request)
    {
        $search = $request->validate([
            'vehicle' => 'required|string',
            'pickup' => 'required|string',
            'dropoff' => 'nullable|string',
            'duration' => 'nullable|integer',
            'date' => 'required|date',
            'time' => 'required|string',
            'passengers' => 'required|integer',
            'luggage' => 'required|integer',
            'service_type' => 'required|string',
            'total' => 'required|numeric'
        ]);

        $vehicle = Vehicle::where('key', $search['vehicle'])->where('status', 'Active')->firstOrFail();

        return view('checkout', [
            'search' => $search,
            'vehicle' => $vehicle,
            'total' => $search['total']
        ]);
    }

    /**
     * Handle passenger validation and redirect to confirmation.
     */
    public function passenger(Request $request)
    {
        $validated = $request->validate([
            'vehicle' => 'required|string',
            'pickup' => 'required|string',
            'dropoff' => 'nullable|string',
            'duration' => 'nullable|integer',
            'date' => 'required|date',
            'time' => 'required|string',
            'passengers' => 'required|integer',
            'luggage' => 'required|integer',
            'service_type' => 'required|string',
            'total' => 'required|numeric',
            
            // Passenger details
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'flight_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Fetch vehicle name to display it nicely
        $vehicle = Vehicle::where('key', $validated['vehicle'])->where('status', 'Active')->first();
        $validated['vehicle_name'] = $vehicle ? ($vehicle->class . ' (' . $vehicle->name . ')') : $validated['vehicle'];

        session()->put('pending_booking', $validated);

        return redirect()->route('booking.confirmation');
    }

    /**
     * Show booking confirmation with review of details and payment option selection.
     */
    public function confirmation()
    {
        $pendingBooking = session()->get('pending_booking');
        if (!$pendingBooking) {
            return redirect('/')->with('error', 'Booking session expired. Please start over.');
        }

        $vehicle = Vehicle::where('key', $pendingBooking['vehicle'])->where('status', 'Active')->firstOrFail();
        $gateways = PaymentGateway::where('is_active', true)->get();

        return view('confirmation', [
            'booking' => $pendingBooking,
            'vehicle' => $vehicle,
            'gateways' => $gateways
        ]);
    }

    /**
     * Store new booking in the traveler session and redirect to dashboard.
     */
    public function store(Request $request)
    {
        $pendingBooking = session()->get('pending_booking');
        if (!$pendingBooking) {
            return redirect('/')->with('error', 'Booking session expired. Please start over.');
        }

        $validGateways = \App\Models\PaymentGateway::where('is_active', true)->pluck('slug')->push('none')->push('bank_transfer')->unique()->values()->toArray();

        $request->validate([
            'payment_method' => ['required', 'string', \Illuminate\Validation\Rule::in($validGateways)],
        ]);

        // Get existing trips or instantiate with default trip
        $trips = session()->get('trips', [
            [
                'id' => '#DEN-8821',
                'pickup' => 'DEN Airport (Terminal West)',
                'dropoff' => 'The Brown Palace Hotel',
                'date' => '2026-10-24',
                'time' => '14:30',
                'vehicle' => 'Executive SUV (Cadillac Escalade)'
            ]
        ]);

        // Generate unique ride ID
        $newId = '#DEN-' . rand(1000, 9999);

        // Add new trip to array
        $trips[] = [
            'id' => $newId,
            'pickup' => $pendingBooking['pickup'],
            'dropoff' => $pendingBooking['dropoff'] ?: 'As-Directed Hourly Chauffeur',
            'date' => $pendingBooking['date'],
            'time' => $pendingBooking['time'],
            'vehicle' => $pendingBooking['vehicle_name'] ?? $pendingBooking['vehicle']
        ];

        // Save back to session
        session()->put('trips', $trips);

        // ── Persist booking to database ──────────────────────────────────────
        try {
            // Upsert customer by email (update phone if changed)
            $customer = Customer::updateOrCreate(
                ['email' => $pendingBooking['email']],
                [
                    'first_name' => $pendingBooking['first_name'],
                    'last_name'  => $pendingBooking['last_name'],
                    'phone'      => $pendingBooking['phone'] ?? null,
                ]
            );

            // Resolve vehicle DB id from key
            $vehicleModel = Vehicle::where('key', $pendingBooking['vehicle'])->first();

            RideBooking::create([
                'reference'      => $newId,
                'customer_id'    => $customer->id,
                'vehicle_id'     => $vehicleModel?->id,
                'vehicle_name'   => $pendingBooking['vehicle_name'] ?? $pendingBooking['vehicle'],
                'service_type'   => $pendingBooking['service_type'],
                'pickup'         => $pendingBooking['pickup'],
                'dropoff'        => $pendingBooking['dropoff'] ?: null,
                'date'           => $pendingBooking['date'],
                'time'           => $pendingBooking['time'],
                'passengers'     => $pendingBooking['passengers'],
                'luggage'        => $pendingBooking['luggage'],
                'duration'       => $pendingBooking['duration'] ?? null,
                'distance_miles' => $pendingBooking['distance_miles'] ?? null,
                'total_fare'     => $pendingBooking['total'],
                'flight_number'  => $pendingBooking['flight_number'] ?? null,
                'notes'          => $pendingBooking['notes'] ?? null,
                'payment_method' => $request->payment_method,
                'status'         => 'pending',
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Booking DB Persist Failed: ' . $e->getMessage());
        }
        // ────────────────────────────────────────────────────────────────────

        // ── Send admin notification & customer confirmation emails ───────────
        try {
            // Load the persisted booking with its customer relationship
            $savedBooking = RideBooking::with('customer')->where('reference', $newId)->first();

            if ($savedBooking) {
                // 1. Admin notification → all admin-role users
                $adminEmails = \App\Models\User::role('admin')->pluck('email')->unique();
                if ($adminEmails->isEmpty()) {
                    $adminEmails = collect(['admin@denverlimocars.com']);
                }
                foreach ($adminEmails as $adminEmail) {
                    Mail::to($adminEmail)->send(new AdminBookingNotification($savedBooking));
                }

                // 2. Customer confirmation
                Mail::to($savedBooking->customer->email)
                    ->send(new CustomerBookingConfirmation($savedBooking));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Booking Email Notification Failed: ' . $e->getMessage());
        }
        // ────────────────────────────────────────────────────────────────────

        // Clear pending booking
        session()->forget('pending_booking');

        if ($request->payment_method !== 'bank_transfer') {
            if ($request->payment_method === 'none') {
                // AJAX path → return JSON so the modal can display in-page
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success'        => true,
                        'reservation_id' => $newId,
                        'email'          => $pendingBooking['email'],
                        'message'        => 'Your booking request has been received. Our concierge team will contact you shortly.',
                    ]);
                }

                // Non-JS fallback
                return redirect('/trips')->with('success', 'Your reservation ' . $newId . ' has been booked successfully! Our concierge team will contact you shortly to coordinate payment details.');
            }

            $prospect = \App\Models\Prospect::create([
                'name' => $pendingBooking['first_name'] . ' ' . $pendingBooking['last_name'],
                'email' => $pendingBooking['email'],
                'phone_number' => $pendingBooking['phone'] ?? '',
                'book_title' => 'Ride from ' . $pendingBooking['pickup'] . ' to ' . ($pendingBooking['dropoff'] ?: 'As-Directed Hourly Chauffeur'),
                'genre' => 'Transportation',
                'stage_of_manuscript' => 'Completed',
                'number_of_words' => 0,
                'agreement_name' => $pendingBooking['first_name'] . ' ' . $pendingBooking['last_name'],
                'agreement_terms' => true,
            ]);

            $invoice = \App\Models\Invoice::create([
                'prospect_id' => $prospect->id,
                'invoice_number' => 'INV-' . strtoupper(\Illuminate\Support\Str::random(8)),
                'amount' => $pendingBooking['total'],
                'allowed_gateways' => [$request->payment_method],
                'min_deposit_percentage' => 100,
                'status' => 'unpaid'
            ]);

            return redirect()->route('payments.initiate', [
                'invoice' => $invoice->id,
                'gateway' => $request->payment_method,
                'amount' => $invoice->amount,
            ]);
        }

        return redirect('/trips')->with('success', 'Your reservation ' . $newId . ' has been booked successfully! A confirmation receipt has been sent to your email.');
    }

    /**
     * List user trips from session.
     */
    public function trips()
    {
        $trips = session()->get('trips');

        // Populate default trip if empty
        if (is_null($trips)) {
            $trips = [
                [
                    'id' => '#DEN-8821',
                    'pickup' => 'DEN Airport (Terminal West)',
                    'dropoff' => 'The Brown Palace Hotel',
                    'date' => '2026-10-24',
                    'time' => '14:30',
                    'vehicle' => 'Executive SUV (Cadillac Escalade)'
                ]
            ];
            session()->put('trips', $trips);
        }

        return view('trips', ['trips' => $trips]);
    }

    /**
     * Cancel trip by removing from session.
     */
    public function cancel($index)
    {
        $trips = session()->get('trips', []);

        if (isset($trips[$index])) {
            $cancelledId = $trips[$index]['id'];
            unset($trips[$index]);
            // Re-index array
            $trips = array_values($trips);
            session()->put('trips', $trips);
            return redirect('/trips')->with('success', 'Trip ' . $cancelledId . ' has been cancelled successfully.');
        }

        return redirect('/trips')->with('error', 'Unable to find booking reference.');
    }
}
