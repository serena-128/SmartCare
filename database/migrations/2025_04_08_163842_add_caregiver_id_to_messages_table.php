<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCaregiverIdToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->unsignedBigInteger('caregiver_id')->nullable();
    });
}

public function down()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropColumn('caregiver_id');
    });
}

}
