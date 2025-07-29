<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TaskSubject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectIds = Subject::pluck('id')->toArray();
        $gradeIds = Grade::pluck('id')->toArray();
        $teacherIds = Teacher::pluck('id')->toArray();

        if (empty($subjectIds)) {
            Subject::factory()->count(5)->create();
            $subjectIds = Subject::pluck('id')->toArray();
        }

        if (empty($gradeIds)) {
            Grade::factory()->count(5)->create();
            $gradeIds = Grade::pluck('id')->toArray();
        }

        if (empty($teacherIds)) {
            Teacher::factory()->count(5)->create();
            $teacherIds = Teacher::pluck('id')->toArray();
        }

        if (empty($subjectIds) || empty($gradeIds) || empty($teacherIds)) {
            echo "Warning: Not enough subjects, grades, or teachers to create tasks. Skipping TaskSubject seeding.\n";
            return;
        }

        for ($i = 0; $i < 25; $i++) {
            TaskSubject::factory()->create([
                'subject_id' => $subjectIds[array_rand($subjectIds)],
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'teacher_id' => $teacherIds[array_rand($teacherIds)],
                'code' => fake()->unique()->lexify('TS-????'),
                'name' => fake()->sentence(3),
                'note' => fake()->paragraph(2),
                'file' => fake()->boolean(50) ? fake()->word() . '.pdf' : null,
            ]);
        }
    }
}
