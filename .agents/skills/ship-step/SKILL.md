---
name: ship-step
description: Review gate before opening or updating a step's pull request in this fork. Use at the end of every step.
---

# Ship a step

Before the PR goes up:

1. `vendor/bin/pest` is green. Paste the count into the PR.
2. The front end builds.
3. `composer audit` result is in the PR, before and after.
4. Read your own diff top to bottom. Remove debug code, stray files and comments that restate code.
5. Every changed test has a reason in the PR description.

The PR description has:

- **What changed**, in a few bullets
- **Why**, when it isn't obvious
- **Tests**: count before → after
- **Time**: start and finish, and the hours of human attention it took
- **Left for later**, if anything

Open it against this fork's branches, never against jcc/blog.
