<?php

declare(strict_types=1);

use Grazulex\Lardefset\Configurables\PreventStrayRequests;
use Illuminate\Support\Facades\Http;

afterEach(function (): void {
    Http::preventStrayRequests(false);
});

it('prevents stray HTTP requests', function (): void {
    $preventStrayRequests = new PreventStrayRequests;
    $preventStrayRequests->configure();

    expect(Http::preventingStrayRequests())->toBeTrue();
});

it('is enabled by default when running unit tests', function (): void {
    app()->detectEnvironment(fn (): string => 'testing');

    $preventStrayRequests = new PreventStrayRequests;

    expect($preventStrayRequests->enabled())->toBeTrue();
});

it('is disabled outside of unit tests', function (): void {
    $preventStrayRequests = new PreventStrayRequests;

    expect($preventStrayRequests->enabled())->toBeFalse();
});

it('can be disabled via configuration', function (): void {
    app()->detectEnvironment(fn (): string => 'testing');
    config()->set('lardefset.'.PreventStrayRequests::class, false);

    $preventStrayRequests = new PreventStrayRequests;

    expect($preventStrayRequests->enabled())->toBeFalse();
});
