# AGENTS.md

## Build, Lint, and Test Commands

- **Install dependencies:**  
  `composer install` and `npm install`
- **Build assets:**  
  `npm run build`
- **Start dev servers:**  
  `composer run dev` (runs PHP, queue, logs, and Vite concurrently)
- **Lint PHP:**  
  `vendor/bin/pint`
- **Run all tests:**  
  `./vendor/bin/pest` or `composer test`
- **Run a single test:**  
  `./vendor/bin/pest path/to/TestFile.php`
- **Lint JS/CSS:**  
  Use Prettier or your editor; see .editorconfig

## Code Style Guidelines

- **PHP:** PSR-12, 4 spaces, LF endings, trailing newline, no trailing whitespace (see .editorconfig)
- **JS/CSS:** 4 spaces, LF endings, trailing newline
- **Imports:** Use PSR-4 autoloading for PHP; group imports by vendor, then app
- **Naming:**  
  - Classes: `StudlyCase`  
  - Methods/variables: `camelCase`  
  - Constants: `UPPER_SNAKE_CASE`
- **Types:**  
  - PHP: Use type hints and return types where possible  
  - JS: Prefer explicit types if using TypeScript
- **Error Handling:**  
  - Use exceptions for error states  
  - Validate input and fail fast
- **Formatting:**  
  - Use `vendor/bin/pint` for PHP auto-formatting  
  - Use Prettier or editor for JS/CSS
- **Tests:**  
  - Use Pest for tests (`tests/Feature`, `tests/Unit`)  
  - Add custom expectations in `tests/Pest.php`
- **Env:**  
  - Copy `.env.example` to `.env` and fill secrets before running locally
