<?php

namespace Source\Models\Order;

use CoffeeCode\DataLayer\DataLayer;
use Source\Models\Model;

class Order extends DataLayer implements Model {
    const SHIPMENT_STATUS_SENT = "SENT";
    const PAYMENT_STATUS_PAID = "PAID";
    const STATUS_PENDING = "PENDING";

    private $message;

    public function __construct()
    {
        parent::__construct("orders", ["user_id", "address_id", "total_price"]);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setData($data)
    {
        if(isset($data["costumer_id"])) $this->user_id = $data["costumer_id"];
        if(isset($data["address_id"])) $this->address_id = $data["address_id"];
        if(isset($data["total_price"])) $this->total_price = $data["total_price"];
    }
}