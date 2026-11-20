<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Conditional;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Facades\Http;

final readonly class PreventStrayRequests implements Conditional, Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('prevent_stray_requests', true) && $this->applicable();
    }

    public function applicable(): bool
    {
        return app()->runningUnitTests();
    }

    public function configure(): void
    {
        Http::preventStrayRequests();
    }
}
