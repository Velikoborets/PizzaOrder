<?php

namespace Abstracts;
abstract class Product
{
    public $id;
    public $price;
    public $name;

    abstract public function getId();

    abstract public function getPrice();

    abstract public function getName();
}
