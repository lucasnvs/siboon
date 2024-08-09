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

    public function setData($data)
    {
        if (isset($data["name"])) {
            $this->name = $data["name"];
        }
        if (isset($data["description"])) {
            $this->description = $data["description"];
        }
        if (isset($data["color"])) {
            $this->color = $data["color"];
        }
        if (isset($data["size_type"])) {
            $this->size_type_id = $data["size_type"];
        }
        if (isset($data["price_brl"])) {
            $this->price_brl = $data["price_brl"];
        }
        if (isset($data["max_installments"])) {
            $this->max_installments = $data["max_installments"];
        }
        if (isset($data["discount_brl_percentage"])) {
            $this->discount_brl_percentage = $data["discount_brl_percentage"];
        }
    }
}