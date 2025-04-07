<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('care_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained()->cascadeOnDelete();
            $table->foreignId('caregiver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('caregiver_name')->nullable();  // ✅ Added
            $table->string('caregiver_type')->nullable();  // ✅ Added
            $table->enum('activity_type', ['Medication', 'Bathing', 'Feeding', 'Exercise']);
            $table->text('notes')->nullable();
            $table->timestamp('logged_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('care_logs');
    }
};
