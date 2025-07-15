<?php

use App\Models\Answer;
use App\Models\Poll;
use App\Models\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

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

it('show the submit response view to users', function() {
    Poll::factory()->has(Answer::factory()->count(2))->create();

    get('/p/1')->assertOk();
});

it('validates email')->todo();
it('validates answers exist in the poll')->todo();

it('creates a poll with required fields and minimun answers', function () {
    Volt::test('polls.create')
        ->set('name', 'Test Poll')
        ->set('question', 'Question?')
        ->call('save');

    expect(Poll::first())
        ->name->toBe('Test Poll')
        ->question->toBe('Question?');
});

it('redirects to login when visiting the create poll as guests')->todo();
it('authenticated users can see the create poll page')->todo();
it('validates name required')->todo();
it('validates question required')->todo();
