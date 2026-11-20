<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Facades\URL;

final readonly class ForceScheme implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('force_https', true);
    }

    public function configure(): void
    {
        URL::forceHttps();
    }
}
