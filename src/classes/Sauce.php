<?php

namespace Classes;

use abstracts\Product;

class Sauce extends Product
{
    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }
}