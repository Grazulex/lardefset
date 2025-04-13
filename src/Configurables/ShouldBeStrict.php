<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Database\Eloquent\Model;

final readonly class ShouldBeStrict implements Configurable
{
    public function enabled(): bool
    {
        return config()->boolean(sprintf('lardefset.%s', self::class), true);
    }

    public function configure(): void
    {
        Model::shouldBeStrict();
    }
}
