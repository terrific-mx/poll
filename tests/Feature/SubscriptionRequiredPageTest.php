<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('redirects a subscribed user to the dashboard when accessing the subscription-required page', function () {
    $user = User::factory()->withSubscription()->create();

    $response = actingAs($user)->get(route('subscription-required'));

    $response->assertRedirect(route('dashboard'));
});
