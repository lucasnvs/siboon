<?php

namespace Source\Models\Company;

use CoffeeCode\DataLayer\DataLayer;
use Source\Models\Model;

class Company extends DataLayer implements Model
{

    public function __construct()
    {
        parent::__construct("institutional", ["key", "value"], timestamps: false);
    }

    public function setData($data)
    {
        if (isset($data["key"])) {
            $this->key = $data["key"];
        }
        if (isset($data["value"])) {
            $this->value = $data["value"];
        }
    }

    public function findByKey($key) : ?DataLayer
    {
        return parent::find("`key` = :key", "key=$key")->fetch();
    }
}