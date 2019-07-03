<?php

/*
 * Поняли что логгер нужно переиспользовать в других классах
 * Так у нас и появились зависимости
 */

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
    public function createNewOrder()
    {
        // Здесь логика создания заказа

        (new Logger())->log('Order created!');
    }
}

// Application ===========================================================

$orderProcessing = new OrderProcessing();
$orderProcessing->createNewOrder();


/*
 * Проблемы:
 *
 * - Зависимости не явные, нужно прочитать весь кода класса OrderProcessing что бы понять от чего он зависит
 * - Logger будет создаватся кадый раз при вызове метода createNewOrder, а так же во всех других местах приложения
 * где он будет использован, заново.
 *
 *
 * */