<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roleid')->nullable()->constrained('roles')->onDelete('set null'); // Make sure the table is `roles`
            $table->foreignId('staffmemberid')->constrained('staffmembers')->onDelete('cascade'); // Make sure table is `staffmembers`
            $table->date('shiftdate');
            $table->time('starttime');
            $table->time('endtime');
            $table->string('shifttype', 50);

            // Self-reference for shift change requests
            $table->foreignId('requested_shift_id')->nullable()->constrained('schedules')->onDelete('set null');

            $table->enum('shift_status', ['Scheduled', 'Pending Change', 'Approved', 'Denied'])->default('Scheduled');
            $table->text('request_reason')->nullable();

            $table->foreignId('approved_by')->nullable()->constrained('staffmembers')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
