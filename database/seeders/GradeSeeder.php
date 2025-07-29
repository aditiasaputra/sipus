<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherIds = Teacher::pluck('id')->toArray();

        if (empty($teacherIds)) {
            Teacher::factory()->count(5)->create();
            $teacherIds = Teacher::pluck('id')->toArray();
        }

        $gradesData = [
            ['code' => 'GRD01', 'name' => 'Kelas 1'],
            ['code' => 'GRD02', 'name' => 'Kelas 2'],
            ['code' => 'GRD03', 'name' => 'Kelas 3'],
            ['code' => 'GRD04', 'name' => 'Kelas 4'],
            ['code' => 'GRD05', 'name' => 'Kelas 5'],
            ['code' => 'GRD06', 'name' => 'Kelas 6'],
            ['code' => 'GRD07', 'name' => 'Kelas 7'],
            ['code' => 'GRD08', 'name' => 'Kelas 8'],
            ['code' => 'GRD09', 'name' => 'Kelas 9'],
            ['code' => 'GRD10', 'name' => 'Kelas 10'],
            ['code' => 'GRD11', 'name' => 'Kelas 11'],
            ['code' => 'GRD12', 'name' => 'Kelas 12'],
        ];

        foreach ($gradesData as $gradeData) {
            $randomTeacherId = $teacherIds[array_rand($teacherIds)];

            Grade::firstOrCreate(
                ['code' => $gradeData['code']],
                [
                    'name' => $gradeData['name'],
                    'teacher_id' => $randomTeacherId,
                ]
            );
        }
    }
}
