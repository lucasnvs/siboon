<?php

namespace Source\Models\Faq;

use CoffeeCode\DataLayer\DataLayer;
use Source\Models\Model;

class Question extends DataLayer implements Model {
    private $message;

    public function __construct()
    {
        parent::__construct("faq_questions", ["type_id", "question", "answer"], timestamps: false);
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
        if(isset($data["type_id"])) {
            $this->type_id = $data["type_id"];
        }
        if(isset($data["question"])) {
            $this->question = $data["question"];
        }
        if(isset($data["answer"])) {
            $this->answer = $data["answer"];
        }
    }
}
