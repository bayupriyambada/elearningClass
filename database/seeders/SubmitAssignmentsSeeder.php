<?php

namespace Database\Seeders;

use App\Models\submit;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmitAssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        submit::create([
            'subject' => 'Telah mengerjakan!',
            'url' => 'https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse',
            'isSubmit' => 1,
            'assignment_id' => 1,
            'user_id' => 3,
            'sent_assignment' => now()
        ]);
    }
}
