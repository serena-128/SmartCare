<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNextofkinsTable extends Migration
{
    public function up()
    {
        Schema::create('nextofkins', function (Blueprint $table) {
            $table->id('nextofkinid'); // Primary key
            $table->foreignId('residentid')->constrained('residents', 'residentid')->onDelete('cascade');
 // Foreign key linking to the residents table
            $table->string('firstname', 50); // First name of the next of kin
            $table->string('lastname', 50); // Last name of the next of kin
            $table->string('relationshiptoresident', 100); // Relationship to the resident
            $table->string('contactnumber', 15); // Contact number
            $table->string('email', 100); // Email address
            $table->string('address', 100); // Address
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('nextofkins');
    }
}

