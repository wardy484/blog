# AGENTS.md

This fork upgrades PJ Blog (jcc/blog) from Laravel 9 and Vue 2 to current versions, in public.
Each step is one pull request with the tests green. Agents do the typing. A human reviews every PR.

## The steps

1. Test baseline: Pest feature tests for the main routes, with coverage.
2. Laravel 9 → 10 → 11 → 12 → 13, one major version per PR. PHP 8.4 at the end.
3. Laravel Mix → Vite.
4. Vue 2 → Vue 3, one component at a time.
5. One browser test of the main flow.

## Rules

1. **Tests first, then change.** Run the suite before you touch anything, so you know what green looks like.
   Never weaken or delete a test to get green. If a test was wrong, say why in the PR.
2. **One concern per PR.** An upgrade PR upgrades. Fixes it needs go in the same PR.
   Anything else goes in a note for a later PR.
3. **Smallest change that works.** Follow the official upgrade guide.
   Don't restructure the app to the new skeleton unless the upgrade needs it.
4. **Replace dead packages, don't fork them.** If a package blocks an upgrade and is unmaintained,
   move the few lines the app uses into `app/` and delete the package.
5. **Find the cause.** No retries, sleeps or guards to hide a failure.
6. **Record the time.** Note start and finish for each step in the PR description.
7. **No secrets in git.** `.env` and the Passport keys stay local.

## Running things

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan passport:keys
yarn install && yarn build  # Vite assets, needed by the browser test
npx playwright install chromium

vendor/bin/pest                       # everything, SQLite in memory
vendor/bin/pest --testsuite=Feature   # skip the browser
vendor/bin/pest --coverage            # needs pcov or xdebug
```

CI runs all of it in `.github/workflows/tests.yml`.

## Skills

| Skill | Use it for |
|---|---|
| `upgrade-laravel` | One Laravel major version |
| `migrate-vue-component` | Moving one Vue 2 component to Vue 3 |
| `ship-step` | The review gate before a step's PR goes up |
