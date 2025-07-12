<?php

use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Public Poll Route', function () {
    beforeEach(function () {
        $this->poll = Poll::factory()->create();
    });

    it('allows guests to view a public poll', function () {
        $response = get("/p/{$this->poll->id}");
        $response->assertOk();
    });
});
