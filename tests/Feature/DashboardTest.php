<?php

use App\Models\Poll;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

describe('Dashboard', function () {
    it('redirects guests to the login page', function () {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    });

    describe('as an authenticated user', function () {
        beforeEach(function () {
            $this->user = User::factory()->create();
            $this->actingAs($this->user);
        });

        it('can be visited', function () {
            $response = $this->get('/dashboard');
            $response->assertStatus(200);
        });

        it('lists polls', function () {
            $polls = Poll::factory()->count(3)->create();
            $response = $this->get('/dashboard');
            $response->assertOk();
            foreach ($polls as $poll) {
                $response->assertSee($poll->title);
            }
        });
    });
});
