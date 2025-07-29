<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    private static $subjectCodes = [
        'MTK', 'IPA', 'IPS', 'BIN', 'ENG', 'AGM', 'PKN', 'SBD', 'OR', 'TIK'
    ];

    private static $usedCodes = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->generateUniqueCode(),
            'name' => fake()->words(2, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function generateUniqueCode(): string
    {
        do {
            $prefix = fake()->randomElement(self::$subjectCodes);
            $number = str_pad(fake()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT);
            $code = $prefix . '-' . $number;
        } while (in_array($code, self::$usedCodes));

        self::$usedCodes[] = $code;
        return $code;
    }
}
