<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('emergencyalerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residentid')->constrained('resident')->onDelete('cascade');
            $table->foreignId('triggeredbyid')->constrained('staffmember')->onDelete('cascade');
            $table->string('alerttype');
            $table->string('urgency');
            $table->text('details')->nullable();
            $table->timestamp('alerttimestamp')->default(now());
            $table->boolean('resolved')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emergencyalerts');
    }
};
