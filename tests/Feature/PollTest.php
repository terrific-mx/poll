<?php

use App\Models\Answer;
use App\Models\Poll;
use App\Models\Response;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;
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

it('shows the poll voting page to users', function() {
    Poll::factory()->has(Answer::factory()->count(2))->create();

    get('/p/1')->assertOk();
});

it('validates email')->todo();
it('validates answers exist in the poll')->todo();

it('creates a poll when all required fields and at least two answers are provided', function () {
    Volt::test('polls.create')
        ->set('name', 'Test Poll')
        ->set('question', 'Question?')
        ->set('answers', [['text' => 'A'], ['text' => 'B']])
        ->call('save');

    expect(Poll::first())
        ->name->toBe('Test Poll')
        ->question->toBe('Question?')
        ->answers->count()->toBe(2);
});

it('shows create poll page to authenticated users', function() {
    /** @var User */
    $user = User::factory()->create();

    actingAs($user)->get('/polls/create')->assertOk();
});

it('redirects guests to the login page when accesing the create poll route', function() {
    get('/polls/create')->assertRedirect('/login');
});

it('validates name required')->todo();
it('validates question required')->todo();

it('updates a poll with all required fields')->todo();

it('successfully deletes a poll', function() {
    $poll = Poll::factory()->create();

    Volt::test('polls.delete', ['poll' => $poll])
        ->call('destroy');

    expect($poll->fresh())->toBeNull();
});
