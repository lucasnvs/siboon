<?php

namespace Source\Models\Company;

use CoffeeCode\DataLayer\DataLayer;
use Source\Models\Model;

class Company extends DataLayer implements Model
{

    public function __construct()
    {
        parent::__construct("institutional", ["key_unique", "value"], timestamps: false);
    }

    public function setData($data)
    {
        if (isset($data["key_unique"])) {
            $this->key_unique = $data["key_unique"];
        }
        if (isset($data["value"])) {
            $this->value = $data["value"];
        }
    }

    public function findByKey($key) : ?DataLayer
    {
        return parent::find("`key_unique` = :key", "key=$key")->fetch();
    }
}