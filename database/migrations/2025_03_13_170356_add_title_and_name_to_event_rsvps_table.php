<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndNameToEventRsvpsTable extends Migration
{
    public function up()
    {
        Schema::table('event_rsvps', function (Blueprint $table) {
            // Only add the columns if they do not already exist
            if (!Schema::hasColumn('event_rsvps', 'event_title')) {
                $table->string('event_title')->nullable()->after('nextofkin_id');
            }

            if (!Schema::hasColumn('event_rsvps', 'nextofkin_name')) {
                $table->string('nextofkin_name')->nullable()->after('event_title');
            }
        });
    }

    public function down()
    {
        Schema::table('event_rsvps', function (Blueprint $table) {
            // Drop the columns if they exist
            $table->dropColumn(['event_title', 'nextofkin_name']);
        });
    }
}
