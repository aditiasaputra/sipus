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
            'email'             => 'admin@admin.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        $principal = User::create([
            'name'              => 'Principal',
            'email'             => 'principal@principal.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        $teacher = User::create([
            'name'              => 'Teacher',
            'email'             => 'teacher@teacher.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);

        $student = User::create([
            'name'              => 'Student',
            'email'             => 'student@student.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);
    }
}
