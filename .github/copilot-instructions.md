<!--
This file guides AI coding agents (Copilot-style) working on this repository.
Keep it concise and actionable — reference exact files/commands and observable patterns.
-->

# Copilot instructions for davomat-2 (Laravel)

Purpose: help code-assistants be productive immediately in this Laravel application.

- Quick commands
  - Setup (one-liner): `composer run setup` — installs dependencies, copies `.env`, runs migrations, builds frontend.
  - Dev (local): `composer run dev` (spawns `php artisan serve`, `php artisan queue:listen`, `php artisan pail`, and `npm run dev` via `concurrently`).
  - Build frontend: `npm run build` (uses Vite).
  - Run tests: `composer run test` (runs `@php artisan test`, Pest is configured).
  - Code style: `vendor/bin/pint` (Project includes `laravel/pint`).

- Project overview (big picture)
  - Framework: Laravel (project skeleton in `composer.json`), PHP 8.2, Laravel 12.
  - Frontend: Vite + Tailwind; JS entrypoints in `resources/js/` and styles in `resources/css/`.
  - Web routes: route definitions live in `routes/web.php`. Routes use middleware `auth` for dashboards.
  - MVC layout: controllers in `app/Http/Controllers`, models in `app/Models`, views in `resources/views` (subfolders: `admin`, `auth`, `parent`, `student`).
  - Background & logging: uses Laravel queue (`php artisan queue:listen`) and `laravel/pail` for streaming logs in dev.

- Important files & examples
  - `routes/web.php` — canonical route names (e.g., `admin.dashboard`, `student.dashboard`). Use named routes when adding links.
  - `app/Models/User.php` — `role` enum is used extensively; helper methods exist: `isStudent()`, `isAdmin()`, `isSuperAdmin()`, `isParent()`.
  - `database/migrations/0001_01_01_000000_create_users_table.php` — defines `role` enum (`student`, `admin`, `super_admin`, `parent`). Use these strings for role checks.
  - `database/migrations/2025_11_20_105441_create_students_table.php` — `students` table fields; note column name `fullaname` (typo preserved in schema).
  - Controllers present: `AuthController`, `HomeController`, `StudentController`, `AdminController` (see `app/Http/Controllers`). Follow patterns in these files when adding new routes/controllers.

- Project-specific conventions & patterns
  - Roles: `role` string values are the canonical source of truth (use `User` helpers instead of ad-hoc string checks when possible).
  - Route naming: routes use human-readable names with dots (e.g., `admin.create.student.post`). Reuse existing naming pattern for consistency.
  - Views folder mapping: controller actions render views under `resources/views/<role>/...` (e.g., `student`, `admin`). Keep view files organized by role.
  - Tests: Pest + Laravel test harness. Tests run against in-memory sqlite (see `phpunit.xml`), so use factories and transactions for speed.
  - Localization: source code contains Uzbek comments/strings — be careful when changing user-facing text; consult `resources/views` files for exact phrasing.

- Integrations & external tools
  - Vite: build/watch front-end assets (`npm run dev` / `npm run build`). The `vite.config.js` and `resources/js/bootstrap.js` are the entry points.
  - Queue: background jobs expected; local dev runs `php artisan queue:listen` in `composer run dev`. Use `QUEUE_CONNECTION=sync` in tests.
  - Logging: `laravel/pail` is configured for log streaming in development scripts.

- What to prefer when making changes
  - Update migrations/models together: if you add a DB column, add a migration and update the Eloquent model's `$fillable`/casts.
  - Use named routes: prefer `route('name')` in blade templates and controllers.
  - Keep role checks centralized: prefer `User` model helpers.
  - Preserve existing column names: e.g., `fullaname` is used in migration — changing it requires a migration and view/controller updates.

- Example snippets (copyable patterns)
  - Registering a new GET route behind auth middleware:
    ```php
    Route::middleware('auth')->get('/new-route', [SomeController::class, 'index'])->name('some.name');
    ```
  - Checking user role in controller:
    ```php
    if ($request->user()->isAdmin()) {
        // admin flow
    }
    ```

- CI / testing notes
  - Tests run with `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:` in `phpunit.xml` — tests should not require a physical DB file.
  - Use `php artisan migrate --seed` only for local manual testing; CI and `composer run test` use the in-memory setup.

If anything here is unclear or you want additional examples (view snippets, controller patterns, or a sample test), tell me which area to expand. I can iterate on this file.
