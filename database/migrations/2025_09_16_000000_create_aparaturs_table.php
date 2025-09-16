<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aparaturs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('role');
            $table->string('image')->nullable();
            $table->foreignId('profile_masjid_id')->constrained('profile_masjids')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparaturs');
    }
};
