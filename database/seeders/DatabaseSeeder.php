<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Poll;
use App\Models\Response;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Define polls and answers with popularity weights
        $polls = [
            [
                'name' => 'Programming Languages',
                'question' => "What's your favorite programming language?",
                'answers' => [
                    ['text' => 'Python', 'weight' => 0.4],
                    ['text' => 'JavaScript', 'weight' => 0.3],
                    ['text' => 'PHP', 'weight' => 0.2],
                    ['text' => 'Ruby', 'weight' => 0.1],
                ],
            ],
            [
                'name' => 'Frontend Frameworks',
                'question' => 'Which frontend framework do you prefer?',
                'answers' => [
                    ['text' => 'React', 'weight' => 0.5],
                    ['text' => 'Vue', 'weight' => 0.25],
                    ['text' => 'Svelte', 'weight' => 0.15],
                ],
            ],
            [
                'name' => 'Work Environment',
                'question' => 'Do you prefer working remotely or in an office?',
                'answers' => [
                    ['text' => 'Remotely', 'weight' => 0.5],
                    ['text' => 'In an office', 'weight' => 0.15],
                ],
            ],
        ];

        foreach ($polls as $pollData) {
            $poll = Poll::factory()->create([
                'name' => $pollData['name'],
                'question' => $pollData['question'],
            ]);

            // Create answers and keep mapping of text to id
            $answers = collect($pollData['answers'])->mapWithKeys(function ($answer) use ($poll) {
                $a = Answer::factory()->create([
                    'poll_id' => $poll->id,
                    'text' => $answer['text'],
                ]);
                return [$answer['text'] => [
                    'id' => $a->id,
                    'weight' => $answer['weight'],
                ]];
            });

            // Simulate 15 responses per poll, each with a random contact email
            for ($i = 0; $i < 15; $i++) {
                // 80% chance to respond
                if (fake()->boolean(80)) {
                    $selected = self::weightedRandom($answers->toArray());
                    $createdAt = now()->subDays(fake()->numberBetween(0, 30))->subMinutes(fake()->numberBetween(0, 1440));
                    Response::factory()->create([
                        'poll_id' => $poll->id,
                        'answer_id' => $selected['id'],
                        'contact_email' => fake()->unique()->safeEmail(),
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);
                }
            }
        }
    }

    /**
     * Select an answer using weighted probability.
     * @param array $answers Array of ['id' => ..., 'weight' => ...]
     * @return array
     */
    protected static function weightedRandom(array $answers): array
    {
        $total = array_sum(array_column($answers, 'weight'));
        $rand = fake()->randomFloat(4, 0, $total);
        $cumulative = 0;
        foreach ($answers as $answer) {
            $cumulative += $answer['weight'];
            if ($rand <= $cumulative) {
                return $answer;
            }
        }
        // fallback
        return end($answers);
    }
}
