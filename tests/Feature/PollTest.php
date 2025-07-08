<?php

use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('Poll creation', function () {
    it('the /polls/create route is accessible', function () {
        actingAs(\App\Models\User::factory()->create());
        get('/polls/create')->assertOk();
    });
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
