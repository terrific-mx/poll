<?php

use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(Refreshdatabase::class);

it('shows the vote poll page', function () {
    Poll::factory()->create();

    get('p/1')->assertOk();
});
