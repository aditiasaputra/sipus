<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $adminUser = User::create([
            'name'              => 'Administrator',
            'username'          => 'administrator',
            'email'             => 'admin@admin.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        $principal = User::create([
            'name'              => 'Principal',
            'username'          => 'principal',
            'email'             => 'principal@principal.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        $teacher = User::create([
            'name'              => 'Teacher',
            'username'          => 'teacher',
            'email'             => 'teacher@teacher.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        $student = User::create([
            'name'              => 'Student',
            'username'          => 'student',
            'email'             => 'student@student.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);
    }
}
