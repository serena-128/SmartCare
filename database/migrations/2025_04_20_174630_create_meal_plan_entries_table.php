<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPlanEntriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meal_plan_entries', function (Blueprint $table) {
            $table->id();
            // reference back to the master plan
            $table->foreignId('meal_plan_id')
                  ->constrained('meal_plans')
                  ->cascadeOnDelete();

            // at what time they actually ate
            $table->time('time')->nullable();

            // did they eat none / some / all?
            $table->enum('consumed', ['none', 'some', 'all'])
                  ->default('none');

            // any notes (e.g. “refused yogurt”)
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plan_entries');
    }
}
