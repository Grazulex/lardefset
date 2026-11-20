<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Facades\Http;

final readonly class PreventStrayRequests implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        $enabled = $this->switch('prevent_stray_requests', true);
        $testing = app()->runningUnitTests();

        return $enabled && $testing;
    }

    public function configure(): void
    {
        Http::preventStrayRequests();
    }
}
