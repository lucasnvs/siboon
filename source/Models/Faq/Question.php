<?php

namespace Source\Models\Faq;

use CoffeeCode\DataLayer\DataLayer;

class Question extends DataLayer {
    private $message;

    public function __construct()
    {
        parent::__construct("faq_questions", []);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}
