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

    public function setData(array $data)
    {
        $this->name = $data["name"];
        $this->description = $data["description"];
        $this->color = $data["color"];
        $this->size_type_id = $data["size_type_id"];
        $this->price_brl = $data["price_brl"];
        $this->max_installments = $data["max_installments"];
        $this->discount_brl_percentage = $data["discount_brl_percentage"];
    }
}