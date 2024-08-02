<?php

namespace Source\Models\Product;

use CoffeeCode\DataLayer\DataLayer;

class ProductSizeType extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product_size_type", ["id", "name"], timestamps: false);
    }
}