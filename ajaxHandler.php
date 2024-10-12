<?php

require_once 'vendor/autoload.php';

use Classes\OrderManager;

$orderManager = new OrderManager();

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pizzaId = $_POST['pizza_id'];
        $sizeId = $_POST['size_id'];
        $sauceId = $_POST['sauce_id'];

        $check = $orderManager->getCheck($pizzaId, $sizeId, $sauceId);

        echo json_encode(['check' => $check]);
        exit();
    }
} catch (\Exception $error) {
    echo json_encode(['error' => $error->getMessage()]);
}
