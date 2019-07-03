<?php

/*
 * Пример независимого кода
 * Нет зависимостей - нет проблем
 * Наш класс содержит в себе все что ему нужно и ни от кого не зависит
 */

class Order
{
    public $id;
}

class OrderProcessing
{
    public function createNewOrder()
    {
        // Здесь логика создания заказа

        $this->log('Order created!');
    }

    private function log(string $msg)
    {
        echo "Save log with message: {$msg}" . PHP_EOL;
    }
}


// Application ===========================================================

$orderProcessing = new OrderProcessing();
$orderProcessing->createNewOrder();



/*
 * Проблемы:
 *
 * - Нельзя переиспользовать код логирования и сохранения
 * - Нарушется принцып Single Responsibility, и все что за этим следует
 *
 * */
