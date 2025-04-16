<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    if (!Schema::hasTable('schedule')) {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roleid')->nullable()->constrained('role')->onDelete('set null');
            $table->foreignId('staffmemberid')->constrained('staffmember')->onDelete('cascade');
            $table->date('shiftdate');
            $table->time('starttime');
            $table->time('endtime');
            $table->string('shifttype', 50);
            $table->foreignId('requested_shift_id')->nullable()->constrained('schedule')->onDelete('set null');
            $table->enum('shift_status', ['Scheduled', 'Pending Change', 'Approved', 'Denied'])->default('Scheduled');
            $table->text('request_reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('staffmember')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}


    public function down()
    {
        Schema::dropIfExists('schedule');
    }
};
