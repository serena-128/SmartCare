<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id(); // Laravel will default this to 'id'
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth');
            $table->string('gender', 20);
            $table->integer('room_number')->nullable();     // Optional
            $table->date('admission_date')->nullable();      // Optional
            $table->timestamps(); // Includes created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('residents');
    }
}
