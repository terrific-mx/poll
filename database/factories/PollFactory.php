<?php

namespace Database\Factories;

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

    public function withAnswers(array $answers): self
    {
        return $this->has(
            \App\Models\Answer::factory()->sequence(...array_map(fn($a) => ['answer' => $a], $answers)),
            'answers'
        );
    }
}
