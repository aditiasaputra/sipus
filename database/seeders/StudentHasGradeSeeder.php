<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentHasGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentIds = Student::pluck('id')->toArray();
        if (empty($studentIds)) {
            $users = User::factory()->count(10)->create();
            foreach ($users as $user) {
                Student::factory()->create(['user_id' => $user->id]);
            }
            $studentIds = Student::pluck('id')->toArray();
        }

        $gradeIds = Grade::pluck('id')->toArray();
        if (empty($gradeIds)) {
            $teachers = Teacher::factory()->count(5)->create();
            foreach ($teachers as $teacher) {
                Grade::factory()->create(['teacher_id' => $teacher->id]);
            }
            $gradeIds = Grade::pluck('id')->toArray();
        }

        if (empty($studentIds) || empty($gradeIds)) {
            echo "Warning: No students or grades found/created. Skipping student_has_grade seeding.\n";
            return;
        }

        $maxRelations = 50;
        $numberOfPossibleCombinations = count($studentIds) * count($gradeIds);
        $relationsToCreate = min($maxRelations, $numberOfPossibleCombinations);

        $insertedCombinations = [];

        for ($i = 0; $i < $relationsToCreate; $i++) {
            $randomStudentId = $studentIds[array_rand($studentIds)];
            $randomGradeId = $gradeIds[array_rand($gradeIds)];

            $combinationKey = $randomStudentId . '-' . $randomGradeId;

            if (!in_array($combinationKey, $insertedCombinations)) {
                DB::table('student_has_grade')->insert([
                    'student_id' => $randomStudentId,
                    'grade_id' => $randomGradeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $insertedCombinations[] = $combinationKey;
            } else {
                $relationsToCreate++;
                if ($relationsToCreate > $maxRelations * 2) {
                    break;
                }
            }
        }
    }
}
