<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fullname' => 'operator Sekolah',
            'username' => 'operator',
            'email' => 'operator@school.com',
            'email_verified_at' => now(),
            'password' => Hash::make('operator'),
            'registrationCode' => Date('Y') . Str::random(8),
            'avatar' => Date('Y') . Str::random(15) . 'png',
            'role_id' => 1
        ]);
        User::create([
            'fullname' => 'Bayu Priyambada',
            'username' => 'bayupm',
            'email' => 'bayupm@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('school'),
            'registrationCode' => Date('Y') . Str::random(8),
            'avatar' => Date('Y') . Str::random(15) . 'png',
            'role_id' => 2
        ]);
        User::create([
            'fullname' => 'Student Working',
            'username' => 'student',
            'email' => 'student@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('school'),
            'registrationCode' => Date('Y') . Str::random(8),
            'avatar' => Date('Y') . Str::random(15) . 'png',
            'role_id' => 3
        ]);
    }
}
