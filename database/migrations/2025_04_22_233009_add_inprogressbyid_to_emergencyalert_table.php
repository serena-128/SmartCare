<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInprogressbyidToEmergencyalertTable extends Migration
{
    public function up()
    {
        Schema::table('emergencyalert', function (Blueprint $table) {
            $table->unsignedBigInteger('inprogressbyid')->nullable()->after('triggeredbyid');

            $table->foreign('inprogressbyid')
                  ->references('id')
                  ->on('staffmembers')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('emergencyalert', function (Blueprint $table) {
            $table->dropForeign(['inprogressbyid']);
            $table->dropColumn('inprogressbyid');
        });
    }
}
