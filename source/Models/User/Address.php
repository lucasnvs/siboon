<?php

namespace Source\Models\User;

use CoffeeCode\DataLayer\DataLayer;


/**
 * @property $cep
 * @property $street_avenue
 * @property $number
 * @property $complement
 * @property $district
 * @property $city
 * @property $state
 */
class Address extends DataLayer
{
    public function __construct()
    {
        parent::__construct("user_address", ["user_id", "cep", "street_avenue", "number", "complement", "district", "city", "state"], timestamps: false);
    }

    public function user()
    {
        $this->user = (new User())->findById($this->user_id)->data();
        return $this;
    }

    public function setData($data)
    {
        if(isset($data["cep"])){
            $this->cep = $data["cep"];
        }
        if(isset($data["street_avenue"])){
            $this->street_avenue = $data["street_avenue"];
        }
        if(isset($data["number"])){
            $this->number = $data["number"];
        }
        if(isset($data["complement"])){
            $this->complement = $data["complement"];
        }
        if(isset($data["district"])){
            $this->district = $data["district"];
        }
        if(isset($data["city"])){
            $this->city = $data["city"];
        }
        if(isset($data["state"])){
            $this->state = $data["state"];
        }
    }
}