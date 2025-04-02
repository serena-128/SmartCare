<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationPreferencesToNextofkinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('nextofkin', function (Blueprint $table) {
        $table->boolean('email_notifications')->default(true);
        $table->boolean('sms_notifications')->default(false);
        $table->boolean('carehome_updates')->default(true);
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('nextofkin', function (Blueprint $table) {
        $table->dropColumn(['email_notifications', 'sms_notifications', 'carehome_updates']);
    });
}

}
