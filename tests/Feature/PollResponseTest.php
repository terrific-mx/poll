<?php

use App\Models\Answer;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('allows a guest to submit a poll response', function () {
    // Create a poll with answers
    $poll = Poll::factory()
        ->has(Answer::factory()->count(3))
        ->create();

    $answer = $poll->answers->first();

    // Post a response as a guest
    $response = post("/p/{$poll->id}", [
        'answer_id' => $answer->id,
    ]);

    $response->assertStatus(302)->assertSessionHasNoErrors();

    // Assert the response is stored using Pest expectation API
    expect($poll->responses()->where('answer_id', $answer->id)->exists())
        ->toBeTrue();
});
