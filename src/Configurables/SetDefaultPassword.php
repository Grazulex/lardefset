<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Validation\Rules\Password;

final class SetDefaultPassword implements Configurable
{
    public function enabled(): bool
    {
        return config()->boolean(sprintf('lardefset.%s', self::class), true);
    }

    public function configure(): void
    {
        Password::defaults(
            fn (): ?password => app()->isProduction() ? Password::min(12)->max(255)->uncompromised() : null
        );
    }
}
