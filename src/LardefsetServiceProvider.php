<?php

declare(strict_types=1);

namespace Grazulex\Lardefset;

use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * @internal
 */
final class LardefsetServiceProvider extends BaseServiceProvider
{
    /**
     * @var list<class-string<Configurable>>
     */
    private array $configurables = [
        Configurables\AggressivePrefetching::class,
        Configurables\AutomaticallyEagerLoadRelationships::class,
        Configurables\FakeSleep::class,
        Configurables\ForceScheme::class,
        Configurables\ImmutableDates::class,
        Configurables\PreventStrayRequests::class,
        Configurables\ProhibitDestructiveCommands::class,
        Configurables\SetDefaultPassword::class,
        Configurables\ShouldBeStrict::class,
        Configurables\Unguard::class,
    ];

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lardefset.php', 'lardefset');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/lardefset.php' => config_path('lardefset.php'),
        ], 'lardefset-config');

        collect($this->configurables)
            ->map(fn (string $configurable) => $this->app->make($configurable))
            ->filter(fn (Configurable $configurable): bool => $configurable->enabled())
            ->each(fn (Configurable $configurable) => $configurable->configure());
    }
}
