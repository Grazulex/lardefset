<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Database\Eloquent\Model;

final readonly class Unguard implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('unguard_models', false);
    }

    public function configure(): void
    {
        Model::unguard();
    }
}
