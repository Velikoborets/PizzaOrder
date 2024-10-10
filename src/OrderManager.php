<?php

require_once 'Connect.php';
class OrderManager
{
    private $pdo;

    public function __construct()
    {
        // Используем статический метод для получения Соединение с Б\Д
        $this->pdo = Connect::getConnection();
    }

    public function getPizzaName($pizzaId)
    {
        $stmt = $this->pdo->prepare("SELECT name FROM pizzas WHERE id = ?");
        $stmt->execute([$pizzaId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSauceName($sauceId)
    {
        $stmt = $this->pdo->prepare("SELECT name FROM sauces WHERE id = ?");
        $stmt->execute([$sauceId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSizeValue($sizeID)
    {
        $stmt = $this->pdo->prepare("SELECT value FROM sizes WHERE id = ?");
        $stmt->execute([$sizeID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderInformation($pizzaId, $sauceId, $sizeID)
    {
        $pizzaRow = $this->getPizzaName($pizzaId);
        $sauceRow = $this->getSauceName($sauceId);
        $sizeRow = $this->getSizeValue($sizeID);

        if ($pizzaRow && $sauceRow && $sizeRow) {
            return $pizzaRow['name'] . ' (' . $sizeRow['value'] . ' см)  ' . 'соус: ' . $sauceRow['name'];
        } else {
            return null;
        }
    }

    public function getPizzaPrice($pizzaID, $sizeID)
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                pizzas.name as pizza, prices.value as price, sizes.value as size 
            FROM 
                pizzas 
            JOIN prices 
                ON pizzas.id=prices.pizza_id
            JOIN sizes 
                ON sizes.id=prices.size_id
            WHERE pizzas.id = ?
            AND sizes.id = ?;
        ");

        $stmt->execute([$pizzaID, $sizeID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSaucePrice($sauceID)
    {
        $stmt = $this->pdo->prepare("SELECT price FROM sauces WHERE id = ?");
        $stmt->execute([$sauceID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalPrice($pizzaID, $sizeID, $sauceID)
    {
        $pizzaPriceRow = $this->getPizzaPrice($pizzaID, $sizeID);
        $soucePriceRow = $this->getSaucePrice($sauceID);

        if ($pizzaPriceRow && $soucePriceRow) {
            $totalPrice =  $pizzaPriceRow['price'] + $soucePriceRow['price'];
            return 'Суммарная стоимость заказа: ' . $totalPrice . ' р.';
        } else {
            return null;
        }
    }

    public function getCheck($pizzaId, $sauceId, $sizeID)
    {
        $check =  $this->getOrderInformation($pizzaId, $sauceId, $sizeID) . '<br>' .
        $this->getTotalPrice($pizzaId, $sauceId, $sizeID);
        return $check;
    }
}