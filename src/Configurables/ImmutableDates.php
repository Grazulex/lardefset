<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Carbon\CarbonImmutable;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Facades\Date;

final readonly class ImmutableDates implements Configurable
{
    public function enabled(): bool
    {
        return config()->boolean(sprintf('lardefset.%s', self::class), true);
    }

    public function configure(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
