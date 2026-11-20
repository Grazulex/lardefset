<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Database\Eloquent\Model;

final readonly class ShouldBeStrict implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('strict_models', true);
    }

    public function configure(): void
    {
        Model::shouldBeStrict();
    }
}
