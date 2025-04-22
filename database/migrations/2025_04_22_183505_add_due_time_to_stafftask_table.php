<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDueTimeToStafftaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('stafftask', function (Blueprint $table) {
        $table->time('due_time')->nullable()->after('due_date');
    });
}

public function down()
{
    Schema::table('stafftask', function (Blueprint $table) {
        $table->dropColumn('due_time');
    });
}

}
