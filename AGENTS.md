# AGENTS.md

## Build, Lint, and Test

- Install dependencies: `composer install` & `npm install`
- Build assets: `npm run build`
- Start dev servers: `composer run dev`
- Lint PHP: `vendor/bin/pint`
- Lint JS/CSS: Use Prettier or your editor
- Run all tests: `./vendor/bin/pest` or `composer test`
- Run a single test: `./vendor/bin/pest path/to/TestFile.php`
- Filter tests: `php artisan test --filter=testName`
- Always run the minimal set of tests after changes

## Code Style Guidelines

- **PHP:** PSR-12, 4 spaces, LF, trailing newline, no trailing whitespace; use type hints and return types
- **JS/CSS:** 4 spaces, LF, trailing newline; use explicit types in TS
- **Imports:** PSR-4 for PHP; group by vendor, then app
- **Naming:** Classes: StudlyCase; methods/vars: camelCase; constants: UPPER_SNAKE_CASE
- **Error Handling:** Use exceptions; validate input and fail fast
- **Formatting:** Use `vendor/bin/pint` (PHP), Prettier/editor (JS/CSS)
- **Tests:** Use Pest (`tests/Feature`, `tests/Unit`); add custom expectations in `tests/Pest.php`
- **Env:** Copy `.env.example` to `.env` and fill secrets before running locally

## Framework & Tooling Conventions

- Use Laravel's built-in features (Artisan, Eloquent, Form Requests, Policies, Gates)
- Prefer Eloquent relationships and factories over raw queries
- Use Livewire, Volt, and Flux UI components as available; follow project conventions
- Use Tailwind v4 classes and patterns; support dark mode if present
- Every change must be programmatically tested; do not remove core tests

*No Cursor or Copilot rules detected.*
