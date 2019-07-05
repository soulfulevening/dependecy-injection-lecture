<?php

/*
 * Зависимости разрастаются!
 */

// Source Code ===========================================================

class Order
{
    public $id;
    public $phoneNumber;
}

class Logger {
    public function log(string $msg) {
        echo "Save log with message: {$msg}" . PHP_EOL;
    }
}

class OrderRepository {
    public function save(Order $order) {
        echo "Save order" . PHP_EOL;
    }
}

class SmsNotifier {

    private $smsApiClient;

    public function __construct(SmsApiClient $smsApiClient)
    {
        $this->smsApiClient = $smsApiClient;
    }

    public function notifyOrderCreated(Order $order) {
        $this->smsApiClient->send('Your order accepted. Manager contacts you soon.', $order->phoneNumber);
    }
}

class SmsApiClient {
    public function send(string $msg, string $phoneNumber) {
        echo "Send message {$msg} to number {$phoneNumber}" . PHP_EOL;
    }
}

class OrderProcessing
{
    private $logger;

    private $orderRepository;

    private $smsNotifier;

    public function __construct(Logger $logger, OrderRepository $orderRepository, SmsNotifier $smsNotifier)
    {
        $this->logger = $logger;
        $this->orderRepository = $orderRepository;
        $this->smsNotifier = $smsNotifier;
    }

    public function createNewOrder()
    {
        // Здесь логика создания заказа

        $this->logger->log('Order created!');
    }
}

// Application ===========================================================

$logger = new Logger();
$smsNotifier = new SmsNotifier(new SmsApiClient());
$orderProcessing = new OrderProcessing($logger, new OrderRepository(), $smsNotifier);
$orderProcessing->createNewOrder();


/*
 * Проблемы:
 *
 * - Много зависимостей. Неудобно собирать классы. Как быть? Inversion Of Control!
 *
 * */