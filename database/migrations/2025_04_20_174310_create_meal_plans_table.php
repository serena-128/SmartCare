<?php

// database/migrations/xxxx_xx_xx_create_meal_plans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPlansTable extends Migration
{
    public function up()
    {
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained()->cascadeOnDelete();
            $table->enum('category',['breakfast','lunch','dinner','snacks','treats']);
            $table->text('meals');      // comma‑separated list
            $table->time('time');       // scheduled time
            $table->unsignedInteger('quantity')->nullable(); // only for snacks/treats
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_plans');
    }
}
