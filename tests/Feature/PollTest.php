<?php

use App\Models\Answer;
use App\Models\Poll;
use App\Models\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

it('creates a vote when a user submits a valid answer to a poll', function () {
    $poll = Poll::factory()->create();
    $answers = Answer::factory()->count(2)->for($poll)->create();

    Volt::test('polls.vote', ['poll' => $poll])
        ->set('answer', $answers->first()->id)
        ->call('vote');

    expect(Response::count())->toBe(1);
    expect(Response::first()->poll->is($poll))->toBeTrue();
    expect(Response::first()->answer->is($answers->first()))->toBeTrue();
});

it('stores contact iformation when a user submits a valid answer and contact', function () {
    $poll = Poll::factory()->create();
    $answers = Answer::factory()->count(2)->for($poll)->create();

    Volt::test('polls.vote', ['poll' => $poll])
        ->set('answer', $answers->first()->id)
        ->set('contact', 'test@example.com')
        ->call('vote');

    expect(Response::count())->toBe(1);
    expect(Response::first()->contact)->toBe('test@example.com');
});

it('validates email')->todo();
it('validates answers exist in the poll')->todo();
it('creates a poll with a name, question and at least two answers when logged it')->todo();
