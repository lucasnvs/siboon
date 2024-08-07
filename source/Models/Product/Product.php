<?php

namespace Source\Models\Product;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer {
    private $message;

    public function __construct()
    {
        parent::__construct("products", ["name", "color", "size_type_id", "price_brl", "max_installments"]);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}