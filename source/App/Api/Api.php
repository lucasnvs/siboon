<?php

namespace Source\App\Api;

use Exception;
use Source\Core\TokenJWT;

class Api
{
    protected array|false $headers;
    protected \stdClass|bool $userAuth;
    protected array $ALLOWED_REQUEST_TYPES = ["application/json", "multipart/form-data"];

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $this->headers = getallheaders();
        $token = (string) $this->headers["Authorization"];
        $this->userAuth = (new TokenJWT)->verify($token);
    }

    protected function back (array $response, int $code = 200) : void
    {
        http_response_code($code);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @throws Exception
     */
    private function validateContentType () : void
    {
        if(empty($_SERVER['CONTENT_LENGTH'])) {
            throw new Exception("Você deve enviar conteúdo.", Code::$BAD_REQUEST);
        }

        $content_type = isset($_SERVER['CONTENT_TYPE']) ? explode(";", $_SERVER['CONTENT_TYPE'])[0] : '';

        if (!in_array($content_type, $this->ALLOWED_REQUEST_TYPES)) {
            throw new Exception("Os 'Content-Type' aceitos são application/json e multipart/form-data.", Code::$BAD_REQUEST);
        }
    }

    /**
     * @throws Exception
     */
    protected function validateRequestData ($REQUIRED_FIELDS) : array | null
    {
        $this->validateContentType();
        $request_body = (array) json_decode(file_get_contents('php://input', true));

        if(sizeof($request_body) == 0) {
            throw new Exception("Body sem campos.", Code::$BAD_REQUEST);
        }

        foreach ($REQUIRED_FIELDS as $field) {
            if(!isset($request_body[$field])){
                throw new Exception("Todos os campos devem estar presentes! Campo não enviado: $field", Code::$BAD_REQUEST);
            }
        }

        return $request_body;
    }
}