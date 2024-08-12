<?php

namespace Source\Controller\Api;

use Source\Core\ApiController;
use Source\Models\Faq\Question;
use Source\Models\Faq\Type;
use Source\Support\Response\Code;
use Source\Support\Response\Response;

class FaqController extends ApiController
{

    public function listFaqs()
    {
        $response = [];

        $type = new Type();
        $questions = new Question();

        $types = $type->find()->fetch(true);

        foreach ($types as $type) {
            $params = http_build_query(["type_id" => $type->id]);
            $obj["type"] = $type->description;
            $finded = (array) $questions->find("type_id = :type_id", $params)->fetch(true);
            foreach ($finded as $q) {
                $obj["data"][] = ["question" => $q->question, "answer" => $q->answer];
            }

            $response[] = $obj;
        }

        return Response::success($response, code: Code::$OK);
    }
}