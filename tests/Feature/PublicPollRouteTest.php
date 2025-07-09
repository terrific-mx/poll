<?php

use App\Models\Poll;
use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns ok for the public poll route', function () {
    // Given a poll exists
    $poll = Poll::factory()->create();

    // When a guest visits the poll route
    $response = get("/p/{$poll->id}");

    // Then the response is OK
    $response->assertOk();
});
