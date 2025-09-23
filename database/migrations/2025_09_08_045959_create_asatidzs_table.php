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
        Schema::create('asatidzs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('profile_masjid_id')->constrained('profile_masjids')->cascadeOnDelete();
            $table->string('slug');
            $table->unique(['slug', 'profile_masjid_id']);
            $table->boolean('is_active')->default(true);
            $table->string('no_handphone');
            $table->text('alamat');
            $table->string('tugas');
            $table->enum('asatidz', ['ustadz', 'ustadzah']);
            $table->string('image')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asatidzs');
    }
};
