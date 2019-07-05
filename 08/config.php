<?php

// FRAMEWORK CONFIGURATION //
require __DIR__ . '/../vendor/autoload.php';


$builder = new \DI\ContainerBuilder();

$builder->addDefinitions([
    LoggerInterface::class => \DI\create(Logger::class)
]);

$container = $builder->build();
// FRAMEWORK CONFIGURATION //