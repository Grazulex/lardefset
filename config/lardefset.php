<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Aggressive prefetching
    |--------------------------------------------------------------------------
    |
    | Vite::useAggressivePrefetching(): prefetches every Vite asset once the
    | page has loaded.
    |
    */

    'aggressive_prefetching' => true,

    /*
    |--------------------------------------------------------------------------
    | Automatic eager loading
    |--------------------------------------------------------------------------
    |
    | Model::automaticallyEagerLoadRelationships(): eager loads relationships
    | on demand to avoid N+1 queries.
    |
    */

    'automatic_eager_loading' => true,

    /*
    |--------------------------------------------------------------------------
    | Fake sleep
    |--------------------------------------------------------------------------
    |
    | Sleep::fake(): Sleep calls return immediately. Only applied when running
    | unit tests.
    |
    */

    'fake_sleep' => true,

    /*
    |--------------------------------------------------------------------------
    | Force HTTPS
    |--------------------------------------------------------------------------
    |
    | URL::forceHttps(): every generated URL uses the https scheme.
    |
    */

    'force_https' => true,

    /*
    |--------------------------------------------------------------------------
    | Immutable dates
    |--------------------------------------------------------------------------
    |
    | Date::use(CarbonImmutable::class): now(), model dates, etc. return
    | immutable instances.
    |
    */

    'immutable_dates' => true,

    /*
    |--------------------------------------------------------------------------
    | Prevent stray requests
    |--------------------------------------------------------------------------
    |
    | Http::preventStrayRequests(): HTTP client calls without a fake throw.
    | Only applied when running unit tests.
    |
    */

    'prevent_stray_requests' => true,

    /*
    |--------------------------------------------------------------------------
    | Prohibit destructive commands
    |--------------------------------------------------------------------------
    |
    | DB::prohibitDestructiveCommands(): blocks migrate:fresh, db:wipe, etc.
    | in production.
    |
    */

    'prohibit_destructive_commands' => true,

    /*
    |--------------------------------------------------------------------------
    | Password defaults
    |--------------------------------------------------------------------------
    |
    | Password::defaults(): in production, passwords need 12 to 255
    | characters and must not appear in known data leaks.
    |
    */

    'password_defaults' => true,

    /*
    |--------------------------------------------------------------------------
    | Strict models
    |--------------------------------------------------------------------------
    |
    | Model::shouldBeStrict(): prevents lazy loading, silently discarded
    | attributes and access to missing attributes.
    |
    */

    'strict_models' => true,

    /*
    |--------------------------------------------------------------------------
    | Unguard models
    |--------------------------------------------------------------------------
    |
    | Model::unguard(): disables mass-assignment protection. Disabled by
    | default.
    |
    */

    'unguard_models' => false,

];
