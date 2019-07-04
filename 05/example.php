<?php


/*
 * Inversion Of Control гласит о том что внедрением зависимостей занимается сам фреймворк.
 * Мы же, разработчики просто пишем код, не думая о том как собирать объекты. Об это позаботится сам фреймворк.
 *
 * Теперь вопрос, как это сделать?
 *
 * Есть несколько подходов для реализиции Ioc. Рассмотрим самые известные, это:
 * - ServiceLocator
 * - Dependency Injection
 *
 * Рассмотрим первый варинат использования Локатора служб
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
    private $serviceLocator;

    public function __construct(\Pimple\Psr11\ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function createNewOrder()
    {
        // Здесь логика создания заказа

        $this->serviceLocator->get('logger')->log('Order created!');
    }
}

// Application ===========================================================

$orderProcessing = new OrderProcessing($serviceLocator);
$orderProcessing->createNewOrder();


/*
 * Теперь наши зависимости конфигурируеются в одном месте. И мы не думаем о том как их прокидывать в классы.
 * Все что нам нужно - есть в Сервис Локаторе.
 *
 * Но почему же Сервис Локатор считается антипаттерном?
 *
 * Из минусов:
 * - Зависимости указаны неявно. Смотря на код OrderProcessing мы не понимаем какие у него есть зависимости.
 * - Зависимости настроены неявно. Мы так же не понимаем что находится за идентификатором 'logger'
 * - Сложно рефакторить. Попробуйте найти в большом проекте все вызовы метода log которые относятся к классу Logger.
 *  Если используется он вот так `$this->serviceLocator->get('logger')->log('Order created!')`. Здесь разве что поиск в помощь.
 *  Но представте что вам нужно отрефакторить метод который называется например "save" и он у множества классов которые
 *  настроенны в Локаторе Служб.
 * - Здесь нарушен принцып Dependency Inversion. Зависимости создаются внтури самого класса.
 */


