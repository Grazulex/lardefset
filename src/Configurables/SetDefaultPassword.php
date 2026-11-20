<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Configurables;

use Grazulex\Lardefset\Concerns\ReadsSwitch;
use Grazulex\Lardefset\Contracts\Conditional;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Validation\Rules\Password;

final class SetDefaultPassword implements Conditional, Configurable
{
    use ReadsSwitch;

    public function enabled(): bool
    {
        return $this->switch('password_defaults', true);
    }

    public function applicable(): bool
    {
        return app()->isProduction();
    }

    public function configure(): void
    {
        Password::defaults(
            fn (): ?Password => $this->applicable() ? Password::min(12)->max(255)->uncompromised() : null
        );
    }
}
