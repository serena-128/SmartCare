<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('notifications', function (Blueprint $table) {
        // Commenting this out to avoid duplicate FK error
        // $table->foreign('nextofkin_id')->references('id')->on('nextofkin')->onDelete('cascade');
    });
}


public function down()
{
    Schema::table('notifications', function (Blueprint $table) {
        // Example: Dropping the foreign key
        $table->dropForeign(['nextofkin_id']);
    });
}

}
