<?php

namespace Source\Core;

use InvalidArgumentException;
use Source\Response\Code;

class ApiController extends Controller
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

    protected function validateRequestData ($data, ?array $REQUIRED_FIELDS = null) : array | null
    {
        $content_type = $this->validateContentType();

        $request_body = [];
        switch ($content_type) {
            case "application/json": $request_body = json_decode(file_get_contents('php://input', false, null, 0, $_SERVER['CONTENT_LENGTH']), true);
                break;
            case "multipart/form-data": $request_body = $data;
        }

        if(sizeof($request_body) == 0) {
            throw new InvalidArgumentException("Body sem campos.", Code::$BAD_REQUEST);
        }

        if(isset($REQUIRED_FIELDS)) {
            foreach ($REQUIRED_FIELDS as $field) {
                if(!$request_body[$field] || $request_body[$field] == "") {
                    throw new InvalidArgumentException("Todos os campos devem estar presentes e preenchidos! Campo não enviado: $field", Code::$BAD_REQUEST);
                }
            }
        }

        return $request_body;
    }
}