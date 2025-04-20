<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByToMealPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('meal_plans', function (Blueprint $table) {
        $table->unsignedBigInteger('created_by')->nullable()->after('quantity');
    });
}

public function down()
{
    Schema::table('meal_plans', function (Blueprint $table) {
        $table->dropColumn('created_by');
    });
}

}
