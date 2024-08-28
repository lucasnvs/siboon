<?php

namespace Source\Controller\Api;

use InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Models\Faq\Question;
use Source\Models\Faq\Type;
use Source\Support\DTO;
use Source\Support\Response\Code;
use Source\Support\Response\Response;
use Source\Support\Validator\FieldValidator;

class FaqController extends ApiController
{
    public function listFaqs()
    {
        $response = [];

        $questionModel = new Question();

        $questions = $questionModel->find()->fetch(true);

        foreach ($questions as $question) {
            $response[] = DTO::FaqDTO($question);
        }

        return Response::success($response, code: Code::$OK);
    }

    public function getFaq(array $data)
    {
        $id = $data['id'];
        $question = (new Question())->findById($id);

        if (!$question) {
            return Response::success(message: "Questão não existe.", code: Code::$NO_CONTENT);
        }

        return Response::success(
            DTO::FaqDTO($question),
            code: Code::$OK
        );
    }

    public function insertFaq(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $FIELDS = [
            "type_id" => [FieldValidator::required],
            "question" => [FieldValidator::required],
            "answer" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);

        $question = new Question();
        $question->setData($request_body);

        $isCreated = $question->save();

        if (!$isCreated) throw new PDOException($question->fail()->getMessage(), Code::$BAD_REQUEST);

        return Response::success(message: "Questão criada com sucesso.", code: Code::$CREATED);
    }

    public function updateFaq(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
        $request_body = parent::validate($data);

        $id = $data['id'];
        $question = (new Question())->findById($id);

        if(!$question) {
            throw new InvalidArgumentException("Questão com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $question->setData($request_body);

        if (!$question->save()) {
            throw new PDOException($question->fail()->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: "Questão atualizada com sucesso.", code: Code::$OK);
    }

    public function deleteFaq(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
        $id = $data['id'];

        $question = (new Question())->findById($id);

        if(!$question) {
            throw new InvalidArgumentException("Questão com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $isDestroyed = $question->destroy();

        if (!$isDestroyed) {
            throw new PDOException($question->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Questão deletada com sucesso.", code: Code::$OK);
    }

    public function listTopics(array $data)
    {
        $response = [];

        $topicModel = new Type();
        $topics = $topicModel->find()->fetch(true);

        foreach ($topics as $topic) {
            $response[] = $topic->data();
        }

        return Response::success($response, code: Code::$OK);
    }

    public function getTopic(array $data)
    {
        $topic = (new Type())->findById($data['id']);

        if (!$topic) {
            return Response::success(message: "Tópico não existe.", code: Code::$NO_CONTENT);
        };

        return Response::success(
            $topic->data(),
            code: Code::$OK
        );
    }

    public function insertTopic(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $FIELDS = [
            "description" => [FieldValidator::required],
        ];
        $request_body = parent::validate($data, $FIELDS);

        $topic = new Type();
        $topic->setData($request_body);

        $isCreated = $topic->save();

        if (!$isCreated) throw new PDOException($topic->fail()->getMessage(), Code::$BAD_REQUEST);

        return Response::success(message: "Tópico criado com sucesso.", code: Code::$CREATED);
    }

    public function updateTopic(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);

        $FIELDS = [
            "description" => [FieldValidator::required]
        ];
        $request_body = parent::validate($data, $FIELDS);

        $id = $data['id'];
        $topic = (new Type())->findById($id);

        if(!$topic) {
            throw new InvalidArgumentException("Tópico com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $topic->setData($request_body);

        if (!$topic->save()) {
            throw new PDOException($topic->fail()->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: "Tópico atualizado com sucesso.", code: Code::$OK);
    }

    public function deleteTopic(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_ADMIN);
        $id = $data['id'];

        $topic = (new Type())->findById($id);

        if(!$topic) {
            throw new InvalidArgumentException("Tópico com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $isDestroyed = $topic->destroy();

        if (!$isDestroyed) {
            throw new PDOException($topic->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Tópico deletado com sucesso.", code: Code::$OK);
    }
}