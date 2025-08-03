<?php

namespace Database\Seeders;

use App\Models\OtherStructure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OtherStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create specific structures
        $this->createSpecificStructures();

        // Create random structures using factory
        OtherStructure::factory(20)->create();

        // Create some specific types
        OtherStructure::factory(5)->hospital()->active()->create();
        OtherStructure::factory(8)->clinic()->active()->create();
    }

    /**
     * Create specific well-known structures
     */
    private function createSpecificStructures()
    {
        $structures = [
            [
                'name' => 'CHU Ibn Rochd',
                'code' => 'HOSIBR001',
                'type' => 'hospital',
                'description' => 'Centre Hospitalier Universitaire Ibn Rochd - Casablanca',
                'address' => '1, Rue des Hôpitaux',
                'city' => 'Casablanca',
                'state' => 'Grand Casablanca',
                'postal_code' => '20100',
                'country' => 'Morocco',
                'phone' => '+212522480000',
                'email' => 'contact@chu-ibnrochd.ma',
                'website' => 'https://www.chu-ibnrochd.ma',
                'contact_person' => 'Dr. Ahmed Benali',
                'contact_phone' => '+212522480001',
                'contact_email' => 'direction@chu-ibnrochd.ma',
                'license_number' => 'HL123456',
                'registration_number' => '12345678',
                'partnership_type' => 'referral',
                'partnership_start_date' => '2020-01-01',
                'status' => 'active',
                'services_offered' => ['Emergency Care', 'Surgery', 'Cardiology', 'Neurology', 'Pediatrics'],
                'specialties' => ['Cardiology', 'Neurology', 'Pediatrics', 'Surgery', 'Emergency Medicine'],
                'equipment' => ['CT Scanner', 'MRI Machine', 'X-Ray Machine', 'Ultrasound'],
                'rating' => 4.5,
                'emergency_services' => true,
                'accepts_insurance' => true,
                'accepted_insurance_companies' => ['CNSS', 'CNOPS', 'RMA Assurance'],
                'latitude' => 33.5731,
                'longitude' => -7.5898,
            ],
            [
                'name' => 'Clinique Al-Amal',
                'code' => 'CLINAL001',
                'type' => 'clinic',
                'description' => 'Clinique privée spécialisée en chirurgie',
                'address' => '45, Boulevard Mohammed V',
                'city' => 'Rabat',
                'state' => 'Rabat-Salé-Kénitra',
                'postal_code' => '10000',
                'country' => 'Morocco',
                'phone' => '+212537123456',
                'email' => 'info@clinique-alamal.ma',
                'website' => 'https://www.clinique-alamal.ma',
                'contact_person' => 'Dr. Fatima Zahra',
                'contact_phone' => '+212537123457',
                'contact_email' => 'direction@clinique-alamal.ma',
                'license_number' => 'CL789012',
                'partnership_type' => 'collaboration',
                'partnership_start_date' => '2021-03-15',
                'status' => 'active',
                'services_offered' => ['General Surgery', 'Orthopedics', 'Gynecology'],
                'specialties' => ['Surgery', 'Orthopedics', 'Gynecology'],
                'equipment' => ['Surgical Equipment', 'X-Ray Machine', 'Ultrasound'],
                'rating' => 4.2,
                'emergency_services' => false,
                'accepts_insurance' => true,
                'accepted_insurance_companies' => ['CNOPS', 'Wafa Assurance'],
                'latitude' => 34.0209,
                'longitude' => -6.8416,
            ],
            [
                'name' => 'Laboratoire Central',
                'code' => 'LABCEN001',
                'type' => 'laboratory',
                'description' => 'Laboratoire d\'analyses médicales',
                'address' => '12, Rue de la Liberté',
                'city' => 'Marrakech',
                'state' => 'Marrakech-Safi',
                'postal_code' => '40000',
                'country' => 'Morocco',
                'phone' => '+212524987654',
                'email' => 'contact@lab-central.ma',
                'contact_person' => 'Dr. Hassan Alami',
                'contact_phone' => '+212524987655',
                'contact_email' => 'direction@lab-central.ma',
                'license_number' => 'LB345678',
                'partnership_type' => 'supplier',
                'partnership_start_date' => '2019-06-01',
                'status' => 'active',
                'services_offered' => ['Blood Tests', 'Urine Analysis', 'Microbiology', 'Biochemistry'],
                'specialties' => ['Clinical Biology', 'Microbiology', 'Biochemistry'],
                'equipment' => ['Laboratory Equipment', 'Microscopes', 'Analyzers'],
                'rating' => 4.0,
                'emergency_services' => false,
                'accepts_insurance' => true,
                'accepted_insurance_companies' => ['CNSS', 'CNOPS'],
                'latitude' => 31.6295,
                'longitude' => -7.9811,
            ],
            [
                'name' => 'Pharmacie Moderne',
                'code' => 'PHARMOD001',
                'type' => 'pharmacy',
                'description' => 'Pharmacie moderne avec service 24h/24',
                'address' => '78, Avenue Hassan II',
                'city' => 'Fès',
                'state' => 'Fès-Meknès',
                'postal_code' => '30000',
                'country' => 'Morocco',
                'phone' => '+212535654321',
                'email' => 'info@pharmacie-moderne.ma',
                'contact_person' => 'Dr. Pharmacien Youssef',
                'contact_phone' => '+212535654322',
                'partnership_type' => 'supplier',
                'partnership_start_date' => '2020-09-01',
                'status' => 'active',
                'services_offered' => ['Prescription Drugs', 'OTC Medications', 'Medical Supplies'],
                'equipment' => ['Pharmacy Equipment', 'Refrigeration Units'],
                'rating' => 4.3,
                'emergency_services' => true,
                'accepts_insurance' => true,
                'accepted_insurance_companies' => ['CNSS', 'CNOPS', 'RMA Assurance'],
                'working_hours' => [
                    'monday' => '24 hours',
                    'tuesday' => '24 hours',
                    'wednesday' => '24 hours',
                    'thursday' => '24 hours',
                    'friday' => '24 hours',
                    'saturday' => '24 hours',
                    'sunday' => '24 hours',
                ],
                'latitude' => 34.0181,
                'longitude' => -5.0078,
            ],
            [
                'name' => 'Centre de Radiologie Atlas',
                'code' => 'RADATL001',
                'type' => 'radiology_center',
                'description' => 'Centre spécialisé en imagerie médicale',
                'address' => '23, Rue Ibn Sina',
                'city' => 'Agadir',
                'state' => 'Souss-Massa',
                'postal_code' => '80000',
                'country' => 'Morocco',
                'phone' => '+212528111222',
                'email' => 'contact@radio-atlas.ma',
                'contact_person' => 'Dr. Radiologue Amina',
                'contact_phone' => '+212528111223',
                'partnership_type' => 'collaboration',
                'partnership_start_date' => '2021-01-15',
                'status' => 'active',
                'services_offered' => ['X-Ray', 'CT Scan', 'MRI', 'Ultrasound', 'Mammography'],
                'specialties' => ['Radiology', 'Medical Imaging'],
                'equipment' => ['CT Scanner', 'MRI Machine', 'X-Ray Machine', 'Ultrasound', 'Mammography Unit'],
                'rating' => 4.4,
                'emergency_services' => false,
                'accepts_insurance' => true,
                'accepted_insurance_companies' => ['CNOPS', 'Wafa Assurance', 'AXA Assurance Maroc'],
                'latitude' => 30.4278,
                'longitude' => -9.5981,
            ],
        ];

        foreach ($structures as $structure) {
            OtherStructure::create($structure);
        }
    }
};
