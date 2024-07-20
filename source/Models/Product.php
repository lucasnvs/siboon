<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer {
    protected $id;
    protected $name;
    protected $description;
    protected $color;
    protected $size;
    protected $price_brl;
    protected $res_path;

    private $message;

    public function __construct()
    {
        //string "TABLE_NAME", array ["REQUIRED_FIELD_1", "REQUIRED_FIELD_2"], string "PRIMARY_KEY", bool "TIMESTAMPS"
        parent::__construct("products", []);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}