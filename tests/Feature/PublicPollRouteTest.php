<?php

use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('returns ok for the public poll route', function () {
    // Given a poll exists
    $poll = Poll::factory()->create();

    // When a guest visits the poll route
    $response = get("/p/{$poll->id}");

    // Then the response is OK
    $response->assertOk();
});
