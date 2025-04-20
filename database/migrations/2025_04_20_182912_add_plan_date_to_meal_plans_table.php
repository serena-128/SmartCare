<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanDateToMealPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('meal_plans', function (Blueprint $table) {
        $table->date('plan_date')->after('resident_id');
    });
}

public function down()
{
    Schema::table('meal_plans', function (Blueprint $table) {
        $table->dropColumn('plan_date');
    });
}

}
