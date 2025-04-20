<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('meal_plans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resident_id')
              ->constrained('resident')
              ->onDelete('cascade');
        $table->date('plan_date');
        $table->text('meals');              // ← use text instead of JSON
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('meal_plans');
    }
}
