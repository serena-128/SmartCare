<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id('residentid'); // Primary key
            $table->string('firstname', 50); // Resident's first name
            $table->string('lastname', 50); // Resident's last name
            $table->date('dateofbirth'); // Date of birth
            $table->string('gender', 20); // Gender
            $table->integer('roomnumber'); // Room number
            $table->date('admissiondate'); // Admission date
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('residents');
    }
}
