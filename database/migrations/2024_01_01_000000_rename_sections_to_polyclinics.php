<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Add polyclinic_id columns to tables that still have section_id
        if (Schema::hasColumn('doctors', 'section_id') && !Schema::hasColumn('doctors', 'polyclinic_id')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->unsignedBigInteger('polyclinic_id')->nullable()->after('section_id');
            });

            // Copy data from section_id to polyclinic_id
            DB::statement('UPDATE doctors SET polyclinic_id = section_id');

            // Try to drop foreign key constraint if it exists, then drop the column
            try {
                Schema::table('doctors', function (Blueprint $table) {
                    $table->dropForeign(['section_id']);
                });
            } catch (Exception $e) {
                // Foreign key might not exist, continue
            }

            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }

        if (Schema::hasColumn('appointments', 'section_id') && !Schema::hasColumn('appointments', 'polyclinic_id')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->unsignedBigInteger('polyclinic_id')->nullable()->after('section_id');
            });

            // Copy data from section_id to polyclinic_id
            DB::statement('UPDATE appointments SET polyclinic_id = section_id');

            // Try to drop foreign key constraint if it exists, then drop the column
            try {
                Schema::table('appointments', function (Blueprint $table) {
                    $table->dropForeign(['section_id']);
                });
            } catch (Exception $e) {
                // Foreign key might not exist, continue
            }

            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }

        if (Schema::hasColumn('invoices', 'section_id') && !Schema::hasColumn('invoices', 'polyclinic_id')) {
            Schema::table('invoices', function (Blueprint $table) {
                $table->unsignedBigInteger('polyclinic_id')->nullable()->after('section_id');
            });

            // Copy data from section_id to polyclinic_id
            DB::statement('UPDATE invoices SET polyclinic_id = section_id');

            // Try to drop foreign key constraint if it exists, then drop the column
            try {
                Schema::table('invoices', function (Blueprint $table) {
                    $table->dropForeign(['section_id']);
                });
            } catch (Exception $e) {
                // Foreign key might not exist, continue
            }

            Schema::table('invoices', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }

        if (Schema::hasColumn('single_invoices', 'section_id') && !Schema::hasColumn('single_invoices', 'polyclinic_id')) {
            Schema::table('single_invoices', function (Blueprint $table) {
                $table->unsignedBigInteger('polyclinic_id')->nullable()->after('section_id');
            });

            // Copy data from section_id to polyclinic_id
            DB::statement('UPDATE single_invoices SET polyclinic_id = section_id');

            // Try to drop foreign key constraint if it exists, then drop the column
            try {
                Schema::table('single_invoices', function (Blueprint $table) {
                    $table->dropForeign(['section_id']);
                });
            } catch (Exception $e) {
                // Foreign key might not exist, continue
            }

            Schema::table('single_invoices', function (Blueprint $table) {
                $table->dropColumn('section_id');
            });
        }
    }

    public function down()
    {
        // Reverse the changes
        if (Schema::hasColumn('single_invoices', 'polyclinic_id')) {
            Schema::table('single_invoices', function (Blueprint $table) {
                $table->renameColumn('polyclinic_id', 'section_id');
            });
        }

        if (Schema::hasColumn('invoices', 'polyclinic_id')) {
            Schema::table('invoices', function (Blueprint $table) {
                $table->renameColumn('polyclinic_id', 'section_id');
            });
        }

        if (Schema::hasColumn('appointments', 'polyclinic_id')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->renameColumn('polyclinic_id', 'section_id');
            });
        }

        if (Schema::hasColumn('doctors', 'polyclinic_id')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->renameColumn('polyclinic_id', 'section_id');
            });
        }
    }
};
