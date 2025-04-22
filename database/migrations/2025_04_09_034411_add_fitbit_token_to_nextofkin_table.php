<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFitbitTokenToNextofkinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('nextofkin', function (Blueprint $table) {
        $table->text('fitbit_token')->nullable();
    });
}

public function down()
{
    Schema::table('nextofkin', function (Blueprint $table) {
        $table->dropColumn('fitbit_token');
    });
}

}
