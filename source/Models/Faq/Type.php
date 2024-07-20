<?php

namespace Source\Models\Faq;
use CoffeeCode\DataLayer\DataLayer;

class Type extends DataLayer {
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
}
