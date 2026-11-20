<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Facades\Vite;

final readonly class AggressivePrefetching implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('aggressive_prefetching', true);
    }

    public function configure(): void
    {
        Vite::useAggressivePrefetching();
    }
}
