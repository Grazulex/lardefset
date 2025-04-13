<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Contrats\Configurable;
use Illuminate\Support\Sleep;

final readonly class FakeSleep implements Configurable
{
    public function enabled(): bool
    {
        $enabled = config()->boolean(sprintf('lardefset.%s', self::class), true);
        $testing = app()->runningUnitTests();

        return $enabled && $testing;
    }

    public function configure(): void
    {
        Sleep::fake();
    }
}
