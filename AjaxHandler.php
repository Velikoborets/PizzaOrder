<?php

require_once 'src/OrderManager.php';
require_once 'src/Pizza.php';

$orderManager = new OrderManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pizzaId = $_POST['pizza_id'];
    $sizeId = $_POST['size_id'];
    $sauceId = $_POST['sauce_id'];

    // $check = $orderManager->getCheck($pizzaId, $sauceId, $sizeId);
    $check = $orderManager->getCheck($pizzaId, $sauceId, $sizeId);
    echo json_encode(['check' => $check]);
    exit;
}

?>