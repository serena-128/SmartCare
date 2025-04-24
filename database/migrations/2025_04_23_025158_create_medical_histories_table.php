<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('resident_id');
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('type')->nullable(); // e.g. Surgery, Illness, Allergy, Injury
    $table->date('diagnosed_at')->nullable();
    $table->string('source')->nullable(); // e.g. Family, Medical Records, Previous GP
    $table->string('visibility')->default('private'); // e.g. public, staff_only, admin_only
    $table->unsignedBigInteger('added_by')->nullable(); // staffmember_id
    $table->timestamps();

    $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
    $table->foreign('added_by')->references('id')->on('staffmembers')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_histories');
    }
}
