<?php

use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Dashboard', function () {
    it('redirects guests to the login page', function () {
        $response = get('/dashboard');
        $response->assertRedirect('/login');
    });

    describe('as an authenticated user', function () {
        beforeEach(function () {
            $this->user = User::factory()->create();
            $this->actingAs($this->user);
        });

        it('can be visited', function () {
            $response = get('/dashboard');
            $response->assertStatus(200);
        });

        it('lists polls', function () {
            $polls = Poll::factory()->count(3)->create();
            $response = get('/dashboard');
            $response->assertOk();
            foreach ($polls as $poll) {
                $response->assertSee($poll->title);
            }
        });
    });
});
