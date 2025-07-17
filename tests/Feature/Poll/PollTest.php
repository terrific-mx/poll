<?php

use App\Models\User;
use App\Models\Poll;
use App\Models\Answer;
use App\Models\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Poll Creation', function () {
    it('does not allow poll creation when the name is missing', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('polls.create')
            ->set('name', '')
            ->set('question', 'What is your favorite color?')
            ->set('answers', ['Red', 'Blue'])
            ->call('submit')
            ->assertHasErrors(['name' => 'required']);
    });

    it('does not allow poll creation when the question is missing', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('polls.create')
            ->set('name', 'Color Poll')
            ->set('question', '')
            ->set('answers', ['Red', 'Blue'])
            ->call('submit')
            ->assertHasErrors(['question' => 'required']);
    });

    it('does not allow poll creation when answers are missing', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('polls.create')
            ->set('name', 'Color Poll')
            ->set('question', 'What is your favorite color?')
            ->set('answers', [])
            ->call('submit')
            ->assertHasErrors(['answers' => 'required']);
    });

    it('does not allow poll creation with less than two answers', function () {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('polls.create')
            ->set('name', 'Color Poll')
            ->set('question', 'What is your favorite color?')
            ->set('answers', ['Red'])
            ->call('submit')
            ->assertHasErrors(['answers' => 'min']);
    });

    it('creates a poll when all required fields are provided', function () {
        $user = User::factory()->create();

        $name = 'Color Poll';
        $question = 'What is your favorite color?';
        $answers = ['Red', 'Blue'];

        Volt::actingAs($user)
            ->test('polls.create')
            ->set('name', $name)
            ->set('question', $question)
            ->set('answers', $answers)
            ->call('submit')
            ->assertHasNoErrors();

        $poll = Poll::first();
        expect($poll)->not->toBeNull();
        expect($poll->name)->toBe($name);
        expect($poll->question)->toBe($question);
        expect($poll->answers()->pluck('text')->toArray())
            ->toEqualCanonicalizing($answers);
    });

    it('shows the create poll page to a logged-in user', function () {
        /** @var User $user */
        $user = User::factory()->create();

        actingAs($user)
            ->get('/polls/create')
            ->assertOk();
    });

    it('can add answers dynamically', function () {
        $user = User::factory()->create();

        $component = Volt::actingAs($user)
            ->test('polls.create')
            ->set('answers', ['Red', 'Blue']);

        $component->call('addAnswer');
        $answers = $component->get('answers');
        expect($answers)->toHaveCount(3);
        expect($answers[2])->toBe('');
    });

    it('can remove answers dynamically (but not below two)', function () {
        $user = User::factory()->create();

        $component = Volt::actingAs($user)
            ->test('polls.create')
            ->set('answers', ['Red', 'Blue', 'Green']);

        $component->call('removeAnswer', 2);
        $answers = $component->get('answers');
        expect($answers)->toEqual(['Red', 'Blue']);

        $component->call('removeAnswer', 1);
        $answers = $component->get('answers');
        expect($answers)->toEqual(['Red', 'Blue']);
    });
});

describe('Poll Editing', function () {
    it('fails to edit a poll with missing name', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', '')
            ->set('question', 'Updated Question')
            ->call('submit')
            ->assertHasErrors(['name' => 'required']);
    });

    it('fails to edit a poll with missing question', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', 'Updated Name')
            ->set('question', '')
            ->call('submit')
            ->assertHasErrors(['question' => 'required']);
    });

    it('successfully edits a poll when all required fields are provided', function () {
        $poll = Poll::factory()
            ->withAnswers(['Red', 'Blue'])
            ->create([
                'name' => 'Original Name',
                'question' => 'Original Question',
            ]);

        $newName = 'Updated Name';
        $newQuestion = 'Updated Question';

        Volt::test('polls.edit', ['poll' => $poll])
            ->set('name', $newName)
            ->set('question', $newQuestion)
            ->call('submit')
            ->assertHasNoErrors();

        $poll->refresh();
        expect($poll->name)->toBe($newName);
        expect($poll->question)->toBe($newQuestion);
    });
});

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

    it('shows a thank you message after submitting a response', function () {
        $poll = Poll::factory()->create();
        $answer = Answer::factory()->for($poll)->create();
        $email = 'thankyou@example.com';

        $component = Volt::test('poll.respond', ['poll' => $poll])
            ->set('answer_id', $answer->id)
            ->set('contact_email', $email)
            ->call('submit');

        expect($component->get('showThankYou'))->toBeTrue();
    });
})
;
