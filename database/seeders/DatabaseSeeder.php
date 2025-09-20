<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan yang benar:
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);

        // Pastikan ProfileMasjidTableSeeder dijalankan sebelum AktivitasJamaahTableSeeder
        $this->call(ProfileMasjidTableSeeder::class);
        $this->call(AktivitasJamaahTableSeeder::class);
        $this->call(JamaahTableSeeder::class);
    }
}
