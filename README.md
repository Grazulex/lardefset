# Lardefset

Sensible default settings for Laravel applications, applied automatically when the package is installed.

> **Requires [PHP 8.4+](https://php.net/releases/) and Laravel 12.8+ or 13**

## Installation

```bash
composer require grazulex/lardefset
```

The service provider is auto-discovered. Every default listed below is applied on boot; nothing else is needed.

## Defaults

| Configurable | What it does | Default |
| --- | --- | --- |
| `AggressivePrefetching` | `Vite::useAggressivePrefetching()` — prefetches all Vite assets after page load. | enabled |
| `AutomaticallyEagerLoadRelationships` | `Model::automaticallyEagerLoadRelationships()` — eager loads relationships on demand to avoid N+1 queries. | enabled |
| `FakeSleep` | `Sleep::fake()` — `Sleep` calls return immediately. **Only when running unit tests.** | enabled |
| `ForceScheme` | `URL::forceHttps()` — every generated URL uses `https`. | enabled |
| `ImmutableDates` | `Date::use(CarbonImmutable::class)` — `now()`, model dates, etc. return immutable instances. | enabled |
| `PreventStrayRequests` | `Http::preventStrayRequests()` — HTTP client calls without a fake throw. **Only when running unit tests.** | enabled |
| `ProhibitDestructiveCommands` | `DB::prohibitDestructiveCommands()` — blocks `migrate:fresh`, `db:wipe`, etc. **in production**. | enabled |
| `SetDefaultPassword` | `Password::defaults()` — in production: min 12, max 255 characters, not found in known data leaks. | enabled |
| `ShouldBeStrict` | `Model::shouldBeStrict()` — prevents lazy loading, silently discarded attributes and access to missing attributes. | enabled |
| `Unguard` | `Model::unguard()` — disables mass-assignment protection. | **disabled** |

All classes live in the `Grazulex\Lardefset\Configurables` namespace.

## Configuration

Each default can be turned on or off from a `config/lardefset.php` file, keyed by the configurable's class name:

```php
<?php

use Grazulex\Lardefset\Configurables;

return [
    // Keep plain http URLs on local environments.
    Configurables\ForceScheme::class => env('APP_ENV') !== 'local',

    // Opt in to unguarded models.
    Configurables\Unguard::class => true,
];
```

A configurable missing from the file keeps its default.

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
