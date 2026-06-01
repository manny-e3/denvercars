<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'license_number',
        'license_type',
        'license_expiry',
        'cdl_certifications',
        'medical_card_number',
        'medical_card_expiry',
        'vehicle_id',
        'status',
        'notes',
    ];

    protected $casts = [
        'cdl_certifications' => 'array',
        'license_expiry'     => 'date',
        'medical_card_expiry' => 'date',
    ];

    // ── Relationships ────────────────────────────────────────────────────────────

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // ── Computed Attributes ──────────────────────────────────────────────────────

    /**
     * Returns: 'expired', 'expiring_soon', or 'valid'
     */
    public function licenseStatus(): string
    {
        if ($this->license_expiry->isPast()) {
            return 'expired';
        }
        if ($this->license_expiry->diffInDays(now()) <= 30 && $this->license_expiry->isFuture()) {
            return 'expiring_soon';
        }
        return 'valid';
    }

    public function medicalCardStatus(): string
    {
        if (!$this->medical_card_expiry) {
            return 'none';
        }
        if ($this->medical_card_expiry->isPast()) {
            return 'expired';
        }
        if ($this->medical_card_expiry->diffInDays(now()) <= 30 && $this->medical_card_expiry->isFuture()) {
            return 'expiring_soon';
        }
        return 'valid';
    }

    /**
     * Overall compliance status — worst of license + medical card.
     */
    public function complianceStatus(): string
    {
        $statuses = [$this->licenseStatus(), $this->medicalCardStatus()];
        if (in_array('expired', $statuses))       return 'expired';
        if (in_array('expiring_soon', $statuses)) return 'expiring_soon';
        return 'valid';
    }

    // ── Scopes ───────────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeExpiringSoon($query, int $days = 30)
    {
        return $query->where(function ($q) use ($days) {
            $q->whereBetween('license_expiry', [now(), now()->addDays($days)])
              ->orWhereBetween('medical_card_expiry', [now(), now()->addDays($days)]);
        });
    }

    public function scopeExpired($query)
    {
        return $query->where(function ($q) {
            $q->where('license_expiry', '<', now())
              ->orWhere('medical_card_expiry', '<', now());
        });
    }
}
