<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

it('creates a poll with a name a question and at least two poll options', function () {
    $user = User::factory()->create();

    Volt::actingAs($user)->test('pages.dashboard')
        ->set('pollName', 'Poll Name')
        ->set('pollQuestion', 'Poll Question')
        ->set('pollOptions', ['Option 1', 'Option 2'])
        ->call('createPoll');

    expect(Poll::count())->toBe(1);

    tap(Poll::first(), function ($poll) {
        expect($poll->name)->toBe('Poll Name');
        expect($poll->question)->toBe('Poll Question');
        expect($poll->options)->toHaveCount(2);
        expect($poll->options[0]->name)->toBe('Option 1');
        expect($poll->options[1]->name)->toBe('Option 2');
    });
})->todo();

todo('create an endpoint to view the poll like /p/{pollUuid}');
todo('store visitor responses to the poll');
todo('optionally store visitor email to the poll response');
