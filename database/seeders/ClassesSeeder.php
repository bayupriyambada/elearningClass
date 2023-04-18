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
            'id' => Str::uuid(),
            'name' => 'Belajar PHP',
            'subject' => 'Belajar dari dasar',
            'code' => Str::random(10),
            'user_id' => 2
        ]);
    }
}
