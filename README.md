# Lardefset

Sensible default settings for Laravel applications, applied automatically when the package is installed.

> **Requires [PHP 8.4+](https://php.net/releases/) and Laravel 12.8+ or 13**

## Installation

```bash
composer require grazulex/lardefset
```

The service provider is auto-discovered. Every default listed below is applied on boot; nothing else is needed.

## Defaults

| Configurable | Config key | What it does | Default |
| --- | --- | --- | --- |
| `AggressivePrefetching` | `aggressive_prefetching` | `Vite::useAggressivePrefetching()` — prefetches all Vite assets after page load. | enabled |
| `AutomaticallyEagerLoadRelationships` | `automatic_eager_loading` | `Model::automaticallyEagerLoadRelationships()` — eager loads relationships on demand to avoid N+1 queries. | enabled |
| `FakeSleep` | `fake_sleep` | `Sleep::fake()` — `Sleep` calls return immediately. **Only when running unit tests.** | enabled |
| `ForceScheme` | `force_https` | `URL::forceHttps()` — every generated URL uses `https`. | enabled |
| `ImmutableDates` | `immutable_dates` | `Date::use(CarbonImmutable::class)` — `now()`, model dates, etc. return immutable instances. | enabled |
| `PreventStrayRequests` | `prevent_stray_requests` | `Http::preventStrayRequests()` — HTTP client calls without a fake throw. **Only when running unit tests.** | enabled |
| `ProhibitDestructiveCommands` | `prohibit_destructive_commands` | `DB::prohibitDestructiveCommands()` — blocks `migrate:fresh`, `db:wipe`, etc. **in production**. | enabled |
| `SetDefaultPassword` | `password_defaults` | `Password::defaults()` — in production: min 12, max 255 characters, not found in known data leaks. | enabled |
| `ShouldBeStrict` | `strict_models` | `Model::shouldBeStrict()` — prevents lazy loading, silently discarded attributes and access to missing attributes. | enabled |
| `Unguard` | `unguard_models` | `Model::unguard()` — disables mass-assignment protection. | **disabled** |

All classes live in the `Grazulex\Lardefset\Configurables` namespace.

## Configuration

Publish the configuration file to list every switch with its documentation:

```bash
php artisan vendor:publish --tag=lardefset-config
```

This creates `config/lardefset.php`, where each default is turned on or off by its short key:

```php
<?php

return [
    // Keep plain http URLs on local environments.
    'force_https' => env('APP_ENV') !== 'local',

    // Opt in to unguarded models.
    'unguard_models' => true,

    // ...
];
```

The package configuration is merged with yours, so a key missing from the file keeps its default.

### Class name keys

Keys named after the configurable's class, used before short keys existed, are still supported. When both are set, the class name key wins:

```php
<?php

use Grazulex\Lardefset\Configurables;

return [
    Configurables\ForceScheme::class => false, // same as 'force_https' => false
];
```

## Checking the status

List every configurable with its effective state in the current environment:

```bash
php artisan lardefset:status
```

```
+-------------------------------------+----------------+
| Configurable                        | State          |
+-------------------------------------+----------------+
| AggressivePrefetching               | enabled        |
| AutomaticallyEagerLoadRelationships | enabled        |
| FakeSleep                           | not applicable |
| ForceScheme                         | disabled       |
| ...                                 | ...            |
+-------------------------------------+----------------+
```

| State | Meaning |
| --- | --- |
| `enabled` | The default is applied. |
| `disabled` | The default is turned off by its config key. |
| `not applicable` | The default has no effect in the current environment, whatever its config key says: `FakeSleep` and `PreventStrayRequests` outside unit tests, `ProhibitDestructiveCommands` and `SetDefaultPassword` outside production. |

## Development

```bash
composer lint        # Pint
composer refacto     # Rector
composer test:types  # PHPStan
composer test:unit   # Pest (100% coverage required)
composer test        # everything above, in check mode
```

## Changelog

See [CHANGELOG.md](CHANGELOG.md).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md).

## License

The MIT License (MIT). See [LICENSE.md](LICENSE.md).
