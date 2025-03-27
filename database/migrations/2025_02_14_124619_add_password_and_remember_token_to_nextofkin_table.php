<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordAndRememberTokenToNextofkinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nextofkin', function (Blueprint $table) {
            $table->string('password')->after('email');
            $table->rememberToken()->after('password');
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
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
        });
    }
}
