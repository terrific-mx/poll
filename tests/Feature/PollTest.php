<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Poll;
use Livewire\Volt\Volt;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

describe('Poll creation', function () {
    it('requires a poll name', function () {
        Volt::test('polls.create')
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    });
    it('creates a poll with the given name', function () {
        $pollName = 'Test Poll';

        Volt::test('polls.create')
            ->set('name', $pollName)
            ->call('save')
            ->assertOk();

        assertDatabaseHas('polls', [
            'name' => $pollName,
        ]);
    });

    it('creates a poll with answers', function () {
        $pollName = 'Poll with Answers';
        $answers = ['Yes', 'No', 'Maybe'];

        Volt::test('polls.create')
            ->set('name', $pollName)
            ->set('answers', $answers)
            ->call('save')
            ->assertOk();

        $poll = Poll::where('name', $pollName)->first();
        expect($poll)->not->toBeNull();
        foreach ($answers as $answer) {
            assertDatabaseHas('answers', [
                'poll_id' => $poll->id,
                'text' => $answer,
            ]);
        }
    });
});
