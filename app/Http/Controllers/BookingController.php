<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    private $vehicles = [
        'escalade' => [
            'key' => 'escalade',
            'name' => 'Cadillac Escalade ESV',
            'class' => 'Executive SUV',
            'description' => 'The pinnacle of luxury travel. Features massive cargo room, leather captain chairs, and tri-zone climate controls.',
            'passengers' => 6,
            'luggage' => 6,
            'hourly_rate' => 150,
            'airport_rate' => 180,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwdQOl_gEikFr8S56LY87vmh4n4T8Os96QusQHy_xCw3e_FGw-AKH_9_HDQkXuHRIoeUKPb3R5W1duTKCiRHfkfuttg8Co3muxab46pIDiDk3EZzUpb6mo6AGoX8wqlwLM1jZrInNnZ_3I4pUNDeZ5JX-x5guIDlXsknVGldwFcpiz__GkBWfv5z1JVAlsOJBicn7YKUeeYJjp2cIcrGgBz4nygltAm9o94StJ9rg-nexFOFU51pLi-Zs9rXSrS_txEOscFDJPEL5c'
        ],
        'sclass' => [
            'key' => 'sclass',
            'name' => 'Mercedes-Benz S-Class',
            'class' => 'Executive Sedan',
            'description' => 'The standard by which all executive cars are measured. Supreme comfort, acoustic isolation, and rear sunshades.',
            'passengers' => 3,
            'luggage' => 3,
            'hourly_rate' => 130,
            'airport_rate' => 160,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsyejjO2p3XWJPueL65eaD1Dz8MPeDiPZFAxinPzwoXjq-34JFjXV7nI8gSZUvH-4H-_3MuTqr7-y6asXq76Mvy1FOa0ytqnVIEIocux9BP9jzRpsLcOPzC0CPsGRnXjIOAY6okz1GW8sz_pZKdQLxSHscgkssInfC7gqEuj_fP8P29qZCIbVmv5p1pF7JuuCTwNQAtblBzHTdTyeBtvrhNzucbDu9L-b2aJPI9T6rkM8-4e_7bhs3IOnbYqMsg2xqWsmVh5NdlJPC'
        ],
        'suburban' => [
            'key' => 'suburban',
            'name' => 'Chevrolet Suburban',
            'class' => 'Luxury SUV',
            'description' => 'A robust, spacious option designed for excellent passenger volume, luggage storage, and comfortable rides.',
            'passengers' => 7,
            'luggage' => 6,
            'hourly_rate' => 135,
            'airport_rate' => 165,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAkJa-KW0Zsl3aCDAH_rnmt7-1ZIaJcMSCxgkvvMggAlxNeFjf1DX4_frPaqZMjYyaGmFSpfyQjgbawq4lltJSwN6quavhUXr1VCIM4r1jIuQ1IWc6H1Gu0OSxVzfQIqmDkNxBN7Fv5bqPb400VQTSG6TWKJdSFYmAlPMS7vPE3f_ydMROu9vsLVQ_1FXkF-O5pD4fX04QxUFk61Bw5baAQ_7zDkE-NXAQD7CjoUNptchFFjwIoO6TdPjpsTVBzA-xdJX5_2YVnIr2G'
        ],
        'sprinter' => [
            'key' => 'sprinter',
            'name' => 'Mercedes-Benz Sprinter',
            'class' => 'Executive Van',
            'description' => 'The ultimate group shuttle vehicle. Exceptional headroom, individual leather seats, and large luggage capacity.',
            'passengers' => 14,
            'luggage' => 14,
            'hourly_rate' => 180,
            'airport_rate' => 220,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAH0Gru2JVDtgOYteoO8yQTTURBBLcatQbfZFs-fSyJjsuit7XekJGIqa86OLaZDUC_CRdr1csFeAjg-7A7CLBat7IqeXIQ9kkyk8NYKL8yJSz_1HQyeBGZriU55fSCdVPwgmsWYMjgGc-PR6aJ03aEDhuk8j9dRZoRbz6EFAGfr7_0pIhWpUkw1SuwJpakjbkZOwj3Tio4rZmMuEVs0Xq7kEbqr_GXe7MnrXfEVf-lSVi5FPcZ3jTljm2RTsTxhEIM-qvmLXHBs64o'
        ]
    ];

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

        return view('search-results', [
            'search'   => $search,
            'vehicles' => $this->vehicles
        ]);
    }

    /**
     * Checkout form with receipt summaries.
     */
    public function checkout(Request $request)
    {
        $search = $request->validate([
            'vehicle' => 'required|string|in:escalade,sclass,suburban,sprinter',
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

        $vehicle = $this->vehicles[$search['vehicle']];

        return view('checkout', [
            'search' => $search,
            'vehicle' => $vehicle,
            'total' => $search['total']
        ]);
    }

    /**
     * Store new booking in the traveler session and redirect to dashboard.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle' => 'required|string',
            'pickup' => 'required|string',
            'dropoff' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'total' => 'required|numeric',
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
            'pickup' => $data['pickup'],
            'dropoff' => $data['dropoff'] ?: 'As-Directed Hourly Chauffeur',
            'date' => $data['date'],
            'time' => $data['time'],
            'vehicle' => $data['vehicle']
        ];

        // Save back to session
        session()->put('trips', $trips);

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
