<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Database\Eloquent\Model;

final readonly class AutomaticallyEagerLoadRelationships implements Configurable
{
    public function enabled(): bool
    {
        return config()->boolean(sprintf('lardefset.%s', self::class), true);
    }

    public function configure(): void
    {
        // @phpstan-ignore-next-line
        if (! method_exists(Model::class, 'automaticallyEagerLoadRelationships')) {
            return;
        }

        Model::automaticallyEagerLoadRelationships();
    }
}
