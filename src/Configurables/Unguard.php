<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Database\Eloquent\Model;

final readonly class Unguard implements Configurable
{
    public function enabled(): bool
    {
        return config()->boolean(sprintf('lardefset.%s', self::class), false);
    }

    public function configure(): void
    {
        Model::unguard();
    }
}
