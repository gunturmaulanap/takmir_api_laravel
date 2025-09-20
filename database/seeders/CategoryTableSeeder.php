<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            'takmir',
            'jamaah',
            'imam',
            'khatib',
            'muadzin',
            'asatidz',
            'event',
            'kalender',
            'profileMasjid',
            'modul'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'user_id' => 1, // Mengasumsikan ID 1 adalah superadmin
            ]);
        }
    }
}
