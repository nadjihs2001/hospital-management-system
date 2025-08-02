<?php

namespace Database\Seeders;

use App\Models\Polyclinic;
use Illuminate\Database\Seeder;

class PolyclinicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $polyclinics = [
            [
                'ar' => ['name' => 'عيادة المخ والاعصاب', 'description' => 'عيادة متخصصة في علاج أمراض المخ والأعصاب'],
                'en' => ['name' => 'Neurology Clinic', 'description' => 'Specialized clinic for brain and nervous system diseases']
            ],
            [
                'ar' => ['name' => 'عيادة الجراحة', 'description' => 'عيادة متخصصة في العمليات الجراحية'],
                'en' => ['name' => 'Surgery Clinic', 'description' => 'Specialized clinic for surgical operations']
            ],
            [
                'ar' => ['name' => 'عيادة الاطفال', 'description' => 'عيادة متخصصة في علاج الأطفال'],
                'en' => ['name' => 'Pediatrics Clinic', 'description' => 'Specialized clinic for children treatment']
            ],
            [
                'ar' => ['name' => 'عيادة النساء والتوليد', 'description' => 'عيادة متخصصة في أمراض النساء والولادة'],
                'en' => ['name' => 'Obstetrics and Gynecology Clinic', 'description' => 'Specialized clinic for women health and childbirth']
            ],
            [
                'ar' => ['name' => 'عيادة العيون', 'description' => 'عيادة متخصصة في علاج أمراض العيون'],
                'en' => ['name' => 'Ophthalmology Clinic', 'description' => 'Specialized clinic for eye diseases']
            ],
            [
                'ar' => ['name' => 'عيادة الباطنة', 'description' => 'عيادة متخصصة في الطب الباطني'],
                'en' => ['name' => 'Internal Medicine Clinic', 'description' => 'Specialized clinic for internal medicine']
            ]
        ];

        foreach ($polyclinics as $polyclinicData) {
            Polyclinic::create($polyclinicData);
        }
    }
}
