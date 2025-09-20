<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProfileMasjid;
use Illuminate\Support\Str;

class ProfileMasjidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masjids = [
            [
                'name' => 'Masjid Nurul Ashri',
                'alamat' => 'Jalan Deresan III, Gejayan, Sleman',
                'user_email' => 'suyitno@gmail.com',
            ],
            [
                'name' => 'Masjid Kampus UGM',
                'alamat' => 'Jalan Lingkar Utara, Bulaksumur, Sleman',
                'user_email' => 'dwi-aryo@gmail.com',
            ],
            [
                'name' => 'Masjid Gedhe Kauman',
                'alamat' => 'Jalan Alun-Alun Utara, Kota Yogyakarta',
                'user_email' => 'putri-dian@gmail.com',
            ],
            [
                'name' => 'Masjid Jogokariyan',
                'alamat' => 'Jalan Jogokariyan, Mantrijeron, Kota Yogyakarta',
                'user_email' => 'anisa-ratna@gmail.com',
            ],
            [
                'name' => 'Masjid Syuhada',
                'alamat' => 'Jalan I Dewa Nyoman Oka, Kotabaru, Kota Yogyakarta',
                'user_email' => 'joko-susilo@gmail.com',
            ],
            [
                'name' => 'Masjid Al-Falah',
                'alamat' => 'Jalan Cempaka, Condongcatur, Sleman',
                'user_email' => 'wahyu-aji@gmail.com',
            ]
        ];

        foreach ($masjids as $masjid) {
            $user = User::where('email', $masjid['user_email'])->first();
            if ($user) {
                ProfileMasjid::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nama' => $masjid['name'],
                        'alamat' => $masjid['alamat'],
                        'image' => null,
                    ]
                );
            }
        }
    }
}
