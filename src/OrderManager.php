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

    public function getOrderInformation($pizzaId, $sauceId, $sizeID)
    {
        $stmt = $this->pdo->prepare("SELECT name FROM pizzas WHERE id = ?");
        $stmt->execute([$pizzaId]);
        $pizzaRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->pdo->prepare("SELECT name FROM sauces WHERE id = ?");
        $stmt->execute([$sauceId]);
        $sauceRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->pdo->prepare("SELECT value FROM sizes WHERE id = ?");
        $stmt->execute([$sizeID]);
        $sizeRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pizzaRow && $sauceRow) {
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
        $price = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($price) {
            return $price['price'];
        } else {
            return null;
        }
    }
}