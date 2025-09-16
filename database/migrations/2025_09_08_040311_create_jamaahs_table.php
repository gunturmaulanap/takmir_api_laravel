
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
        Schema::create('jamaahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('profile_masjid_id')->constrained('profile_masjids')->cascadeOnDelete();
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('slug');
            $table->string('nama');
            $table->string('no_handphone');
            $table->text('alamat');
            $table->integer('umur');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('aktivitas_jamaah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jamaahs');
    }
};
