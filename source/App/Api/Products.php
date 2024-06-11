<?php

namespace Source\App\Api;

use Source\Models\Product;

class Products extends Api
{
    public function getProducts(): void
    {
        $products = new Product();
        $this->back($products->selectAll(), 200);
    }

    public function getProduct(): void
    {

    }

    public function postProduct(): void
    {

    }

    public function putProduct(): void
    {

    }

    public function deleteProduct(): void
    {

    }
}