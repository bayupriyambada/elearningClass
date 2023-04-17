<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classes::create([
            'name' => 'Belajar PHP Dasar',
            'subject' => 'php',
            'code' => Str::random(10),
            'user_id' => 2
        ]);
        Classes::create([
            'name' => 'Belajar PHP Dasar #1',
            'subject' => 'php',
            'code' => Str::random(10),
            'user_id' => 2
        ]);
    }
}
