<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * @property int|null $product_id
 * @property string|null $amount
 * @property string|null $size
 */
class Inventory extends DataLayer
{
    public function __construct()
    {
        parent::__construct("stock", ["product_id", "amount", "size"], timestamps: false);
    }

    public function increaseItemAmount($inventory_id, $amount){ // can be $product_id, $size

    }

    public function decreaseItemAmount($inventory_id, $amount){ // can be $product_id, $size

    }
}