<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('roletype')->default('Staff'); // Set default value for roletype
            $table->string('contactnumber')->nullable(); // Optional: make nullable if not every role requires a contact number
            $table->string('email')->unique(); // Ensure email is unique
            $table->date('employmentstartdate');
            $table->timestamps();
            $table->softDeletes();  // Adds the "deleted_at" column for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
