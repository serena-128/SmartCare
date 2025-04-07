<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToCareLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('care_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('care_logs', 'resident_id')) {
                $table->foreignId('resident_id')->constrained()->cascadeOnDelete();
            }
            if (!Schema::hasColumn('care_logs', 'caregiver_id')) {
                $table->foreignId('caregiver_id')->nullable()->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('care_logs', 'activity_type')) {
                $table->string('activity_type');
            }
            if (!Schema::hasColumn('care_logs', 'notes')) {
                $table->text('notes')->nullable();
            }
            if (!Schema::hasColumn('care_logs', 'logged_at')) {
                $table->timestamp('logged_at')->useCurrent();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('care_logs', function (Blueprint $table) {
            if (Schema::hasColumn('care_logs', 'resident_id')) {
                $table->dropForeign(['resident_id']);
                $table->dropColumn('resident_id');
            }
            if (Schema::hasColumn('care_logs', 'caregiver_id')) {
                $table->dropForeign(['caregiver_id']);
                $table->dropColumn('caregiver_id');
            }
            if (Schema::hasColumn('care_logs', 'activity_type')) {
                $table->dropColumn('activity_type');
            }
            if (Schema::hasColumn('care_logs', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('care_logs', 'logged_at')) {
                $table->dropColumn('logged_at');
            }
        });
    }
}
