<?php

use App\Models\Answer;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Poll creation', function () {
    beforeEach(function () {
        /** @var User */
        $this->user = User::factory()->create();
        actingAs($this->user);
    });

    it('allows an authenticated user to view the poll creation form', function () {
        get('/polls/create')->assertOk();
    });

    it('requires a poll name to be provided', function () {
        Volt::test('polls.create')
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    });

    it('requires a poll question to be provided', function () {
        Volt::test('polls.create')
            ->set('name', 'Test Poll')
            ->set('question', '')
            ->call('save')
            ->assertHasErrors(['question' => 'required']);
    });

    it('requires at least one answer option', function () {
        Volt::test('polls.create')
            ->set('name', 'Test Poll')
            ->set('question', 'Test Question')
            ->set('answers', [])
            ->call('save')
            ->assertHasErrors(['answers' => 'min']);
    });

    it('requires all answer options to be non-empty', function () {
        Volt::test('polls.create')
            ->set('name', 'Test Poll')
            ->set('question', 'Test Question')
            ->set('answers', ['Yes', ''])
            ->call('save')
            ->assertHasErrors(['answers.1' => 'required']);
    });

    it('creates a poll when all fields are valid', function () {
        $name = 'Poll with Answers';
        $question = 'What is your favorite option?';
        $answers = ['Yes', 'No', 'Maybe'];

        Volt::test('polls.create')
            ->set('name', $name)
            ->set('question', $question)
            ->set('answers', $answers)
            ->call('save')
            ->assertOk();

        $poll = Poll::with('answers')->first();

        expect($poll)
            ->not->toBeNull()
            ->and($poll->name)->toBe($name)
            ->and($poll->question)->toBe($question)
            ->and($poll->answers)->toHaveCount(count($answers));
        foreach ($answers as $answer) {
            expect($poll->answers->pluck('text'))->toContain($answer);
        }
    });
});

describe('Public Poll Route', function () {
    describe('Poll Response Submission', function () {
        beforeEach(function () {
            $this->poll = Poll::factory()
                ->has(Answer::factory()->count(3))
                ->create();
            $this->answer = $this->poll->answers->first();
        });

        it('stores a response when a guest submits a valid answer', function () {
            Volt::test('polls.vote', ['poll' => $this->poll])
                ->assertDontSee('thank-you-message')
                ->set('answer_id', $this->answer->id)
                ->call('submit')
                ->assertHasNoErrors();
            expect($this->poll->responses()->first()->exists())
                ->toBeTrue();
        });

        it('displays the thank you message after a successful poll response', function () {
            Volt::test('polls.vote', ['poll' => $this->poll])
                ->set('answer_id', $this->answer->id)
                ->call('submit')
                ->assertSee('thank-you-message');
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

    beforeEach(function () {
        $this->poll = Poll::factory()->create();
    });

    it('allows guests to view a public poll', function () {
        $response = get("/p/{$this->poll->id}");
        $response->assertOk();
    });
});
