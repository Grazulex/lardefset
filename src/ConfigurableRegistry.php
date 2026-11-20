<?php

declare(strict_types=1);

namespace Grazulex\Lardefset;

use Grazulex\Lardefset\Contracts\Configurable;

/**
 * @internal
 */
final class ConfigurableRegistry
{
    /**
     * @var list<class-string<Configurable>>
     */
    private const array CONFIGURABLES = [
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

    /**
     * @return list<class-string<Configurable>>
     */
    public static function all(): array
    {
        return self::CONFIGURABLES;
    }
}
