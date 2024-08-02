<?php

namespace Source\Models\Product;

use CoffeeCode\DataLayer\DataLayer;

class ProductImage extends DataLayer
{
    static string $PRINCIPAL = "PRINCIPAL";
    static string $ADDITIONAL = "ADDITIONAL";

    public function __construct()
    {
        parent::__construct("product_images", ["id", "image", "product_id", "type"], timestamps: false);
    }
}