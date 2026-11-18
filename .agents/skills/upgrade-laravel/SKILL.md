---
name: upgrade-laravel
description: Upgrade this app by exactly one Laravel major version in one PR. Use for each 9→10, 10→11, 11→12, 12→13 step.
---

# Upgrade Laravel by one major version

1. **Baseline.** Run `vendor/bin/pest`. Write down the test count. It must be green before you start.
2. **Read the guide.** Open the official upgrade guide for the target version.
   List only the items that touch this app. Search the code for each one.
3. **Bump constraints.** In `composer.json`, move `laravel/framework` and every first-party package
   (Passport, Socialite, Tinker, UI) to the versions the target needs. Then the third-party packages.
4. **Resolve.** Run `composer update -W`. If a package has no release for the target version:
   - maintained: bump it
   - abandoned and small: move what the app uses into `app/` and remove it
   - abandoned and large: stop and ask
5. **Apply the guide.** Make each code change from your list. Keep the old skeleton
   unless the new version requires the new one.
6. **Run everything.** `vendor/bin/pest`, then `composer audit`. Fix failures at the cause.
7. **Ship.** Use the `ship-step` skill.

The PR description lists every guide item you applied, every package you bumped or removed,
and anything you chose to leave for later.
