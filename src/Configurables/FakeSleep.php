<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Sleep;

final readonly class FakeSleep implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        $enabled = $this->switch('fake_sleep', true);
        $testing = app()->runningUnitTests();

        return $enabled && $testing;
    }

    public function configure(): void
    {
        Sleep::fake();
    }
}
