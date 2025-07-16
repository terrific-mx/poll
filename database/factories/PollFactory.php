<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poll>
 */
class PollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'question' => $this->faker->sentence(),
        ];
    }

    public function withAnswers(array $answers)
    {
        return $this->has(
            Answer::factory()->sequence(...array_map(fn($a) => ['answer' => $a], $answers)),
        );
    }
}
