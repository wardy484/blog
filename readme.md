# Upgraded in public

**Laravel 9 → 13, PHP 8.4, Mix → Vite, Vue 2 → 3 in one evening.** Each step is a separate pull request with tests passing. [See the pull requests](https://github.com/wardy484/blog/pulls?q=is%3Apr). I use AI coding agents for the typing, with review gates and tests at every step. I do the same for agencies' client sites, white-label, at a fixed price per codebase.

| Step | Pull request | Agent time |
|---|---|---|
| 1 | [Test baseline, agent rules and CI](https://github.com/wardy484/blog/pull/1) | 8 min |
| 2 | [Laravel 10](https://github.com/wardy484/blog/pull/2) | 3 min |
| 3 | [Laravel 11](https://github.com/wardy484/blog/pull/4) | 1 min |
| 4 | [Laravel 12](https://github.com/wardy484/blog/pull/5) | 1 min |
| 5 | [Laravel 13 and PHP 8.4](https://github.com/wardy484/blog/pull/6) | 6 min |
| 6 | [Mix to Vite](https://github.com/wardy484/blog/pull/7) | 13 min |
| 7 | [Vue 2 to Vue 3](https://github.com/wardy484/blog/pull/8) | 18 min |
| 8 | [Browser test of the main flow](https://github.com/wardy484/blog/pull/9) | 5 min |

Agent time is wall-clock time from my log on 18 November 2026, from 21:48 to 22:50 including setup. It doesn't include my review of each pull request.

## Before and after

| | Before | After |
|---|---|---|
| Tests | 6, of which 1 passed | 43, all passing, including one in a real browser |
| Line coverage of `app/`, feature tests | 3.8% | 47.4% |
| `composer audit` | 69 advisories in 19 packages | 0 |

Some packages were abandoned or had no release for the new versions:

- `jcc/laravel-vote` became about 100 lines in `app/`
- `jcc/translug` was deleted. Its code path could never run.
- `fideloper/proxy` was deleted. The framework already does its job.
- `fzaninotto/faker` became `fakerphp/faker`
- `vue-datepicker` became the browser's own date and time input
- `v-textcomplete` moved into the app as a Vue 3 component

## How the agents work here

The rules are in [AGENTS.md](AGENTS.md), with three skills in [.agents/skills](.agents/skills): one for a Laravel major version, one for moving a Vue component, and one for the checks before a pull request goes up. Tests come first. Every step gets its own pull request, and a pull request only goes up with its tests green.

---

<p align="center">
<a href="https://pigjian.com/">
<img src="https://pigjian.com/uploads/Logo.png" alt="Powered By Jiajian Chan" width="160">
</a>
</p>

<p align="center">🎈 PJ Blog is an open source blog built with Laravel and Vue.js. <a href="https://pigjian.com">https://pigjian.com</a></p>

<p align="center">
  <b>Special thanks to the generous sponsorship by:</b>
  <br><br>
  <a href="https://www.upyun.com">
    <img src="https://pigjian.com/storage/logo/upyun.png" width=300>
  </a>
</p>

# PJ Blog

This is a powerful blog, I try to build the blog more beautiful, more convenient. 

`Laravel 5.*` and `Vuejs 2.*` combined with the establishment of a good response and quickly dashboard, the dashboard made through the `Vuejs` component development.

I believe it will be better and better. If you are interested in this, you can join and enjoy it.

Here is [documents](https://manual.pigjian.com/)

[Example](http://example.pigjian.com)

## Basic Features

- Manage users, articles, discussions and media
- Statistical tables
- Categorize articles
- Label classification
- Content moderation
- Own comments system
- Multi-language switching
- Markdown Editor
- Roles & Permissions
- and more...

[PJ Blog](https://github.com/jcc/blog) Laravel 7.*

## Server Requirements

- PHP >= 7.2.5
- Node >= 6.x
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Preview

![New Blog](https://cdn.pigjian.com/cover/2018/09/07/d2T4cAjTagf5L1rXH1FjLsFkJVffsPIGPkHEl2A5.jpg)

![New Blog](https://cdn.pigjian.com/cover/2018/09/07/4b7ExtB6NHZVh8n5KnW2673Ej6gwtLm1SUAubtpa.jpg)

## Install

### 1. Clone the source code or create new project.

```shell
git clone https://github.com/jcc/blog.git
```

OR

```shell
composer create-project jcc/blog
```

### 2. Set the basic config

```shell
cp .env.example .env
```

Edit the `.env` file and set the `database` and other config for the system after you copy the `.env`.example file.

### 2. Install the extended package dependency.

Install the `Laravel` extended repositories: 

```shell
composer install -vvv
```

Install the `Vuejs` extended repositories: 

```shel
npm install
```

Compile the js code: 

```shel
npm run dev

// OR

npm run watch

// OR

npm run production
```

### 3. Run the blog install command, the command will run the `migrate` command and generate test data.

```shell
php artisan blog:install
```

## Contributors

- [Jiajian Chan](http://github.com/jcc)

## Thanks

- [overtrue](https://github.com/overtrue)
- [Laravist](https://www.laravist.com/)
- [Laravel - China](https://laravel-china.org/)

## Donate

Support all ERC20 tokens. My Address:
**0x600dfF1311E5DA3a8697fD86d4Fd9bed257395eb**

## License

The project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

QQ Group: 272734386
