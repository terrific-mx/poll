# AGENTS.md

This repository is a Vite-based frontend app using Laravel and TailwindCSS. There are no explicit linting, formatting, or test configurations in the root. Please follow these guidelines when contributing as an agent:

## Build & Dev Commands
- Build: `npm run build` (runs `vite build`)
- Dev server: `npm run dev` (runs `vite`)
- No test or lint commands are defined in package.json.

## Code Style Guidelines
- Use ES6+ module imports (`import ... from ...`).
- Prefer functional components and hooks if using React.
- Use consistent indentation (2 spaces recommended).
- Name files, variables, and functions descriptively (camelCase for JS, PascalCase for components).
- Use TypeScript types if present; otherwise, add JSDoc comments for type hints.
- Handle errors gracefully; avoid silent failures.
- Keep code DRY and modular.
- Organize CSS in `resources/css/`, JS in `resources/js/`.
- Follow TailwindCSS utility-first conventions for styling.
- Document public APIs and complex logic inline.
- No Cursor or Copilot rules are present.

If you add linting, formatting, or test tools, update this file accordingly.
