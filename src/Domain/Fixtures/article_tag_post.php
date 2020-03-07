<?php

use PhpLab\Eloquent\Fixture\Helpers\FixtureFactoryHelper;

$fixture = new FixtureFactoryHelper;
$fixture->setCount(200);
$fixture->setCallback(function ($index, FixtureFactoryHelper $fixtureFactory) {
    return [
        'id' => $index,
        'tag_id' => $fixtureFactory->ordIndex($index, 7),
        'post_id' => ceil($index / 2),
    ];
});
return $fixture->generateCollection();
