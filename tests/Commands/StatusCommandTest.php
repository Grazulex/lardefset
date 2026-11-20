<?php

declare(strict_types=1);

use Grazulex\Lardefset\Configurables;

it('lists the state of every configurable in production', function (): void {
    $this->artisan('lardefset:status')
        ->expectsTable(['Configurable', 'State'], [
            ['AggressivePrefetching', 'enabled'],
            ['AutomaticallyEagerLoadRelationships', 'enabled'],
            ['FakeSleep', 'not applicable'],
            ['ForceScheme', 'enabled'],
            ['ImmutableDates', 'enabled'],
            ['PreventStrayRequests', 'not applicable'],
            ['ProhibitDestructiveCommands', 'enabled'],
            ['SetDefaultPassword', 'enabled'],
            ['ShouldBeStrict', 'enabled'],
            ['Unguard', 'disabled'],
        ])
        ->assertSuccessful();
});

it('lists the state of every configurable when running unit tests', function (): void {
    app()->detectEnvironment(fn (): string => 'testing');

    $this->artisan('lardefset:status')
        ->expectsTable(['Configurable', 'State'], [
            ['AggressivePrefetching', 'enabled'],
            ['AutomaticallyEagerLoadRelationships', 'enabled'],
            ['FakeSleep', 'enabled'],
            ['ForceScheme', 'enabled'],
            ['ImmutableDates', 'enabled'],
            ['PreventStrayRequests', 'enabled'],
            ['ProhibitDestructiveCommands', 'not applicable'],
            ['SetDefaultPassword', 'not applicable'],
            ['ShouldBeStrict', 'enabled'],
            ['Unguard', 'disabled'],
        ])
        ->assertSuccessful();
});

it('reflects the configuration', function (): void {
    config()->set('lardefset.force_https', false);
    config()->set('lardefset.unguard_models', true);
    config()->set('lardefset.'.Configurables\ShouldBeStrict::class, false);

    $this->artisan('lardefset:status')
        ->expectsTable(['Configurable', 'State'], [
            ['AggressivePrefetching', 'enabled'],
            ['AutomaticallyEagerLoadRelationships', 'enabled'],
            ['FakeSleep', 'not applicable'],
            ['ForceScheme', 'disabled'],
            ['ImmutableDates', 'enabled'],
            ['PreventStrayRequests', 'not applicable'],
            ['ProhibitDestructiveCommands', 'enabled'],
            ['SetDefaultPassword', 'enabled'],
            ['ShouldBeStrict', 'disabled'],
            ['Unguard', 'enabled'],
        ])
        ->assertSuccessful();
});

it('reports a switched off conditional configurable as not applicable outside its environment', function (): void {
    app()->detectEnvironment(fn (): string => 'local');
    config()->set('lardefset.password_defaults', false);

    $this->artisan('lardefset:status')
        ->expectsTable(['Configurable', 'State'], [
            ['AggressivePrefetching', 'enabled'],
            ['AutomaticallyEagerLoadRelationships', 'enabled'],
            ['FakeSleep', 'not applicable'],
            ['ForceScheme', 'enabled'],
            ['ImmutableDates', 'enabled'],
            ['PreventStrayRequests', 'not applicable'],
            ['ProhibitDestructiveCommands', 'not applicable'],
            ['SetDefaultPassword', 'not applicable'],
            ['ShouldBeStrict', 'enabled'],
            ['Unguard', 'disabled'],
        ])
        ->assertSuccessful();
});

it('tells in which environments a conditional configurable applies', function (string $environment, bool $testing, bool $production): void {
    app()->detectEnvironment(fn (): string => $environment);

    expect((new Configurables\FakeSleep)->applicable())->toBe($testing)
        ->and((new Configurables\PreventStrayRequests)->applicable())->toBe($testing)
        ->and((new Configurables\ProhibitDestructiveCommands)->applicable())->toBe($production)
        ->and((new Configurables\SetDefaultPassword)->applicable())->toBe($production);
})->with([
    ['testing', true, false],
    ['production', false, true],
    ['local', false, false],
]);
