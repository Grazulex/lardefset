<?php

declare(strict_types=1);

use Grazulex\Lardefset\Configurables\Unguard;
use Illuminate\Database\Eloquent\Model;

afterEach(function (): void {
    Model::reguard();
});

it('unguards models', function (): void {
    $unguard = new Unguard;
    $unguard->configure();

    expect(Model::isUnguarded())->toBeTrue();
});

it('is disabled by default', function (): void {
    $unguard = new Unguard;

    expect($unguard->enabled())->toBeFalse();
});

it('can be enabled via configuration', function (): void {
    config()->set('lardefset.'.Unguard::class, true);

    $unguard = new Unguard;

    expect($unguard->enabled())->toBeTrue();
});
