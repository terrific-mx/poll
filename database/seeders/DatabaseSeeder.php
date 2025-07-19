<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Poll;
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

        // Define polls and answers
        $polls = [
            [
                'name' => 'Programming Languages',
                'question' => "What's your favorite programming language?",
                'answers' => ['Python', 'JavaScript', 'PHP', 'Ruby'],
            ],
            [
                'name' => 'Frontend Frameworks',
                'question' => 'Which frontend framework do you prefer?',
                'answers' => ['React', 'Vue', 'Angular', 'Svelte'],
            ],
            [
                'name' => 'Work Environment',
                'question' => 'Do you prefer working remotely or in an office?',
                'answers' => ['Remotely', 'In an office', 'Hybrid', 'No preference'],
            ],
        ];

        foreach ($polls as $pollData) {
            $poll = Poll::factory()->create([
                'name' => $pollData['name'],
                'question' => $pollData['question'],
            ]);
            $answers = collect($pollData['answers'])->map(function ($text) use ($poll) {
                return Answer::factory()->create([
                    'poll_id' => $poll->id,
                    'text' => $text,
                ]);
            });
        }
    }
}
