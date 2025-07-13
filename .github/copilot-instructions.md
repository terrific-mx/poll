
# Copilot Instructions for AI Agents

## Project Overview
This is a Laravel polling application using Livewire Volt for dynamic UI, Pest for testing, and Vite/Tailwind for assets. The codebase follows Laravel conventions but introduces custom patterns for poll management, user responses, and interactive settings.

## Architecture & Key Components
- **app/Models/**: Eloquent models for `Poll`, `Answer`, `Response`, and `User`. Relationships are explicit (e.g., `Poll` has many `Answer`/`Response`).
- **app/Livewire/**: Livewire Volt components and actions (e.g., `Actions/Logout.php`). Most UI logic is in Volt classes within Blade files under `resources/views/livewire/`.
- **resources/views/livewire/**: Volt/Blade files for all interactive pages (polls, auth, dashboard, settings). Volt classes are defined at the top of these files.
- **resources/views/polls/**: Public poll display (non-Livewire, uses named routes for form actions).
- **routes/web.php** and **routes/auth.php**: All routes use Volt's `Volt::route` and are named. Settings and dashboard are protected by `auth`/`verified` middleware.
- **app/Providers/VoltServiceProvider.php**: Registers Volt view paths.
- **database/**: Standard Laravel migrations, factories, and seeders for all models.

## Developer Workflows
- **Run app**: `php artisan serve` (or use Valet/Sail)
- **Run tests**: `./vendor/bin/pest` (all tests in `tests/Feature/` and `tests/Unit/`)
- **Migrate DB**: `php artisan migrate`
- **Seed DB**: `php artisan db:seed`
- **Build assets**: `npm run build` (Vite, see `vite.config.js`)
- **Dev assets**: `npm run dev` (Vite hot reload)

## Project-Specific Conventions
- **Named routes**: Always use route names in Blade/Volt for links and form actions (e.g., `route('polls.vote', $poll)`).
- **Livewire Volt**: UI logic is in Volt classes at the top of Blade files in `resources/views/livewire/`. Use `wire:model` and `wire:submit` for interactivity.
- **Flux components**: Use `<flux:*>` UI components for all forms and buttons (see examples in `resources/views/livewire/`).
- **Settings**: User settings (profile, password, appearance, delete) are modular Volt components under `resources/views/livewire/settings/`.
- **Testing**: Use Pest for all new tests. Feature tests use `Volt::test()` for Livewire components.
- **Service Providers**: App-wide config in `app/Providers/`. VoltServiceProvider mounts Volt view paths.

## Integration Points
- **Livewire Volt**: All interactive pages/components (dashboard, polls, auth, settings) are Volt-based.
- **Vite/Tailwind**: Asset pipeline via `vite.config.js` and `tailwindcss`.
- **Authentication**: Standard Laravel auth, with custom Volt-based flows (see `resources/views/livewire/auth/`).
- **Flux UI**: Custom Blade components for UI (see `resources/views/flux/` and `resources/views/components/`).

## Examples & Patterns
- **Poll voting**: `resources/views/livewire/polls/vote.blade.php` (Volt class at top, `submit()` method, `wire:model` for answer selection, thank-you message logic)
- **Poll creation**: `resources/views/livewire/polls/create.blade.php` (dynamic answer fields, validation, save logic)
- **Settings**: `resources/views/livewire/settings/` (profile, password, appearance, delete-user)
- **Testing**: `tests/Feature/PollResponseTest.php` (uses `Volt::test()` for Livewire)

## References
- Key files: `routes/web.php`, `routes/auth.php`, `app/Models/`, `app/Livewire/`, `resources/views/livewire/`, `resources/views/polls/`, `vite.config.js`, `tests/Feature/`
- For more, see Laravel, Livewire, and Volt documentation.
