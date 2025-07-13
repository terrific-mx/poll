# AGENTS.md

## Build, Lint, and Test Commands
- **Run app:** `php artisan serve` (or use Valet/Sail)
- **Build assets:** `npm run build` (Vite)
- **Dev assets:** `npm run dev` (Vite hot reload)
- **Lint PHP:** `./vendor/bin/pint` (Laravel Pint)
- **Run all tests:** `./vendor/bin/pest`
- **Run a single test:** `./vendor/bin/pest tests/Feature/FILENAME.php` (or specify a test name)
- **Migrate DB:** `php artisan migrate`
- **Seed DB:** `php artisan db:seed`

## Code Style Guidelines
- **Imports:** Use PSR-4 autoloading; group imports by vendor, then app, then functions.
- **Formatting:** Use Laravel Pint defaults (PSR-12). Indent with 4 spaces, no trailing whitespace.
- **Types:** Use PHP 8+ type hints for all functions and properties.
- **Naming:** Classes: `StudlyCase`; methods/variables: `camelCase`; constants: `UPPER_SNAKE_CASE`.
- **Error Handling:** Use exceptions for error states; validate all user input in Volt/Livewire classes.
- **Routes:** Always use named routes in Blade/Volt (e.g., `route('polls.vote', $poll)`).
- **UI Logic:** Place in Volt classes at the top of Blade files in `resources/views/livewire/`.
- **Testing:** Use Pest for all new tests; feature tests use `Volt::test()` for Livewire components.
- **Components:** Use `<flux:*>` UI components for forms/buttons; settings are modular Volt components.

Refer to `.github/copilot-instructions.md` for more project-specific conventions.
