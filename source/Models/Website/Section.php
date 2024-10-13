<?php

namespace Source\Models\Website;

use CoffeeCode\DataLayer\DataLayer;

class Section extends DataLayer
{
    public function __construct()
    {
        parent::__construct("sections", ["name"]);
    }
}