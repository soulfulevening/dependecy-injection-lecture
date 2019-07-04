<?php


/*
 * Перепишем немного наш код. И получим нормальное внедрение зависимостей.
 */

require __DIR__ . '/config.php';

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

$orderProcessing = $serviceLocator->get('order.processing');
$orderProcessing->createNewOrder();


/*
 * Уже немного получше! Какие проблемы мы решили:
 *
 * - Теперь в классе OrderProcessing зависимости указаны явно. Мы видим от каких копоненов зависит наш класс.
 * - Стало полегче рефакторить. Мы слегкость сможем найти все использования метода log конкретного класса.
 * - Dependecy Inversion не нарушен (за исключением того что зависимость построена на реализацию, а не на абстракцию)
 *
 * Но, мы по прежнему используем Локатор служб. Да, под капотом у нас есть Dependency Injection. Мы не паримся о том как
 * создавать класс OrderProcessing, все что нам нужно мы сконфигурировали в контейнере, и просто берем сервси из локатора служб.
 *
 * Из минусов:
 * - При разработке веб-приложения нам всеравно прийдется использовать локатор в контроллерах, консольных команда.
 *  И зависимости будут по прежнему указаны не явно.
 * - При добавлении или удалении зависимости, нужно править конфиги.
 */


