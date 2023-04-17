<?php

namespace Database\Seeders;

use App\Models\material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        material::create([
            'title' => 'Belajar Dasar Pemograman PHP',
            'subject' => 'Populernya PHP pada saat ini',
            'url' => 'https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse',
            'classes_id' => 1,
            'user_id' => 2
        ]);
        material::create([
            'title' => 'Belajar Tingkat Pemograman PHP ',
            'subject' => 'Populernya PHP pada saat ini',
            'url' => 'https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse',
            'classes_id' => 2,
            'user_id' => 2
        ]);
        material::create([
            'title' => 'Belajar Tingkat Pemograman PHP #1 ',
            'subject' => 'Populernya PHP pada saat ini',
            'url' => 'https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse',
            'classes_id' => 2,
            'user_id' => 2
        ]);
    }
}
