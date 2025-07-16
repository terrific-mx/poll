<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Poll;
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
            'poll_id' => Poll::factory(),
            'answer_id' => Answer::factory(),
            'contact_email' => $this->faker->optional()->safeEmail(),
        ];
    }
}
