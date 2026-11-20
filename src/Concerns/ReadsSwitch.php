<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Concerns;

/**
 * @internal
 */
trait ReadsSwitch
{
    /**
     * Reads the on/off switch of the configurable.
     *
     * The legacy `lardefset.<FQCN>` key keeps priority over the short key
     * so that existing configuration files keep working unchanged.
     */
    private function switch(string $key, bool $default): bool
    {
        $legacy = sprintf('lardefset.%s', self::class);

        if (config()->has($legacy)) {
            return config()->boolean($legacy);
        }

        return config()->boolean(sprintf('lardefset.%s', $key), $default);
    }
}
