<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('shift_changes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
        $table->date('shiftdate');
        $table->time('starttime');
        $table->time('endtime');
        $table->string('shifttype');
        $table->text('request_reason');
        $table->string('status')->default('Pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_changes');
    }
}
