<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('emergencyalert', function (Blueprint $table) {
            $table->string('urgency')->nullable();
            $table->text('details')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('emergencyalert', function (Blueprint $table) {
            $table->dropColumn(['urgency', 'details']);
        });
    }
};
