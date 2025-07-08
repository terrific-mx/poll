# AGENTS.md

## Build, Lint, and Test Commands
- **Install dependencies:** `composer install` and `npm install`
- **Build assets:** `npm run build`
- **Dev server:** `npm run dev` or `php artisan serve`
- **Lint PHP:** `vendor/bin/pint`
- **Lint JS/CSS:** Use your editor with .editorconfig
- **Run all tests:** `./vendor/bin/pest` or `php artisan test`
- **Run a single test:** `./vendor/bin/pest --filter=TestName` or `php artisan test --filter=TestName`

## Code Style Guidelines
- **Formatting:** 4 spaces, LF endings, trim trailing whitespace (see .editorconfig)
- **Imports:** Use PSR-4 autoloading, group by vendor then app
- **Naming:** Classes StudlyCase, methods camelCase, constants UPPER_SNAKE_CASE
- **Types:** Use PHP 8+ type hints and return types
- **Error Handling:** Use exceptions, avoid silent failures
- **Blade:** Use `.blade.php` for views, follow Laravel conventions
- **JS/CSS:** Use ES modules, Tailwind for styles
- **Git:** Respect .gitattributes and .gitignore

## Notes
- No Cursor or Copilot rules found.
- Keep code clean, readable, and consistent with Laravel/Livewire best practices.
