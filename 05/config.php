<?php

// FRAMEWORK CONFIGURATION //
require __DIR__ . '/../vendor/autoload.php';

$container = new \Pimple\Container();

$container['logger'] = function ($container) {
    return new Logger();
};

$serviceLocator = new \Pimple\Psr11\ServiceLocator($container, ['logger']);

// FRAMEWORK CONFIGURATION //