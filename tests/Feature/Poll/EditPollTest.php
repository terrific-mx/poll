<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Poll;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

describe('Poll Editing via Volt', function () {
    it('fails to edit a poll with missing name', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', '')
            ->set('question', 'Updated Question')
            ->set('answers', ['Green', 'Yellow'])
            ->call('submit')
            ->assertHasErrors(['name' => 'required']);
    });

    it('fails to edit a poll with missing question', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', 'Updated Name')
            ->set('question', '')
            ->set('answers', ['Green', 'Yellow'])
            ->call('submit')
            ->assertHasErrors(['question' => 'required']);
    });

    it('fails to edit a poll with missing answers', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', 'Updated Name')
            ->set('question', 'Updated Question')
            ->set('answers', [])
            ->call('submit')
            ->assertHasErrors(['answers' => 'required']);
    });

    it('fails to edit a poll with less than two answers', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', 'Updated Name')
            ->set('question', 'Updated Question')
            ->set('answers', ['Green'])
            ->call('submit')
            ->assertHasErrors(['answers' => 'min']);
    });

    it('successfully edits a poll when all required fields are provided', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        $newName = 'Updated Name';
        $newQuestion = 'Updated Question';
        $newAnswers = ['Green', 'Yellow'];

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', $newName)
            ->set('question', $newQuestion)
            ->set('answers', $newAnswers)
            ->call('submit')
            ->assertHasNoErrors();

        $poll->refresh();
        expect($poll->name)->toBe($newName);
        expect($poll->question)->toBe($newQuestion);
        expect($poll->answers()->pluck('answer')->toArray())
            ->toEqualCanonicalizing($newAnswers);
    });

    it('can update answers (add, remove, change)', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        $updatedAnswers = ['Green', 'Yellow', 'Purple'];

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', 'Original Name')
            ->set('question', 'Original Question')
            ->set('answers', $updatedAnswers)
            ->call('submit')
            ->assertHasNoErrors();

        $poll->refresh();
        expect($poll->answers()->pluck('answer')->toArray())
            ->toEqualCanonicalizing($updatedAnswers);
    });

    it('fails to edit poll with duplicate answers', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', 'Original Name')
            ->set('question', 'Original Question')
            ->set('answers', ['Green', 'Green'])
            ->call('submit')
            ->assertHasErrors(['answers.0' => 'distinct']);
    });

    it('can individually add answers to a poll', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->call('addAnswer', 'Green')
            ->assertHasNoErrors();

        $poll->refresh();
        expect($poll->answers()->pluck('answer')->toArray())
            ->toEqualCanonicalizing(['Red', 'Blue', 'Green']);
    });

    it('can individually edit an answer', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        $answer = $poll->answers->first();
        Volt::test('polls.edit', ['poll' => $poll])
            ->call('editAnswer', $answer->id, 'Crimson')
            ->assertHasNoErrors();

        $poll->refresh();
        expect($poll->answers()->pluck('answer')->toArray())
            ->toEqualCanonicalizing(['Crimson', 'Blue']);
    });

    it('can individually delete an answer', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue', 'Green'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        $answer = $poll->answers->skip(1)->first();
        Volt::test('polls.edit', ['poll' => $poll])
            ->call('deleteAnswer', $answer->id)
            ->assertHasNoErrors();

        $poll->refresh();
        expect($poll->answers()->pluck('answer')->toArray())
            ->toEqualCanonicalizing(['Red', 'Green']);
    });

});
