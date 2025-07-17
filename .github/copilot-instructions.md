# Copilot Instructions for Terrific Poll

## Project Overview

- **Architecture:** Laravel backend (app/, routes/, database/) with Livewire Volt components for interactive UI. Frontend assets in `resources/`.
- **Major Components:**
  - **Polls, Answers, Responses:** Core models in `app/Models/`
  - **Controllers:** HTTP logic in `app/Http/Controllers/`
  - **Livewire Volt:** Interactive components in `app/Livewire/`
  - **Views:** Blade templates in `resources/views/`
  - **Testing:** Pest-based tests in `tests/Feature/` and `tests/Unit/`

## Developer Workflows

- **Install dependencies:**
  `composer install` (PHP), `npm install` (JS/CSS)
- **Build frontend:**
  `npm run build`
- **Run frontend dev server:**
  `npm run dev`
- **Run backend server:**
  `php artisan serve`
- **Run all tests:**
  `./vendor/bin/pest`
- **Run a single test:**
  `./vendor/bin/pest tests/Feature/YourTest.php`
- **Database migrations:**
  `php artisan migrate`
- **Seed database:**
  `php artisan db:seed`
- **Lint PHP:**
  `vendor/bin/pint`

## Code Patterns & Conventions

- **Volt Components:**
  Use anonymous classes extending `Livewire\Volt\Component`.
  Use `#[Url('param')]` for query-bound properties.
- **Validation:**
  Always validate inputs in Livewire using Laravel validation rules.
- **Testing:**
  Use Pest for feature tests (simulate user flows) and unit tests (model logic).
- **Naming:**
  Prefer descriptive, feature-oriented names for files, classes, and components.
- **Styling:**
  Use TailwindCSS utility classes in Blade and JS.
- **Assets:**
  Keep JS/CSS modular in `resources/js/` and `resources/css/`.
- **Imports:**
  Use ES module syntax for JS; Composer autoload (PSR-4) for PHP.

## Integration Points

- **External dependencies:**
  Managed via Composer (PHP) and npm (JS/CSS).
- **Database:**
  SQLite by default (`database/database.sqlite`), migrations in `database/migrations/`.

## Key Files & Directories

- `app/Models/` — Poll, Answer, Response, User models
- `app/Livewire/` — Volt components and actions
- `resources/views/` — Blade templates
- `routes/web.php` — Main web routes
- `tests/Feature/` — Feature tests (see `PollResponseTest.php` for user flow examples)
- `artisan` — Laravel CLI

## If Unclear

- Check `AGENTS.md` for workflow details.
- Ask for clarification or reference this file.
