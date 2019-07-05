<?php

/*
 * Передаем логгер через конструктор! Теперь он у нас всегда будет один и тот же.
 */

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

$logger = new Logger();
$orderProcessing = new OrderProcessing($logger);
$orderProcessing->createNewOrder();


/*
 * Проблемы:
 *
 * - В принцыпе уже все очень хорошо. Кроме того что нарушен принцип Dependency Inversion (Но это уже другая тема)
 * - OrderProcessing нужен нам в разных местах нашего приложения. И получается что для его создания нам нужно везде таскать
 * за ним его зависимости, что бы мы могли создать объект.
 * - Со временем наш конструктор может разрастись, что усложнит поддердку кода. Ведь если в конструктор передается более 5-ти
 * зависимостей, их постоянно нужно иметь под рукой. При этом если что-то добавляестя или убирается, нужно менять во всех местах
 * где созадется наш объект.
 * - Как рашения можно использовать фабрики для создания всех объектов (но это очень сложно в поддержке)
 *
 * */