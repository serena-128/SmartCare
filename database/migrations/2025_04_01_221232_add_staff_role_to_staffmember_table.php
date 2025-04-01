<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStaffRoleToStaffmemberTable extends Migration
{
    public function up()
    {
        Schema::table('staffmember', function (Blueprint $table) {
            $table->string('staff_role')->nullable(); // Add the staff_role column
        });
    }

    public function down()
    {
        Schema::table('staffmember', function (Blueprint $table) {
            $table->dropColumn('staff_role'); // Drop the staff_role column if the migration is rolled back
        });
    }
}
