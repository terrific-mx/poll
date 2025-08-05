# AGENTS.md

## Build, Lint, and Test

- Install dependencies: `composer install` & `npm install`
- Build assets: `npm run build`
- Start dev servers: `composer run dev`
- Lint PHP: `vendor/bin/pint`
- Lint JS/CSS: Use Prettier or your editor
- Run all tests: `./vendor/bin/pest` or `composer test`
- Run a single test: `./vendor/bin/pest path/to/TestFile.php`

## Code Style Guidelines

- **PHP:** PSR-12, 4 spaces, LF, trailing newline, no trailing whitespace
- **JS/CSS:** 4 spaces, LF, trailing newline
- **Imports:** PSR-4 for PHP; group by vendor, then app
- **Naming:** Classes: StudlyCase; methods/vars: camelCase; constants: UPPER_SNAKE_CASE
- **Types:** Use type hints and return types in PHP; prefer explicit types in TS
- **Error Handling:** Use exceptions; validate input and fail fast
- **Formatting:** Use `vendor/bin/pint` (PHP), Prettier/editor (JS/CSS)
- **Tests:** Use Pest (`tests/Feature`, `tests/Unit`); add custom expectations in `tests/Pest.php`
- **Env:** Copy `.env.example` to `.env` and fill secrets before running locally

*No Cursor or Copilot rules detected.*
