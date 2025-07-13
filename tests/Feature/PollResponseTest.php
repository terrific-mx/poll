<?php

use App\Models\Answer;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

uses(RefreshDatabase::class);

describe('Poll Response Submission', function () {
    beforeEach(function () {
        $this->poll = Poll::factory()
            ->has(Answer::factory()->count(3))
            ->create();
        $this->answer = $this->poll->answers->first();
    });

    it('stores a response when a guest submits a valid answer', function () {
        Volt::test('polls.vote', ['poll' => $this->poll])
            ->set('answer_id', $this->answer->id)
            ->call('submit')
            ->assertHasNoErrors();
        expect($this->poll->responses()->first()->exists())
            ->toBeTrue();
    });

    it('redirects to the thank you page after a successful poll response', function () {
        Volt::test('polls.vote', ['poll' => $this->poll])
            ->set('answer_id', $this->answer->id)
            ->call('submit')
            ->assertRedirect(route('polls.public.thankyou', $this->poll->id));
    });

    it('stores the contact email with the poll response when provided', function () {
        $email = 'test@example.com';
        Volt::test('polls.vote', ['poll' => $this->poll])
            ->set('answer_id', $this->answer->id)
            ->set('contact_email', $email)
            ->call('submit')
            ->assertHasNoErrors();
        $pollResponse = $this->poll->responses()->first();
        expect($pollResponse)->not->toBeNull();
        expect($pollResponse->contact_email)->toBe($email);
    });

    it('rejects an invalid contact email and does not store the response', function () {
        $invalidEmail = 'not-an-email';
        Volt::test('polls.vote', ['poll' => $this->poll])
            ->set('answer_id', $this->answer->id)
            ->set('contact_email', $invalidEmail)
            ->call('submit')
            ->assertHasErrors(['contact_email']);
        expect($this->poll->responses()->count())->toBe(0);
    });
});
