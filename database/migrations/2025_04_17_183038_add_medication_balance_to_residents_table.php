<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicationBalanceToResidentsTable extends Migration
{
        public function up()
    {
        Schema::table('resident', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->decimal('medication_account_balance', 10, 2)->default(0)->after('medications');
        });
    }

    public function down()
    {
        Schema::table('resident', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropColumn('medication_account_balance');
        });
    }

}
