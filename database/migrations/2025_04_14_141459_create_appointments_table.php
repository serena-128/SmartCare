<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->dateTime('scheduled_for');
        $table->unsignedBigInteger('resident_id')->nullable(); // optional, if linking to resident
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('appointments');
}

}
