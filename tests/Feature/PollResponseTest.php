<?php

use App\Models\Answer;
use App\Models\Poll;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Poll Response Submission', function () {
    beforeEach(function () {
        $this->poll = Poll::factory()
            ->has(Answer::factory()->count(3))
            ->create();
        $this->answer = $this->poll->answers->first();
    });

    it('stores a response when a guest submits a valid answer', function () {
        $response = post("/p/{$this->poll->id}", [
            'answer_id' => $this->answer->id,
        ]);
        $response->assertStatus(302)->assertSessionHasNoErrors();
        expect($this->poll->responses()->first()->exists())
            ->toBeTrue();
    });

    it('redirects to the thank you page after a successful poll response', function () {
        $response = post("/p/{$this->poll->id}", [
            'answer_id' => $this->answer->id,
        ]);
        $response->assertRedirect("/p/{$this->poll->id}/thank-you");
    });

    it('stores the contact email with the poll response when provided', function () {
        $email = 'test@example.com';
        $response = post("/p/{$this->poll->id}", [
            'answer_id' => $this->answer->id,
            'contact_email' => $email,
        ]);
        $response->assertStatus(302)->assertSessionHasNoErrors();
        $pollResponse = $this->poll->responses()->first();
        expect($pollResponse)->not->toBeNull();
        expect($pollResponse->contact_email)->toBe($email);
    });

    it('rejects an invalid contact email and does not store the response', function () {
        $invalidEmail = 'not-an-email';
        $response = post("/p/{$this->poll->id}", [
            'answer_id' => $this->answer->id,
            'contact_email' => $invalidEmail,
        ]);
        $response->assertSessionHasErrors(['contact_email']);
        expect($this->poll->responses()->count())->toBe(0);
    });
});
