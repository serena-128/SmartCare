<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('nextofkin', function (Blueprint $table) {
            $table->timestamp('last_login')->nullable()->after('email'); // Adds last_login column
        });
    }

    public function down()
    {
        Schema::table('nextofkin', function (Blueprint $table) {
            $table->dropColumn('last_login');
        });
    }
};
