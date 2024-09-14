<?php

namespace Source\Models\Faq;
use CoffeeCode\DataLayer\DataLayer;
use Source\Models\Model;

class Type extends DataLayer implements Model {
    private $message;

    public function __construct()
    {
        parent::__construct("faq_types", []);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function setData($data)
    {
        if (isset($data["description"])) {
            $this->description = $data["description"];
        }
    }
}
