<?php

namespace Database\Seeders;

use App\Models\attendance;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        attendance::create([
            'date_attendance' => Carbon::now(),
            'isAbsensi' => (int) 1,
            'user_id' => 2,
            'classes_id' => 1,
        ]);
        attendance::create([
            'date_attendance' => Carbon::now(),
            'isAbsensi' => (int) 1,
            'user_id' => 3,
            'classes_id' => 1,
        ]);
    }
}
