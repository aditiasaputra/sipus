<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherUserIds = User::role('guru')->pluck('id')->toArray();

        foreach ($teacherUserIds as $teacherUserId) {
            if (!Teacher::where('user_id', $teacherUserId)->exists()) {
                Teacher::factory()->create([
                    'user_id' => $teacherUserId,
                    'teacher_id' => fake()->unique()->numerify('######'),
                ]);
            }
        }
    }
}
