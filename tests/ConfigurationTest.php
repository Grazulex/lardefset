<?php

declare(strict_types=1);

use Grazulex\Lardefset\Configurables;
use Grazulex\Lardefset\Contracts\Configurable;
use Grazulex\Lardefset\LardefsetServiceProvider;
use Illuminate\Support\ServiceProvider;

it('merges the package configuration', function (): void {
    expect(config('lardefset'))->toBe([
        'aggressive_prefetching' => true,
        'automatic_eager_loading' => true,
        'fake_sleep' => true,
        'force_https' => true,
        'immutable_dates' => true,
        'prevent_stray_requests' => true,
        'prohibit_destructive_commands' => true,
        'password_defaults' => true,
        'strict_models' => true,
        'unguard_models' => false,
    ]);
});

it('publishes the configuration file', function (): void {
    $paths = ServiceProvider::pathsToPublish(LardefsetServiceProvider::class, 'lardefset-config');

    expect($paths)->toHaveCount(1)
        ->and(array_values($paths))->toBe([config_path('lardefset.php')])
        ->and(array_key_first($paths))->toBeFile();
});

it('can be disabled via its short key', function (string $configurable, string $key): void {
    config()->set('lardefset.'.$key, false);

    /** @var Configurable $instance */
    $instance = app($configurable);

    expect($instance->enabled())->toBeFalse();
})->with([
    [Configurables\AggressivePrefetching::class, 'aggressive_prefetching'],
    [Configurables\AutomaticallyEagerLoadRelationships::class, 'automatic_eager_loading'],
    [Configurables\FakeSleep::class, 'fake_sleep'],
    [Configurables\ForceScheme::class, 'force_https'],
    [Configurables\ImmutableDates::class, 'immutable_dates'],
    [Configurables\PreventStrayRequests::class, 'prevent_stray_requests'],
    [Configurables\ProhibitDestructiveCommands::class, 'prohibit_destructive_commands'],
    [Configurables\SetDefaultPassword::class, 'password_defaults'],
    [Configurables\ShouldBeStrict::class, 'strict_models'],
]);

it('can be enabled via its short key', function (): void {
    config()->set('lardefset.unguard_models', true);

    expect((new Configurables\Unguard)->enabled())->toBeTrue();
});

it('still honours the class name key', function (): void {
    config()->set('lardefset.'.Configurables\ShouldBeStrict::class, false);

    expect((new Configurables\ShouldBeStrict)->enabled())->toBeFalse();
});

it('gives the class name key priority over the short key', function (): void {
    config()->set('lardefset.strict_models', true);
    config()->set('lardefset.'.Configurables\ShouldBeStrict::class, false);

    expect((new Configurables\ShouldBeStrict)->enabled())->toBeFalse();

    config()->set('lardefset.unguard_models', false);
    config()->set('lardefset.'.Configurables\Unguard::class, true);

    expect((new Configurables\Unguard)->enabled())->toBeTrue();
});

it('falls back to the built-in default without any configuration', function (): void {
    config()->set('lardefset', []);

    expect((new Configurables\ShouldBeStrict)->enabled())->toBeTrue()
        ->and((new Configurables\Unguard)->enabled())->toBeFalse();
});
