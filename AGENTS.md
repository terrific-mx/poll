# AGENTS.md

## Build, Lint, and Test Commands
- **Frontend build:** `npm run build`
- **Frontend dev server:** `npm run dev`
- **Backend server:** `php artisan serve`
- **Run all tests:** `./vendor/bin/pest`
- **Run a single test:** `./vendor/bin/pest tests/Feature/YourTest.php` (or any test file)
- **Database migrations:** `php artisan migrate`
- **Seed database:** `php artisan db:seed`
- **Lint PHP:** `vendor/bin/pint`
- **Install dependencies:** `composer install` and `npm install`

## Code Style Guidelines
- **Imports:** Use ES module syntax for JS; Composer autoload (PSR-4) for PHP.
- **Formatting:** Use Prettier for JS and Pint/PSR-12 for PHP.
- **Types:** Use PHP type hints and strict validation in Livewire components.
- **Naming:** Prefer descriptive, feature-oriented names for files, classes, and components.
- **Styling:** Use TailwindCSS utility classes in Blade and JS.
- **Error Handling:** Validate all inputs in Livewire; use Laravel validation rules.
- **JS/CSS:** Keep assets modular in `resources/js/` and `resources/css/`.
- **Volt Components:** Use anonymous classes extending `Livewire\Volt\Component`.
- **URL-bound properties:** Use `#[Url('param')]` for Livewire query params.
- **Testing:** Use Pest for all PHP tests; feature tests simulate user flows, unit tests cover model logic.
- **External dependencies:** Managed via Composer (PHP) and npm (JS/CSS).
- **Directory structure:** See this file for key folders and files.
- **If unclear:** Ask for clarification or check this file.
