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
        // operator default uuid: b100d95b-271c-4569-9841-5c2e6f3d338f
        User::create([
            'id' => 'b100d95b-271c-4569-9841-5c2e6f3d338f',
            'fullname' => 'operator Sekolah',
            'username' => 'operator',
            'email' => 'operator@school.com',
            'email_verified_at' => now(),
            'password' => Hash::make('operator'),
            'registrationCode' => Date('Y') . Str::random(8),
            'avatar' => Date('Y') . Str::random(15) . 'png',
            'role_id' => 1
        ]);
        //  teacher default uuid: 0ed20c44-687a-4392-8360-8e64f1f28698
        User::create([
            'id' => '0ed20c44-687a-4392-8360-8e64f1f28698',
            'fullname' => 'Bayu Priyambada',
            'username' => 'bayupm',
            'email' => 'bayupm@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('school'),
            'registrationCode' => Date('Y') . Str::random(8),
            'avatar' => Date('Y') . Str::random(15) . 'png',
            'role_id' => 2
        ]);
        // user default uuid: c4a04a83-4aef-49c0-b65a-d5fca528d151
        User::create([
            'id' => 'c4a04a83-4aef-49c0-b65a-d5fca528d151',
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
