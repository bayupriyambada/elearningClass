<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ClassesSeeder;
use Database\Seeders\MaterialsSeeder;
use Database\Seeders\AssignmentsSeeder;
use Database\Seeders\AttendancesSeeder;
use Database\Seeders\SubmitAssignmentsSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()
        //     ->count(50)->create();
        // $this->call([]);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(ClassesSeeder::class);

        // $this->call(AttendancesSeeder::class);
        // $this->call(MaterialsSeeder::class);
        // $this->call(AssignmentsSeeder::class);
        // $this->call(SubmitAssignmentsSeeder::class);
    }
}
