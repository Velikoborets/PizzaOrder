<?php

namespace Classes;

use Interfaces\iOrderManager;

class OrderManager implements iOrderManager
{
    private $pdo;

    public function __construct()
    {
        // Используем статический метод для получения соединения с Б\Д
        $this->pdo = Connect::getConnection();
    }

    public function getPizzaName($pizzaId)
    {
        $stmt = $this->pdo->prepare("SELECT name FROM pizzas WHERE id = ?");
        $stmt->execute([$pizzaId]);
        $pizzaName =  $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!empty($pizzaName)) {
            return $pizzaName;
        } else {
            throw new \Exception("Проблема с получением имени пиццы!");
        }
    }

    public function getSauceName($sauceId)
    {
        $stmt = $this->pdo->prepare("SELECT name FROM sauces WHERE id = ?");
        $stmt->execute([$sauceId]);
        $sauceName = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!empty($sauceName)) {
            return $sauceName;
        } else {
            throw new \Exception("Проблема с получением имени соуса!");
        }
    }

    public function getSizeValue($sizeID)
    {
        $stmt = $this->pdo->prepare("SELECT value FROM sizes WHERE id = ?");
        $stmt->execute([$sizeID]);
        $size = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!empty($size)) {
            return $size;
        } else {
            throw new \Exception("Проблема с получением размера!");
        }
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
        $pizzaPrice = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!empty($pizzaPrice)) {
            return $pizzaPrice;
        } else {
            throw new \Exception("Проблема с получением цены пиццы!!");
        }
    }

    public function getSaucePrice($sauceID)
    {
        $stmt = $this->pdo->prepare("SELECT price FROM sauces WHERE id = ?");
        $stmt->execute([$sauceID]);
        $saucePrice = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!empty($saucePrice)) {
            return $saucePrice;
        } else {
            throw new \Exception("Проблема с получением цены Соуса!");
        }
    }

    public function getTotalPrice($pizzaID, $sizeID, $sauceID)
    {
        $pizzaPriceRow = $this->getPizzaPrice($pizzaID, $sizeID);
        $soucePriceRow = $this->getSaucePrice($sauceID);

        if ($pizzaPriceRow && $soucePriceRow) {
            $totalPrice = $pizzaPriceRow['price'] + $soucePriceRow['price'];

            // Доп. задание
            $usdCourse = $this->getUsdCourse();
            $totalRubPrice = $totalPrice * $usdCourse;
            $totalRubPrice = round($totalRubPrice, 2);

            return 'Суммарная стоимость заказа: ' . $totalRubPrice . ' р.';
        } else {
            return null;
        }
    }

    public function getCheck($pizzaId, $sauceId, $sizeID)
    {
        $check = $this->getOrderInformation($pizzaId, $sauceId, $sizeID) . '<br>' .
        $this->getTotalPrice($pizzaId, $sauceId, $sizeID);
        return $check;
    }

    // Доп. задание (конвертер валюты через API НБ РБ)
    public function getUsdCourse()
    {
        $apiUrl = 'https://www.nbrb.by/api/exrates/rates/USD?parammode=2'; // URL API НБРБ
        $response = file_get_contents($apiUrl); // Получаем данные из API
        $data = json_decode($response, true); // Декодируем JSON в массив

        // Проверяем, что данные получены корректно
        if (isset($data['Cur_OfficialRate'])) {
            return $data['Cur_OfficialRate'];
        } else {
            throw new \Exception("Не удалось получить курс доллара!");
        }
    }
}