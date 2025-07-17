<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Poll;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('Poll Creation via Volt', function () {
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
