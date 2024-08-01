<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer {
    private $message;

    public function __construct()
    {
        parent::__construct("products", ["name", "color", "size_type", "price_brl"], timestamps: false);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}