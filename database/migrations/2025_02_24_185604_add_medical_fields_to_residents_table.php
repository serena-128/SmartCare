<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicalFieldsToResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('resident', function (Blueprint $table) {
        $table->text('medical_history')->nullable();
        $table->text('allergies')->nullable();
        $table->text('medications')->nullable();
        $table->text('doctor_notes')->nullable();
    });
}

public function down()
{
    Schema::table('resident', function (Blueprint $table) {
        $table->dropColumn(['medical_history', 'allergies', 'medications', 'doctor_notes']);
    });
}

}
