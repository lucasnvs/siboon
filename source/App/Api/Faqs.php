<?php

namespace Source\App\Api;

use Exception;
use Source\Models\Faq\Question;

class Faqs extends Api
{

    public function listFaqs(): void
    {
        $questions = new Question();
        $this->back($questions->selectAll(), Code::$OK);
    }

    public function getFaq(array $data): void
    {
        $faq = (new Question())->selectById($data['id'])[0];
        $this->back($faq, Code::$OK);
    }

    public function insertFaq(): void
    {
        $REQUIRED_FIELDS = ["idType", "question", "answer"];

        try {
            $request_body = $this->validateRequestData($REQUIRED_FIELDS);

            $newQuestion = new Question(
                idType: $request_body["idType"],
                question: $request_body["question"],
                answer: $request_body["answer"],
            );

            $isCreated = $newQuestion->insert();

            if(!$isCreated) {
                $this->back([
                    "type" => "error",
                    "message" => $newQuestion->getMessage()
                ], Code::$BAD_REQUEST);
                return;
            }

            $this->back([
                "type" => "success",
                "message" => $newQuestion->getMessage(),
                "question" => $newQuestion->get_attributes_array()
            ], Code::$CREATED);

        } catch (Exception $e) {
            if($e->getCode()) {
                $this->back([
                    "type" => "error",
                    "message" => $e->getMessage()
                ], $e->getCode());
            } else {
                $this->back([
                    "type" => "error",
                    "message" => $e->getMessage()
                ], Code::$INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function updateFaq(): void
    {

    }

    public function deleteFaq(): void
    {

    }
}