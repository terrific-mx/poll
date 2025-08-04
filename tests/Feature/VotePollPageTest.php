<?php

use App\Models\Option;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

uses(Refreshdatabase::class);

it('shows the vote poll page', function () {
    Poll::factory()->create(['id' => '01HZYXTESTULID1234567890']);

    get('p/01HZYXTESTULID1234567890')->assertOk();
});

it('saves the vote', function () {
    $poll = Poll::factory()->create();
    $option = Option::factory()->for($poll)->create();

    $component = Volt::test('pages.polls.vote', ['poll' => $poll])
        ->set('option', $option->id)
        ->call('vote');

    expect($poll->responses()->count())->toBe(1);
    expect($poll->responses()->first()->option_id)->toBe($option->id);
});
