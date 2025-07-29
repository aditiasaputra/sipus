<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentUserIds = User::role('guru')->pluck('id')->toArray();

        foreach ($studentUserIds as $studentUserId) {
            if (!Student::where('user_id', $studentUserId)->exists()) {
                Student::factory()->create([
                    'user_id' => $studentUserId,
                    'student_id' => fake()->unique()->numerify('######'),
                ]);
            }
        }
    }
}
