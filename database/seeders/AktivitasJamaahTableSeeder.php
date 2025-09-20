<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AktivitasJamaah;

class AktivitasJamaahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            'TPA',
            'Belajar Fiqh',
            'Shalat Jamaah',
            'Kajian Rutin',
            'Kajian Bukber',
            'Pengajian Umum',
            'Bimbingan Haji & Umrah',
            'Pesantren Kilat',
            'Santunan Yatim & Duafa',
            'Pelatihan Menulis Kaligrafi',
        ];

        // Loop 6 times for user_id 2 to 7 and profile_masjid_id 1 to 6
        for ($i = 1; $i <= 6; $i++) {
            $userId = $i + 1;
            $profileMasjidId = $i;

            foreach ($activities as $activity) {
                AktivitasJamaah::firstOrCreate(
                    [
                        'user_id' => $userId,
                        'profile_masjid_id' => $profileMasjidId,
                        'nama' => $activity,
                    ],
                    [
                        'user_id' => $userId,
                        'profile_masjid_id' => $profileMasjidId,
                        'nama' => $activity,
                    ]
                );
            }
        }
    }
}
