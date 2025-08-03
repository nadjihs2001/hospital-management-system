<?php

namespace Database\Factories;

use App\Models\OtherStructure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OtherStructure>
 */
class OtherStructureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OtherStructure::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['hospital', 'clinic', 'medical_center', 'laboratory', 'pharmacy', 'radiology_center', 'emergency_center', 'rehabilitation_center', 'nursing_home', 'other'];
        $partnershipTypes = ['referral', 'collaboration', 'supplier', 'emergency', 'insurance', 'other'];
        $statuses = ['active', 'inactive', 'suspended', 'terminated'];
        $cities = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Tanger', 'Agadir', 'Meknès', 'Oujda', 'Kenitra', 'Tétouan'];
        
        $type = $this->faker->randomElement($types);
        $name = $this->generateStructureName($type);
        $code = $this->generateCode($name, $type);

        return [
            'name' => $name,
            'code' => $code,
            'type' => $type,
            'description' => $this->faker->optional()->paragraph(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->randomElement($cities),
            'state' => $this->faker->optional()->state(),
            'postal_code' => $this->faker->optional()->postcode(),
            'country' => 'Morocco',
            'phone' => $this->faker->optional()->phoneNumber(),
            'fax' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->optional()->companyEmail(),
            'website' => $this->faker->optional()->url(),
            'contact_person' => $this->faker->optional()->name(),
            'contact_phone' => $this->faker->optional()->phoneNumber(),
            'contact_email' => $this->faker->optional()->email(),
            'license_number' => $this->faker->optional()->regexify('[A-Z]{2}[0-9]{6}'),
            'registration_number' => $this->faker->optional()->regexify('[0-9]{8}'),
            'tax_number' => $this->faker->optional()->regexify('[0-9]{10}'),
            'partnership_type' => $this->faker->randomElement($partnershipTypes),
            'partnership_start_date' => $this->faker->optional()->dateTimeBetween('-2 years', 'now'),
            'partnership_end_date' => $this->faker->optional()->dateTimeBetween('now', '+2 years'),
            'status' => $this->faker->randomElement($statuses),
            'services_offered' => $this->generateServices($type),
            'specialties' => $this->generateSpecialties($type),
            'equipment' => $this->generateEquipment($type),
            'rating' => $this->faker->optional()->randomFloat(2, 1, 5),
            'notes' => $this->faker->optional()->text(),
            'working_hours' => $this->generateWorkingHours(),
            'emergency_services' => $this->faker->boolean(30),
            'accepts_insurance' => $this->faker->boolean(70),
            'accepted_insurance_companies' => $this->generateInsuranceCompanies(),
            'latitude' => $this->faker->optional()->latitude(31, 36), // Morocco latitude range
            'longitude' => $this->faker->optional()->longitude(-13, -1), // Morocco longitude range
        ];
    }

    /**
     * Generate structure name based on type
     */
    private function generateStructureName($type)
    {
        $prefixes = [
            'hospital' => ['Hospital', 'Medical Center', 'General Hospital'],
            'clinic' => ['Clinic', 'Medical Clinic', 'Health Clinic'],
            'medical_center' => ['Medical Center', 'Health Center', 'Care Center'],
            'laboratory' => ['Laboratory', 'Medical Lab', 'Diagnostic Lab'],
            'pharmacy' => ['Pharmacy', 'Drugstore', 'Medical Pharmacy'],
            'radiology_center' => ['Radiology Center', 'Imaging Center', 'Diagnostic Center'],
            'emergency_center' => ['Emergency Center', 'Urgent Care', 'Emergency Clinic'],
            'rehabilitation_center' => ['Rehabilitation Center', 'Recovery Center', 'Therapy Center'],
            'nursing_home' => ['Nursing Home', 'Care Home', 'Senior Center'],
            'other' => ['Medical Facility', 'Health Facility', 'Care Facility'],
        ];

        $prefix = $this->faker->randomElement($prefixes[$type]);
        $suffix = $this->faker->randomElement(['Al-Amal', 'Al-Shifa', 'Al-Noor', 'Al-Hayat', 'Al-Salam', 'Modern', 'International', 'Central', 'Royal', 'National']);
        
        return $prefix . ' ' . $suffix;
    }

    /**
     * Generate unique code
     */
    private function generateCode($name, $type)
    {
        $typeCode = strtoupper(substr($type, 0, 3));
        $nameCode = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name), 0, 3));
        $number = $this->faker->unique()->numberBetween(100, 999);
        
        return $typeCode . $nameCode . $number;
    }

    /**
     * Generate services based on type
     */
    private function generateServices($type)
    {
        $allServices = [
            'hospital' => ['Emergency Care', 'Surgery', 'Cardiology', 'Neurology', 'Orthopedics', 'Pediatrics', 'Gynecology', 'Internal Medicine'],
            'clinic' => ['General Consultation', 'Vaccination', 'Health Checkup', 'Minor Surgery', 'Family Medicine'],
            'medical_center' => ['Outpatient Care', 'Specialist Consultation', 'Diagnostic Services', 'Preventive Care'],
            'laboratory' => ['Blood Tests', 'Urine Analysis', 'Microbiology', 'Biochemistry', 'Hematology', 'Pathology'],
            'pharmacy' => ['Prescription Drugs', 'OTC Medications', 'Medical Supplies', 'Health Consultation'],
            'radiology_center' => ['X-Ray', 'CT Scan', 'MRI', 'Ultrasound', 'Mammography'],
            'emergency_center' => ['Emergency Care', 'Trauma Care', 'Urgent Care', 'Ambulance Services'],
            'rehabilitation_center' => ['Physical Therapy', 'Occupational Therapy', 'Speech Therapy', 'Rehabilitation'],
            'nursing_home' => ['Long-term Care', 'Assisted Living', 'Memory Care', 'Palliative Care'],
            'other' => ['General Services', 'Specialized Care', 'Support Services'],
        ];

        $services = $allServices[$type] ?? $allServices['other'];
        return $this->faker->randomElements($services, $this->faker->numberBetween(2, count($services)));
    }

    /**
     * Generate specialties based on type
     */
    private function generateSpecialties($type)
    {
        $specialties = [
            'Cardiology', 'Neurology', 'Orthopedics', 'Pediatrics', 'Gynecology', 
            'Dermatology', 'Psychiatry', 'Radiology', 'Anesthesiology', 'Pathology',
            'Emergency Medicine', 'Family Medicine', 'Internal Medicine', 'Surgery'
        ];

        if ($type === 'hospital' || $type === 'medical_center') {
            return $this->faker->randomElements($specialties, $this->faker->numberBetween(3, 8));
        }

        return $this->faker->randomElements($specialties, $this->faker->numberBetween(1, 3));
    }

    /**
     * Generate equipment based on type
     */
    private function generateEquipment($type)
    {
        $equipment = [
            'X-Ray Machine', 'CT Scanner', 'MRI Machine', 'Ultrasound', 'ECG Machine',
            'Defibrillator', 'Ventilator', 'Patient Monitor', 'Surgical Equipment',
            'Laboratory Equipment', 'Pharmacy Equipment', 'Emergency Equipment'
        ];

        return $this->faker->randomElements($equipment, $this->faker->numberBetween(2, 6));
    }

    /**
     * Generate working hours
     */
    private function generateWorkingHours()
    {
        $is24Hours = $this->faker->boolean(20);
        
        if ($is24Hours) {
            return [
                'monday' => '24 hours',
                'tuesday' => '24 hours',
                'wednesday' => '24 hours',
                'thursday' => '24 hours',
                'friday' => '24 hours',
                'saturday' => '24 hours',
                'sunday' => '24 hours',
            ];
        }

        $openTime = $this->faker->randomElement(['08:00', '09:00', '10:00']);
        $closeTime = $this->faker->randomElement(['17:00', '18:00', '19:00', '20:00']);

        return [
            'monday' => $openTime . ' - ' . $closeTime,
            'tuesday' => $openTime . ' - ' . $closeTime,
            'wednesday' => $openTime . ' - ' . $closeTime,
            'thursday' => $openTime . ' - ' . $closeTime,
            'friday' => $openTime . ' - ' . $closeTime,
            'saturday' => $this->faker->boolean(70) ? $openTime . ' - ' . $closeTime : 'Closed',
            'sunday' => $this->faker->boolean(30) ? $openTime . ' - ' . $closeTime : 'Closed',
        ];
    }

    /**
     * Generate insurance companies
     */
    private function generateInsuranceCompanies()
    {
        $companies = [
            'CNSS', 'CNOPS', 'RMA Assurance', 'Wafa Assurance', 'Atlanta Assurance',
            'AXA Assurance Maroc', 'Zurich Assurance Maroc', 'Saham Assurance'
        ];

        return $this->faker->randomElements($companies, $this->faker->numberBetween(1, 4));
    }

    /**
     * Indicate that the structure is active.
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
    }

    /**
     * Indicate that the structure is a hospital.
     */
    public function hospital()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'hospital',
                'name' => $this->generateStructureName('hospital'),
                'emergency_services' => true,
            ];
        });
    }

    /**
     * Indicate that the structure is a clinic.
     */
    public function clinic()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'clinic',
                'name' => $this->generateStructureName('clinic'),
            ];
        });
    }
};
