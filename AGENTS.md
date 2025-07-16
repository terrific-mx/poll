# AGENTS.md

## Build, Lint, and Test Commands
- **Build frontend:** `npm run build`
- **Dev frontend:** `npm run dev`
- **Run backend:** `php artisan serve`
- **Run all tests:** `./vendor/bin/pest`
- **Run a single test:** `./vendor/bin/pest tests/Feature/YourTest.php` (or specify any test file)
- **Database migrations:** `php artisan migrate`
- **Seed database:** `php artisan db:seed`

## Code Style Guidelines
- **Imports:** Use ES module syntax for JS; Composer autoload for PHP.
- **Formatting:** Follow default Prettier (JS) and PSR-12 (PHP) styles.
- **Types:** Use PHP type hints and strict validation in Livewire components.
- **Naming:** Descriptive, feature-oriented names for files, classes, and components.
- **Styling:** Use TailwindCSS utility classes in Blade and JS.
- **Error Handling:** Validate all inputs in Livewire; use Laravel validation rules.
- **JS/CSS:** Keep assets modular in `resources/js/` and `resources/css/`.
- **Volt Components:** Use anonymous classes extending `Livewire\\Volt\\Component`.
- **URL-bound properties:** Use `#[Url('param')]` for Livewire query params.
- **Testing:** Use Pest for all PHP tests; feature tests simulate user flows, unit tests cover model logic.

## Additional Conventions
- **External dependencies:** Managed via Composer (PHP) and npm (JS/CSS).
- **Directory structure:** See Copilot instructions for key folders and files.
- **If unclear:** Ask for clarification or check Copilot instructions.
