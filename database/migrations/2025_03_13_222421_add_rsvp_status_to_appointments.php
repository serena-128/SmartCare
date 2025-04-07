=<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRsvpStatusToAppointments extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('rsvp_status')->nullable()->after('location'); // ✅ Add RSVP status
            $table->text('rsvp_comments')->nullable()->after('rsvp_status'); // ✅ Add RSVP comments
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['rsvp_status', 'rsvp_comments']);
        });
    }
}
