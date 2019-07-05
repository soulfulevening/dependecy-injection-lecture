<?php


/*
 * Dependency Injection! Для ленивых Пишем код и не думаем о зависимостях. Просто объявляем раеализации.
 * DI Container сам распарсит коструктор и подкинет нужные зависимости!
 */

require __DIR__ . '/config.php';

// Source Code ===========================================================

class Order
{
    public $id;
}

class Logger {
    public function log(string $msg) {
        echo "Save log with message: {$msg}" . PHP_EOL;
    }
}

class OrderProcessing
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function createNewOrder()
    {
        // Здесь логика создания заказа

        $this->logger->log('Order created!');
    }
}

// Application ===========================================================

$orderProcessing = $container->get(OrderProcessing::class);
$orderProcessing->createNewOrder();


/*
 * Все идеально. Теперь мы можем созадавать и контроллеры через DI контейнер, который сам подкинет нужные зависимости.
 * Но как же быть если мы хотим построить правильную зависимость на интерфейс?
 */


