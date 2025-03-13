<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRsvpStatusToAppointments extends Migration  // ✅ Correct class name
{
    public function up()
    {
        Schema::table('appointment', function (Blueprint $table) {
            $table->enum('rsvp_status', ['yes', 'no', 'maybe'])->nullable()->after('location');
            $table->text('rsvp_comments')->nullable()->after('rsvp_status');
        });
    }

    public function down()
    {
        Schema::table('appointment', function (Blueprint $table) {
            $table->dropColumn('rsvp_status');
            $table->dropColumn('rsvp_comments');
        });
    }
}
