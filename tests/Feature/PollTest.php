<?php

use App\Models\Answer;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

it('creates a vote when a user submits a valid answer to a poll', function () {
    $poll = Poll::factory()->create();
    $answers = Answer::factory()->count(2)->for($poll)->create();

    Volt::test('polls.vote', ['poll' => $poll])
        ->set('answer', $answers->first()->id)
        ->call('vote');

    expect(Vote::count())->toBe(1);
    expect(Vote::first()->poll->is($poll))->toBeTrue();
    expect(Vote::first()->answer->is($answers->first()))->toBeTrue();
});

it('stores contact iformation when a user submits a valid answer and contact', function () {
    $poll = Poll::factory()->create();
    $answers = Answer::factory()->count(2)->for($poll)->create();

    Volt::test('polls.vote', ['poll' => $poll])
        ->set('answer', $answers->first()->id)
        ->set('contact', 'test@example.com')
        ->call('vote');

    expect(Vote::count())->toBe(1);
    expect(Vote::first()->contact)->toBe('test@example.com');
});
