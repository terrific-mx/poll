<?php

use App\Models\Answer;
use App\Models\Poll;
use App\Models\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Poll Response', function () {
    it('stores a response with poll ID and answer ID', function () {
        $poll = Poll::factory()->create();
        $answer = Answer::factory()->for($poll)->create();

        Volt::test('poll.respond', ['poll' => $poll])
            ->set('answer_id', $answer->id)
            ->call('submit')
            ->assertHasNoErrors();

        $response = Response::first();
        expect($response)->not->toBeNull();
        expect($response->poll_id)->toBe($poll->id);
        expect($response->answer_id)->toBe($answer->id);
    });

    it('stores a response with poll ID, answer ID, and contact email', function () {
        $poll = Poll::factory()->create();
        $answer = Answer::factory()->for($poll)->create();
        $email = 'user@example.com';

        Volt::test('poll.respond', ['poll' => $poll])
            ->set('answer_id', $answer->id)
            ->set('contact_email', $email)
            ->call('submit')
            ->assertHasNoErrors();

        $response = Response::first();
        expect($response)->not->toBeNull();
        expect($response->poll_id)->toBe($poll->id);
        expect($response->answer_id)->toBe($answer->id);
        expect($response->contact_email)->toBe($email);
    });

    it('returns validation error if required fields are missing', function () {
        $poll = Poll::factory()->create();
        Volt::test('poll.respond', ['poll' => $poll])
            ->call('submit')
            ->assertHasErrors(['answer_id']);
    });

    it('stores a response with contact email if provided', function () {
        $poll = Poll::factory()->create();
        $answer = Answer::factory()->for($poll)->create();
        $email = 'contact@example.com';

        Volt::test('poll.respond', ['poll' => $poll])
            ->set('answer_id', $answer->id)
            ->set('contact_email', $email)
            ->call('submit')
            ->assertHasNoErrors();

        $response = Response::first();
        expect($response)->not->toBeNull();
        expect($response->poll_id)->toBe($poll->id);
        expect($response->answer_id)->toBe($answer->id);
        expect($response->contact_email)->toBe($email);
    });

    it('successfully requests the poll response route', function () {
        Poll::factory()->create();

        get('/p/1')->assertStatus(200);
    });
});
