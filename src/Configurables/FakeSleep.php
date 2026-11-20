<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Conditional;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Sleep;

final readonly class FakeSleep implements Conditional, Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('fake_sleep', true) && $this->applicable();
    }

    public function applicable(): bool
    {
        return app()->runningUnitTests();
    }

    public function configure(): void
    {
        Sleep::fake();
    }
}
