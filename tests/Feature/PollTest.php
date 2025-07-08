<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Poll;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

describe('Poll creation', function () {
    it('creates a poll with the given name', function () {
        $pollName = 'Test Poll';

        Volt::test('poll.create')
            ->set('name', $pollName)
            ->call('save')
            ->assertOk();

        assertDatabaseHas('polls', [
            'name' => $pollName,
        ]);
    });
});
