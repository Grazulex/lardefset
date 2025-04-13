<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Contracts;

/**
 * @internal
 */
interface Configurable
{
    public function enabled(): bool;

    public function configure(): void;
}
