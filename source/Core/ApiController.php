<?php

namespace Source\Core;

use CoffeeCode\DataLayer\DataLayer;
use InvalidArgumentException;
use Source\Support\Response\Code;
use Source\Support\Validator\FieldValidator;

/**
 * Base from any API controller with request validation.
 */
abstract class ApiController extends Controller
{
    protected array $ALLOWED_REQUEST_TYPES = ["application/json", "multipart/form-data"];

    private function validateContentType () : string
    {
        if(empty($_SERVER['CONTENT_LENGTH'])) {
            throw new InvalidArgumentException("Você deve enviar conteúdo.", Code::$BAD_REQUEST);
        }

        $content_type = isset($_SERVER['CONTENT_TYPE']) ? explode(";", $_SERVER['CONTENT_TYPE'])[0] : '';

        if (!in_array($content_type, $this->ALLOWED_REQUEST_TYPES)) {
            throw new InvalidArgumentException("Os 'Content-Type' aceitos são application/json e multipart/form-data. $content_type é inválido.", Code::$BAD_REQUEST);
        }

        return $content_type;
    }

    protected function validate($data, ?array $FIELDS = null) : array
    {
        $content_type = $this->validateContentType();

        $request_body = [];
        switch ($content_type) {
            case "application/json": $request_body = json_decode(file_get_contents('php://input', false, null, 0, $_SERVER['CONTENT_LENGTH']), true);
                break;
            case "multipart/form-data": $request_body = $data;
        }

        if (empty($request_body)) {throw new InvalidArgumentException("Conteúdo vazio.", Code::$BAD_REQUEST);}

        if (!isset($FIELDS)) return $request_body;

        foreach ($FIELDS as $key => $validators) {
            if(isset($request_body[$key])) {
                (new FieldValidator())->validate($request_body[$key], $validators);
            } else {
                if(in_array(FieldValidator::required, $validators)) {
                    throw new InvalidArgumentException("Todos os campos obrigatórios devem estar presentes e preenchidos!", Code::$BAD_REQUEST);
                }
            }
        }

        return $request_body;
    }

    public function setObjectAttributes($object, $ALLOW_TO_SET, $body) : DataLayer
    {
        foreach ($ALLOW_TO_SET as $field => $attribute) {
            if(isset($body[$field])) {
                $object->__set($attribute, $body[$field]);
            }
        }
        return $object;
    }
}