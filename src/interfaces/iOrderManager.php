<?php

namespace Interfaces;

interface iOrderManager
{
    public function getPizzaName($pizzaId);

    public function getSauceName($sauceId);

    public function getSizeValue($sizeID);

    public function getOrderInformation($pizzaId, $sauceId, $sizeID);

    public function getPizzaPrice($pizzaID, $sizeID);

    public function getSaucePrice($sauceID);

    public function getTotalPrice($pizzaID, $sizeID, $sauceID);

    public function getCheck($pizzaId, $sauceId, $sizeID);

    public function getUsdCourse();
}