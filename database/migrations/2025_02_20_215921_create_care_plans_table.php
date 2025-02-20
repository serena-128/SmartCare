<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('care_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id'); // Foreign key for the resident
            $table->text('medical_history')->nullable();
            $table->text('medications')->nullable();
            $table->text('treatments')->nullable();
            $table->text('dietary')->nullable();
            $table->text('preferences')->nullable();
            $table->unsignedBigInteger('created_by'); // Staff member who created the care plan
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('staff_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('care_plans');
    }
}
