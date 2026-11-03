<?php

declare(strict_types=1);

use Grazulex\Lardefset\Configurables\FakeSleep;
use Illuminate\Support\Sleep;

afterEach(function (): void {
    Sleep::fake(false);
});

it('fakes sleeping', function (): void {
    $fakeSleep = new FakeSleep;
    $fakeSleep->configure();

    Sleep::for(1)->second();

    Sleep::assertSleptTimes(1);
});

it('is enabled by default when running unit tests', function (): void {
    app()->detectEnvironment(fn (): string => 'testing');

    $fakeSleep = new FakeSleep;

    expect($fakeSleep->enabled())->toBeTrue();
});

it('is disabled outside of unit tests', function (): void {
    $fakeSleep = new FakeSleep;

    expect($fakeSleep->enabled())->toBeFalse();
});

it('can be disabled via configuration', function (): void {
    app()->detectEnvironment(fn (): string => 'testing');
    config()->set('lardefset.'.FakeSleep::class, false);

    $fakeSleep = new FakeSleep;

    expect($fakeSleep->enabled())->toBeFalse();
});
