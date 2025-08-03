<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_structures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('type', ['hospital', 'clinic', 'medical_center', 'laboratory', 'pharmacy', 'radiology_center', 'emergency_center', 'rehabilitation_center', 'nursing_home', 'other']);
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Morocco');
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('license_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->enum('partnership_type', ['referral', 'collaboration', 'supplier', 'emergency', 'insurance', 'other'])->default('referral');
            $table->date('partnership_start_date')->nullable();
            $table->date('partnership_end_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended', 'terminated'])->default('active');
            $table->json('services_offered')->nullable();
            $table->json('specialties')->nullable();
            $table->json('equipment')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->text('notes')->nullable();
            $table->string('logo')->nullable();
            $table->json('working_hours')->nullable();
            $table->boolean('emergency_services')->default(false);
            $table->boolean('accepts_insurance')->default(false);
            $table->json('accepted_insurance_companies')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
            
            $table->index(['type', 'status']);
            $table->index(['partnership_type', 'status']);
            $table->index(['city', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_structures');
    }
};
