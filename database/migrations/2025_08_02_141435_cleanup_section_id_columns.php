<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleanupSectionIdColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop remaining section_id columns with foreign key constraints
        if (Schema::hasColumn('doctors', 'section_id')) {
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

        if (Schema::hasColumn('appointments', 'section_id')) {
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

        if (Schema::hasColumn('invoices', 'section_id')) {
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

        if (Schema::hasColumn('single_invoices', 'section_id')) {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Add back section_id columns if needed for rollback
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id')->nullable();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id')->nullable();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id')->nullable();
        });

        Schema::table('single_invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id')->nullable();
        });
    }
}
