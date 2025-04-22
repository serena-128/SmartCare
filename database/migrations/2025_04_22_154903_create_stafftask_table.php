<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStafftaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('stafftask', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('staff_id'); // foreign key to staffmember table
        $table->date('date');
        $table->time('time');
        $table->text('description')->nullable();
        $table->timestamps();

        // Optional: foreign key constraint
        $table->foreign('staff_id')->references('id')->on('staffmember')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stafftask');
    }
}
