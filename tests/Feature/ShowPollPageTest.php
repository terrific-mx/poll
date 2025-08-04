<?php

use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(Refreshdatabase::class);

it('shows the poll page', function () {
    /** @var User */
    $user = User::factory()->withSubscription()->create();
    Poll::factory()->for($user)->create();

    actingAs($user)->get('polls/1')->assertOk();
});

it('redirects guest to login page', function () {
    Poll::factory()->create();

    get('polls/1')->assertRedirect(route('login'));
});
