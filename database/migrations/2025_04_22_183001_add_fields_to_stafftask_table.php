<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToStafftaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('stafftask', function (Blueprint $table) {
        $table->string('title')->nullable();
        $table->dateTime('due_date')->nullable();
        $table->enum('status', ['Uncompleted', 'In Progress', 'Completed'])->default('Uncompleted');
    });
}

public function down()
{
    Schema::table('stafftask', function (Blueprint $table) {
        $table->dropColumn(['title', 'due_date', 'status']);
    });
}

}
