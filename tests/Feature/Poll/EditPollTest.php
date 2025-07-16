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
            ->call('submit')
            ->assertHasErrors(['question' => 'required']);
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

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', $newName)
            ->set('question', $newQuestion)
            ->call('submit')
            ->assertHasNoErrors();

        $poll->refresh();
        expect($poll->name)->toBe($newName);
        expect($poll->question)->toBe($newQuestion);
    });
});
