# Copilot Instructions for AI Agents

## Project Overview
This is a Laravel-based polling application with Livewire integration. The codebase is organized using standard Laravel conventions, with some custom patterns for poll management and user responses.

## Architecture & Key Components
- **app/Models/**: Eloquent models for `Poll`, `Answer`, `Response`, and `User`.
- **app/Http/Controllers/**: Handles HTTP requests. Poll and response logic is managed here.
- **app/Livewire/**: Contains Livewire components and actions for interactive UI features.
- **resources/views/**: Blade templates. Use named routes (see `routes/web.php`) for all form actions and links.
- **routes/web.php**: Main route definitions. Public poll routes use names like `polls.public.show` and `polls.public.store`.
- **database/migrations/**, **factories/**, **seeders/**: Standard Laravel database setup.

## Developer Workflows
- **Run the app**: `php artisan serve` (or use Laravel Valet/Sail as preferred)
- **Run tests**: `./vendor/bin/pest` (Pest is used for testing; see `tests/` for examples)
- **Migrate DB**: `php artisan migrate`
- **Seed DB**: `php artisan db:seed`
- **Build assets**: `npm run build` (uses Vite)

## Project-Specific Conventions
- Always use named routes in Blade templates for form actions and links (e.g., `route('polls.public.store', $poll->id)`).
- Use Livewire for interactive UI where possible; see `app/Livewire/` and `resources/views/livewire/`.
- Follow Laravel's service provider pattern for app-wide configuration (`app/Providers/`).
- Use Pest for all new tests; see `tests/Feature/` and `tests/Unit/` for structure.

## Integration Points
- **Livewire**: Used for dynamic frontend features. Components are registered in `app/Livewire/`.
- **Vite**: Asset bundling via `vite.config.js` and `resources/`.
- **Authentication**: Standard Laravel auth, see `routes/auth.php` and `config/auth.php`.

## Examples
- To add a new poll, create a model in `app/Models/`, a controller in `app/Http/Controllers/`, and Blade/Livewire views in `resources/views/polls/` or `resources/views/livewire/`.
- For new routes, always assign a name and use that name in all references.

## References
- Key files: `routes/web.php`, `app/Models/Poll.php`, `app/Http/Controllers/`, `resources/views/polls/`, `app/Livewire/`
- For more, see Laravel and Livewire documentation.
