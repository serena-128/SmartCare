<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentRsvpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_rsvps', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('appointment_id');
    $table->unsignedBigInteger('nextofkin_id');
    $table->enum('rsvp_status', ['yes', 'no', 'maybe'])->default('maybe');
    $table->text('comments')->nullable();
    $table->timestamps();
    
    $table->foreign('appointment_id')->references('id')->on('appointment')->onDelete('cascade');
    $table->foreign('nextofkin_id')->references('id')->on('nextofkin')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_rsvps');
    }
}
