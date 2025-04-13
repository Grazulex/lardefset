<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Contrats\Configurable;
use Illuminate\Support\Facades\URL;

final readonly class ForceScheme implements Configurable
{
    public function enabled(): bool
    {
        return config()->boolean(sprintf('lardefset.%s', self::class), true);
    }

    public function configure(): void
    {
        URL::forceHttps();
    }
}
