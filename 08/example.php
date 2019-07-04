<?php


/*
 * Dependency Injection! Для ленивых Пишем код и не думаем о зависимостях. Просто объявляем раеализации.
 * DI Container сам распарсит коструктор и подкинет нужные зависимости!
 */

require __DIR__ . '/config.php';

class Order
{
    public $id;
}

interface LoggerInterface {
    public function log(string $msg);
}

class Logger implements LoggerInterface {
    public function log(string $msg) {
        echo "Save log with message: {$msg}" . PHP_EOL;
    }
}

class OrderProcessing
{
    private $logger;

    public function __construct(LoggerInterface $logger)
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
 * Вот теперь все вообще хорошо. Зависимости на абстракциях. И прокидываются они туда самостоятельно.
 */


