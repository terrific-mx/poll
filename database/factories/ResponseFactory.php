<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Response>
 */
class ResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poll_id' => \App\Models\Poll::factory(),
            'answer_id' => \App\Models\Answer::factory(),
            'contact_email' => $this->faker->optional()->safeEmail(),
        ];
    }
}
