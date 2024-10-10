<?php

namespace Classes;

use abstracts\Product;

class Pizza extends Product
{
    public $size;

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getName()
    {
        return $this->name;
    }
}