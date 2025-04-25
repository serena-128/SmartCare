<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRsvpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_rsvps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->unsignedInteger('nextofkin_id');
            $table->foreign('nextofkin_id')->references('id')->on('nextofkin')->onDelete('cascade');

            // New columns for additional details:
            $table->string('event_title')->nullable();
            $table->string('nextofkin_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_rsvps');
    }
}
