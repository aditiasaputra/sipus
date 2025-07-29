<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['prefix' => 'MTK', 'name' => 'Matematika'],
            ['prefix' => 'IPA', 'name' => 'Ilmu Pengetahuan Alam'],
            ['prefix' => 'IPS', 'name' => 'Ilmu Pengetahuan Sosial'],
            ['prefix' => 'BIN', 'name' => 'Bahasa Indonesia'],
            ['prefix' => 'ENG', 'name' => 'Bahasa Inggris'],
            ['prefix' => 'AGM', 'name' => 'Agama'],
            ['prefix' => 'PKN', 'name' => 'Pendidikan Kewarganegaraan'],
            ['prefix' => 'SBD', 'name' => 'Seni Budaya'],
            ['prefix' => 'OR', 'name' => 'Olahraga'],
            ['prefix' => 'TIK', 'name' => 'Teknologi Informasi'],
            ['prefix' => 'FIS', 'name' => 'Fisika'],
            ['prefix' => 'KIM', 'name' => 'Kimia'],
            ['prefix' => 'BIO', 'name' => 'Biologi'],
            ['prefix' => 'GEO', 'name' => 'Geografi'],
            ['prefix' => 'EKO', 'name' => 'Ekonomi'],
            ['prefix' => 'SOS', 'name' => 'Sosiologi'],
            ['prefix' => 'MND', 'name' => 'Mandarin'],
            ['prefix' => 'JER', 'name' => 'Jerman'],
            ['prefix' => 'PRC', 'name' => 'Perancis'],
            ['prefix' => 'ARB', 'name' => 'Bahasa Arab'],
            ['prefix' => 'SEN', 'name' => 'Seni Musik'],
            ['prefix' => 'TAR', 'name' => 'Seni Tari'],
            ['prefix' => 'DRA', 'name' => 'Drama'],
            ['prefix' => 'KTG', 'name' => 'Keterampilan'],
            ['prefix' => 'LMK', 'name' => 'Lingkungan Hidup'],
        ];

        foreach ($subjects as $index => $subject) {
            Subject::create([
                'code' => $subject['prefix'] . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'name' => $subject['name'],
            ]);
        }
    }
}
