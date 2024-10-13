<?php

namespace Source\Models\Website;

use CoffeeCode\DataLayer\DataLayer;

class FeaturedItem extends DataLayer
{
    public function __construct()
    {
        parent::__construct("featured_items", ["section_id", "product_id", "display_order"]);
    }
}