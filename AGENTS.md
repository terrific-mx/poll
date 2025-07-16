# AGENTS.md

## Build, Lint, and Test Commands
- **Development server:** `composer run dev` (or `npm run dev` for frontend assets)
- **Run all tests:** `./vendor/bin/pest`
- **Run a single test:** `./vendor/bin/pest --filter <TestName>`
- **Lint PHP:** `composer run lint` (if defined)
- **Lint JS/CSS:** `npm run lint` (if defined)

## Code Style Guidelines
- **Imports:** Use PSR-4 autoloading; import classes at the top of PHP files.
- **Formatting:** Follow PSR-12 for PHP; use Prettier/PSR-12 for JS/CSS if configured.
- **Types:** Use PHP type hints and return types where possible.
- **Naming:** Use StudlyCase for classes, camelCase for variables/methods, snake_case for database fields.
- **Error Handling:** Use exceptions for error states; validate input in controllers and Volt components.
- **Tests:** Use Pest with `it()` syntax; mark incomplete tests with `->todo()`; use model factories for test data.
- **Volt:** Use Volt for interactive UI logic; test with `Volt::test()`.
- **Polls:** Always require at least two answers per poll.
- **Auth:** Some routes require authentication; see `tests/Feature/PollTest.php` for examples.

Refer to `.github/copilot-instructions.md` for more project-specific patterns and examples.
