<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait MedicalDataProtection
{
    /**
     * Log access to sensitive medical data
     */
    public function logMedicalDataAccess(string $action, string $patientId, string $userId)
    {
        Log::channel('medical_audit')->info('Medical data access', [
            'action' => $action,
            'patient_id' => $patientId,
            'user_id' => $userId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now()
        ]);
    }

    /**
     * Anonymize patient data for export
     */
    public function anonymizeForExport()
    {
        return [
            'id' => $this->id,
            'age_group' => $this->getAgeGroup(),
            'gender' => $this->gender,
            'blood_group' => $this->blood_group,
            'created_at' => $this->created_at
        ];
    }

    /**
     * Get age group instead of exact birth date
     */
    private function getAgeGroup()
    {
        $age = now()->diffInYears($this->date_birth);
        
        return match(true) {
            $age < 18 => 'Minor',
            $age < 30 => '18-29',
            $age < 50 => '30-49',
            $age < 70 => '50-69',
            default => '70+'
        };
    }
}