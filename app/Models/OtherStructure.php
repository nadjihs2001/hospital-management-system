<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherStructure extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'fax',
        'email',
        'website',
        'contact_person',
        'contact_phone',
        'contact_email',
        'license_number',
        'registration_number',
        'tax_number',
        'partnership_type',
        'partnership_start_date',
        'partnership_end_date',
        'status',
        'services_offered',
        'specialties',
        'equipment',
        'rating',
        'notes',
        'logo',
        'working_hours',
        'emergency_services',
        'accepts_insurance',
        'accepted_insurance_companies',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'services_offered' => 'array',
        'specialties' => 'array',
        'equipment' => 'array',
        'accepted_insurance_companies' => 'array',
        'working_hours' => 'array',
        'partnership_start_date' => 'date',
        'partnership_end_date' => 'date',
        'emergency_services' => 'boolean',
        'accepts_insurance' => 'boolean',
        'rating' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    protected $dates = [
        'partnership_start_date',
        'partnership_end_date',
        'deleted_at',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByPartnershipType($query, $partnershipType)
    {
        return $query->where('partnership_type', $partnershipType);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeWithEmergencyServices($query)
    {
        return $query->where('emergency_services', true);
    }

    public function scopeAcceptsInsurance($query)
    {
        return $query->where('accepts_insurance', true);
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        $address = $this->address;
        if ($this->city) {
            $address .= ', ' . $this->city;
        }
        if ($this->state) {
            $address .= ', ' . $this->state;
        }
        if ($this->postal_code) {
            $address .= ' ' . $this->postal_code;
        }
        if ($this->country) {
            $address .= ', ' . $this->country;
        }
        return $address;
    }

    public function getTypeDisplayAttribute()
    {
        $types = [
            'hospital' => 'Hospital',
            'clinic' => 'Clinic',
            'medical_center' => 'Medical Center',
            'laboratory' => 'Laboratory',
            'pharmacy' => 'Pharmacy',
            'radiology_center' => 'Radiology Center',
            'emergency_center' => 'Emergency Center',
            'rehabilitation_center' => 'Rehabilitation Center',
            'nursing_home' => 'Nursing Home',
            'other' => 'Other',
        ];

        return $types[$this->type] ?? $this->type;
    }

    public function getPartnershipTypeDisplayAttribute()
    {
        $types = [
            'referral' => 'Referral Partner',
            'collaboration' => 'Collaboration Partner',
            'supplier' => 'Supplier',
            'emergency' => 'Emergency Partner',
            'insurance' => 'Insurance Partner',
            'other' => 'Other',
        ];

        return $types[$this->partnership_type] ?? $this->partnership_type;
    }

    public function getStatusDisplayAttribute()
    {
        $statuses = [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'suspended' => 'Suspended',
            'terminated' => 'Terminated',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    // Mutators
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setContactEmailAttribute($value)
    {
        $this->attributes['contact_email'] = strtolower($value);
    }

    // Methods
    public function hasService($service)
    {
        return in_array($service, $this->services_offered ?? []);
    }

    public function hasSpecialty($specialty)
    {
        return in_array($specialty, $this->specialties ?? []);
    }

    public function hasEquipment($equipment)
    {
        return in_array($equipment, $this->equipment ?? []);
    }

    public function acceptsInsuranceCompany($company)
    {
        return in_array($company, $this->accepted_insurance_companies ?? []);
    }

    public function isPartnershipActive()
    {
        if (!$this->partnership_start_date) {
            return false;
        }

        $now = now();
        $start = $this->partnership_start_date;
        $end = $this->partnership_end_date;

        return $now->gte($start) && (!$end || $now->lte($end));
    }

    public function getDistance($latitude, $longitude)
    {
        if (!$this->latitude || !$this->longitude) {
            return null;
        }

        $earthRadius = 6371; // Earth's radius in kilometers

        $latFrom = deg2rad($latitude);
        $lonFrom = deg2rad($longitude);
        $latTo = deg2rad($this->latitude);
        $lonTo = deg2rad($this->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    // Static methods
    public static function getTypes()
    {
        return [
            'hospital' => 'Hospital',
            'clinic' => 'Clinic',
            'medical_center' => 'Medical Center',
            'laboratory' => 'Laboratory',
            'pharmacy' => 'Pharmacy',
            'radiology_center' => 'Radiology Center',
            'emergency_center' => 'Emergency Center',
            'rehabilitation_center' => 'Rehabilitation Center',
            'nursing_home' => 'Nursing Home',
            'other' => 'Other',
        ];
    }

    public static function getPartnershipTypes()
    {
        return [
            'referral' => 'Referral Partner',
            'collaboration' => 'Collaboration Partner',
            'supplier' => 'Supplier',
            'emergency' => 'Emergency Partner',
            'insurance' => 'Insurance Partner',
            'other' => 'Other',
        ];
    }

    public static function getStatuses()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'suspended' => 'Suspended',
            'terminated' => 'Terminated',
        ];
    }
};
