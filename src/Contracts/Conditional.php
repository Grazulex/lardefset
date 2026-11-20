<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Contracts;

/**
 * A configurable that only has an effect in some environments.
 *
 * @internal
 */
interface Conditional
{
    /**
     * Whether the current environment is one where the configurable has an effect.
     */
    public function applicable(): bool;
}
