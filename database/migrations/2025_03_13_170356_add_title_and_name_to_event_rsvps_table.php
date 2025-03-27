<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndNameToEventRsvpsTable extends Migration
{
    public function up()
    {
        Schema::table('event_rsvps', function (Blueprint $table) {
            $table->string('event_title')->nullable()->after('nextofkin_id');
            $table->string('nextofkin_name')->nullable()->after('event_title');
        });
    }

    public function down()
    {
        Schema::table('event_rsvps', function (Blueprint $table) {
            $table->dropColumn(['event_title', 'nextofkin_name']);
        });
    }
}
