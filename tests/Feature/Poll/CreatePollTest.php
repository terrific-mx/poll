<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Poll;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

describe('Poll Creation via Volt', function () {
    it('fails to create a poll with missing name', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)->test('polls.create')
            ->set('name', '')
            ->set('question', 'What is your favorite color?')
            ->set('answers', ['Red', 'Blue'])
            ->call('submit')
            ->assertHasErrors(['name' => 'required']);
    });

    it('fails to create a poll with missing question', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)->test('polls.create')
            ->set('name', 'Color Poll')
            ->set('question', '')
            ->set('answers', ['Red', 'Blue'])
            ->call('submit')
            ->assertHasErrors(['question' => 'required']);
    });

    it('fails to create a poll with missing answers', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)->test('polls.create')
            ->set('name', 'Color Poll')
            ->set('question', 'What is your favorite color?')
            ->set('answers', [])
            ->call('submit')
            ->assertHasErrors(['answers' => 'min']);
    });

    it('fails to create a poll with less than two answers', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)->test('polls.create')
            ->set('name', 'Color Poll')
            ->set('question', 'What is your favorite color?')
            ->set('answers', ['Red'])
            ->call('submit')
            ->assertHasErrors(['answers' => 'min']);
    });

    it('creates a poll when all required fields are provided', function () {
        $user = User::factory()->create();

        $name = 'Color Poll';
        $question = 'What is your favorite color?';
        $answers = ['Red', 'Blue'];

        Volt::actingAs($user)
            ->test('polls.create')
            ->set('name', $name)
            ->set('question', $question)
            ->set('answers', $answers)
            ->call('submit')
            ->assertHasNoErrors();

        $poll = Poll::first();
        expect($poll)
            ->not->toBeNull()
            ->name->toBe($name)
            ->question->toBe($question);
        expect($poll->answers()->pluck('answer')->toArray())
            ->toEqualCanonicalizing($answers);
    });
});
