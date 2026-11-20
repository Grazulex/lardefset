<?php

declare(strict_types=1);

namespace Grazulex\Lardefset\Commands;

use Grazulex\Lardefset\ConfigurableRegistry;
use Grazulex\Lardefset\Contracts\Conditional;
use Grazulex\Lardefset\Contracts\Configurable;
use Illuminate\Console\Command;

/**
 * @internal
 */
final class StatusCommand extends Command
{
    private const string ENABLED = 'enabled';

    private const string DISABLED = 'disabled';

    private const string NOT_APPLICABLE = 'not applicable';

    /**
     * @var string
     */
    protected $signature = 'lardefset:status';

    /**
     * @var string
     */
    protected $description = 'List each Lardefset configurable with its state in the current environment';

    public function handle(): int
    {
        $rows = array_map(
            fn (string $class): array => [class_basename($class), $this->state($this->laravel->make($class))],
            ConfigurableRegistry::all(),
        );

        $this->table(['Configurable', 'State'], $rows);

        return self::SUCCESS;
    }

    private function state(Configurable $configurable): string
    {
        if ($configurable instanceof Conditional && ! $configurable->applicable()) {
            return self::NOT_APPLICABLE;
        }

        return $configurable->enabled() ? self::ENABLED : self::DISABLED;
    }
}
