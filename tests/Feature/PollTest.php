<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Poll;
use Livewire\Volt\Volt;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

describe('Poll creation', function () {
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
});
