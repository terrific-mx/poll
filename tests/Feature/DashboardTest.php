<?php

use App\Models\Poll;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});

test('dashboard lists polls', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $polls = Poll::factory()->count(3)->create();

    $response = $this->get('/dashboard');
    $response->assertOk();
    foreach ($polls as $poll) {
        $response->assertSee($poll->title);
    }
});
