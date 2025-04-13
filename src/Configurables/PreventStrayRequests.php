<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Contrats\Configurable;
use Illuminate\Support\Facades\Http;

final readonly class PreventStrayRequests implements Configurable
{
    public function enabled(): bool
    {
        $enabled = config()->boolean(sprintf('lardefset.%s', self::class), true);
        $testing = app()->runningUnitTests();

        return $enabled && $testing;
    }

    public function configure(): void
    {
        Http::preventStrayRequests();
    }
}
