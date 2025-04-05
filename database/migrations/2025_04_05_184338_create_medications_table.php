<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id'); // Change to unsignedBigInteger to match resident.id
            $table->string('medication_name');
            $table->string('dosage');
            $table->dateTime('schedule_time');
            $table->enum('status', ['scheduled', 'missed', 'confirmed'])->default('scheduled');
            $table->timestamps();
    
            // Add foreign key constraint
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
}
