<?php

declare(strict_types=1);

use Grazulex\Lardefset\Configurables\AutomaticallyEagerLoadRelationships;
use Illuminate\Database\Eloquent\Model;

beforeEach()
    ->skip(fn (): bool => ! method_exists(Model::class, 'automaticallyEagerLoadRelationships'),
        'Automatically eager loading relationships is not supported in this version of Laravel.');

it('enables automatic eager loading', function (): void {
    Model::automaticallyEagerLoadRelationships(false);

    $eagerLoad = new AutomaticallyEagerLoadRelationships;
    $eagerLoad->configure();

    expect(Model::isAutomaticallyEagerLoadingRelationships())->toBeTrue();
});

it('is enabled by default', function (): void {
    $eagerLoad = new AutomaticallyEagerLoadRelationships;

    expect($eagerLoad->enabled())->toBeTrue();
});

it('can be disabled via configuration', function (): void {
    config()->set('lardefset.'.AutomaticallyEagerLoadRelationships::class, false);

    $eagerLoad = new AutomaticallyEagerLoadRelationships;

    expect($eagerLoad->enabled())->toBeFalse();
});
