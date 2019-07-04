<?php


require __DIR__ . '/../vendor/autoload.php';

$container = new \Pimple\Container();

$container['logger'] = function ($container) {
    return new Logger();
};

$container['order.processing'] = function ($container) {
    return new OrderProcessing($container['logger']);
};

$serviceLocator = new \Pimple\Psr11\ServiceLocator($container, ['logger', 'order.processing']);