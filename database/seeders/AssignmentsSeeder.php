<?php

namespace Database\Seeders;

use App\Models\assignment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        assignment::create([
            'title' => 'Tugas Tingkat Pemograman PHP #1 ',
            'subject' => 'Tugas PHP pada saat ini',
            'url' => 'https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse',
            'classes_id' => 2,
            'user_id' => 2,
            'due_date' => Carbon::now(),
            'end_date' => Carbon::yesterday()
        ]);
    }
}
