<?php

declare(strict_types=1);

namespace Tests;

use Grazulex\Lardefset\LardefsetServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get the application package providers.
     */
    protected function getPackageProviders($app): array
    {
        app()->detectEnvironment(fn (): string => 'production');

        return [
            LardefsetServiceProvider::class,
        ];
    }
}
