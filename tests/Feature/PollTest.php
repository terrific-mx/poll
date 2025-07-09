<?php

use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

describe('Poll creation', function () {
    it('the /polls/create route is accessible', function () {
        /** @var User */
        $user = User::factory()->create();

        actingAs($user)->get('/polls/create')->assertOk();
    });

    it('requires a poll name', function () {
        Volt::test('polls.create')
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    });

    it('creates a poll with answers', function () {
        $name = 'Poll with Answers';
        $question = 'What is your favorite option?';
        $answers = ['Yes', 'No', 'Maybe'];

        Volt::test('polls.create')
            ->set('name', $name)
            ->set('question', $question)
            ->set('answers', $answers)
            ->call('save')
            ->assertOk();

        $poll = Poll::with('answers')->first();

        expect($poll)->not->toBeNull();
        expect($poll->name)->toBe($name);
        expect($poll->question)->toBe($question);
        expect($poll->answers)->toHaveCount(count($answers));
        foreach ($answers as $answer) {
            expect($poll->answers->pluck('text'))->toContain($answer);
        }
    });
});
