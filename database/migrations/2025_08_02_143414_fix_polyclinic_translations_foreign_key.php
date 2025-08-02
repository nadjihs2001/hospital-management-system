<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixPolyclinicTranslationsForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Copy data from section_id to polyclinic_id and drop section_id
        if (Schema::hasColumn('polyclinic_translations', 'section_id')) {
            // Copy data from section_id to polyclinic_id
            DB::statement('UPDATE polyclinic_translations SET polyclinic_id = section_id WHERE polyclinic_id IS NULL');

            // Try to drop foreign key constraint if it exists, then drop the column
            try {
                Schema::table('polyclinic_translations', function (Blueprint $table) {
                    $table->dropForeign(['section_id']);
                });
            } catch (Exception $e) {
                // Foreign key might not exist, continue
            }

            Schema::table('polyclinic_translations', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverse the changes
        Schema::table('polyclinic_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id')->nullable();
        });

        DB::statement('UPDATE polyclinic_translations SET section_id = polyclinic_id');

        Schema::table('polyclinic_translations', function (Blueprint $table) {
            $table->dropColumn('polyclinic_id');
        });
    }
}
