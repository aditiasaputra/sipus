<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Teacher;
use App\Models\TeachMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeachMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradeIds = Grade::pluck('id')->toArray();
        $teacherIds = Teacher::pluck('id')->toArray();

        if (empty($gradeIds)) {
            Grade::factory()->count(5)->create();
            $gradeIds = Grade::pluck('id')->toArray();
        }

        if (empty($teacherIds)) {
            Teacher::factory()->count(5)->create();
            $teacherIds = Teacher::pluck('id')->toArray();
        }

        if (empty($gradeIds) || empty($teacherIds)) {
            echo "Warning: Not enough grades or teachers to create teaching materials. Skipping TeachMaterial seeding.\n";
            return;
        }

        for ($i = 0; $i < 25; $i++) {
            TeachMaterial::factory()->create([
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'teacher_id' => $teacherIds[array_rand($teacherIds)],
                'code' => strtoupper(fake()->unique()->lexify('TM-???')),
                'name' => fake()->sentence(4),
                'note' => fake()->paragraph(2),
                'file' => fake()->boolean(70) ? fake()->word() . '.pdf' : null,
            ]);
        }
    }
}
