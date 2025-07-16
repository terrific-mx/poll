# Copilot Instructions for AI Agents

This codebase is a Laravel + Livewire backend with a Vite/TailwindCSS frontend. It is designed for rapid poll creation and response collection. Follow these guidelines to be productive as an AI agent:

## Architecture Overview
- **Backend:** Laravel app in `app/`, with models in `app/Models/`, controllers in `app/Http/Controllers/`, and Livewire components in `app/Livewire/`.
- **Frontend:** Vite-powered, assets in `resources/js/` and `resources/css/`. Blade views in `resources/views/`.
- **Livewire Volt:** Used for interactive components (see `resources/views/livewire/`).
- **Database:** SQLite by default (`database/database.sqlite`), migrations in `database/migrations/`, factories in `database/factories/`.

## Developer Workflows
- **Build frontend:** `npm run build`
- **Dev frontend:** `npm run dev`
- **Run backend:** `php artisan serve`
- **Run tests:** `./vendor/bin/pest` (Feature and Unit tests in `tests/`)
- **Database migrations:** `php artisan migrate`
- **Seed database:** `php artisan db:seed`

## Project-Specific Patterns
- **Volt Components:** Use anonymous classes extending `Livewire\Volt\Component` for interactive UI logic. Example: `respond.blade.php`.
- **URL-bound properties:** Use `#[Url('param')]` for Livewire properties bound to query params.
- **Poll Logic:** Polls and responses are managed via model methods (see `Poll.php`, `Answer.php`, `Response.php`).
- **Blade Views:** Organize by feature in `resources/views/`, with subfolders for components, flux, livewire, and partials.
- **Testing:** Feature tests simulate user flows; unit tests cover model logic. Use Pest for all tests.

## Conventions & Integration
- **Styling:** Use TailwindCSS utility classes in Blade and JS.
- **JS/CSS:** Keep assets modular in `resources/js/` and `resources/css/`.
- **Naming:** Use descriptive, feature-oriented names for files and classes.
- **Error Handling:** Validate inputs in Livewire components; use Laravel validation rules.
- **External Dependencies:** Managed via Composer (PHP) and npm (JS/CSS).

## Key Files & Directories
- `app/Models/` — Poll, Answer, Response, User models
- `resources/views/livewire/poll/respond.blade.php` — Example Volt component
- `tests/Feature/` and `tests/Unit/` — Pest tests
- `database/migrations/` — Schema definitions

## Example: Livewire Volt Component
```php
new class extends Component {
    public $poll;
    public $answer_id;
    #[Url('c')]
    public $contact_email;
    public function rules() {
        return [
            'answer_id' => 'required|exists:answers,id',
            'contact_email' => 'nullable|email',
        ];
    }
    public function submit() {
        $this->validate();
        $answer = Answer::findOrFail($this->answer_id);
        $this->poll->addResponse($answer, $this->contact_email);
    }
}
```

---
If any conventions or workflows are unclear, ask for clarification or check `AGENTS.md` for frontend-specific rules.
