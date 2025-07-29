<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Teach;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradeIds = Grade::pluck('id')->toArray();
        $subjectIds = Subject::pluck('id')->toArray();
        $teacherIds = Teacher::pluck('id')->toArray();

        if (empty($gradeIds)) {
            Grade::factory()->count(5)->create();
            $gradeIds = Grade::pluck('id')->toArray();
        }

        if (empty($subjectIds)) {
            Subject::factory()->count(5)->create();
            $subjectIds = Subject::pluck('id')->toArray();
        }

        if (empty($teacherIds)) {
            Teacher::factory()->count(5)->create();
            $teacherIds = Teacher::pluck('id')->toArray();
        }

        if (empty($gradeIds) || empty($subjectIds) || empty($teacherIds)) {
            echo "Warning: Not enough grades, subjects, or teachers to create teachings. Skipping Teach seeding.\n";
            return;
        }

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $times = ['08:00-09:00', '09:00-10:00', '10:00-11:00', '13:00-14:00', '14:00-15:00'];
        $rooms = ['R.101', 'R.102', 'R.201', 'R.202', 'Lab Komputer', 'Lab IPA'];

        
        for ($i = 0; $i < 30; $i++) {
            $time = fake()->randomElement($times);

            Teach::factory()->create([
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'subject_id' => $subjectIds[array_rand($subjectIds)],
                'teacher_id' => $teacherIds[array_rand($teacherIds)],
                'code' => strtoupper(fake()->unique()->lexify('tch-???')),
                'name' => fake()->randomElement($days) . ' ' . $time,
                'time' => $time,
                'room' => fake()->randomElement($rooms),
            ]);
        }
    }
}
