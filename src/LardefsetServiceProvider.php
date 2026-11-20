<?php

declare(strict_types=1);

namespace Grazulex\Lardefset;

use Grazulex\Lardefset\Commands\StatusCommand;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * @internal
 */
final class LardefsetServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lardefset.php', 'lardefset');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/lardefset.php' => config_path('lardefset.php'),
        ], 'lardefset-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                StatusCommand::class,
            ]);
        }

        collect(ConfigurableRegistry::all())
            ->map(fn (string $configurable) => $this->app->make($configurable))
            ->filter(fn (Configurable $configurable): bool => $configurable->enabled())
            ->each(fn (Configurable $configurable) => $configurable->configure());
    }
}
