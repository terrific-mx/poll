# Copilot Instructions for AI Agents

## Project Overview
- This is a Laravel-based polling application with Livewire Volt for interactive UI components.
- Main entities: `Poll`, `Answer`, `Response`, and `User` (see `app/Models/`).
- Polls have many answers; users submit responses to polls by selecting answers.
- Volt components (see `resources/views/livewire/` and `routes/web.php`) handle poll creation, voting, updating, and deletion.

## Key Directories & Files
- `app/Models/`: Eloquent models for core entities.
- `database/migrations/`: Table definitions for polls, answers, responses, users.
- `database/factories/`: Model factories for tests and seeding.
- `resources/views/`: Blade templates and Livewire Volt UIs.
- `routes/web.php`: Main HTTP routes, including Volt endpoints.
- `tests/Feature/PollTest.php`: Pest feature tests for poll workflows.

## Developer Workflows
- **Development server:** `composer run dev` (see VS Code task)
- **Run tests:** `./vendor/bin/pest` (Pest is used for testing)
- **Database:** Uses SQLite by default (`database/database.sqlite`).
- **Seeding:** Use factories in `database/factories/` for test data.

## Project-Specific Patterns
- **Volt Testing:** Use `Volt::test()` for Livewire Volt component tests (see `PollTest.php`).
- **Poll Creation/Update:** Always require at least two answers; validate `name` and `question` fields.
- **Authentication:** Some routes require authentication (see `tests/Feature/PollTest.php`).
- **Test conventions:** Use Pest's `it()` syntax; mark incomplete tests with `->todo()`.
- **Answer Text:** In tests, answers are set via `set('answers', [[...], ...])` with `text` keys.

## Integration Points
- **Livewire Volt:** Used for interactive poll management (creation, voting, updating, deleting).
- **Blade Views:** UI is rendered via Blade and Livewire Volt components.
- **External dependencies:** See `composer.json` and `package.json` for PHP and JS dependencies.

## Examples
- Creating a poll in tests:
  ```php
  Volt::test('polls.create')
      ->set('name', 'Test Poll')
      ->set('question', 'Question?')
      ->set('answers', [['text' => 'A'], ['text' => 'B']])
      ->call('save');
  ```
- Updating a poll:
  ```php
  Volt::test('polls.update', ['poll' => $poll])
      ->set('name', 'New name')
      ->set('answers', [['text' => 'A'], ['text' => 'B'], ['text' => 'C']])
      ->call('update');
  ```

## Conventions
- Use Pest for all tests; follow the structure in `tests/Feature/PollTest.php`.
- Use model factories for test data.
- Use Volt for all interactive UI logic.
- Keep at least two answers for every poll.

---
If any section is unclear or missing, please provide feedback for further refinement.
