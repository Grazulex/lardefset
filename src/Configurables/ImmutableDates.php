<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Carbon\CarbonImmutable;
use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Facades\Date;

final readonly class ImmutableDates implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('immutable_dates', true);
    }

    public function configure(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
