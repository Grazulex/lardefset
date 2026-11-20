<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Support\Facades\DB;

final readonly class ProhibitDestructiveCommands implements Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('prohibit_destructive_commands', true);
    }

    public function configure(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );
    }
}
