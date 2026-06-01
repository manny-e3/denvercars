<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RideBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'customer_id',
        'vehicle_id',
        'vehicle_name',
        'service_type',
        'pickup',
        'dropoff',
        'date',
        'time',
        'passengers',
        'luggage',
        'duration',
        'distance_miles',
        'total_fare',
        'flight_number',
        'notes',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Status badge color map.
     */
    public static array $statusColors = [
        'pending'   => 'warning',
        'confirmed' => 'info',
        'completed' => 'success',
        'cancelled' => 'danger',
    ];

    public function getStatusColorAttribute(): string
    {
        return static::$statusColors[$this->status] ?? 'secondary';
    }

    /**
     * The customer who made this booking.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * The vehicle assigned to this ride.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
