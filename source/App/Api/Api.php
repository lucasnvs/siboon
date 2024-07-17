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
        echo json_encode($this->headers);
        $token = (string) $this->headers["Authorization"];
        $this->userAuth = (new TokenJWT)->verify($token);
    }

    protected function back (array $response, int $code = 200) : void
    {
        http_response_code($code);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    private function handleContentType () : ?string
    {
        $content_type = isset($_SERVER['CONTENT_TYPE']) ? explode(";", $_SERVER['CONTENT_TYPE'])[0] : '';

        if (!in_array($content_type, $this->ALLOWED_REQUEST_TYPES)) {
            $this->back([
                "type" => "error",
                "message" => "Os 'Content-Type' aceitos são application/json e multipart/form-data, ou você não enviou conteúdo."
            ], Code::$BAD_REQUEST);
            return null;
        }

        return $content_type;
    }

    protected function handleRequestData ($REQUIRED_FIELDS, $arrData) : ?array
    {
        $request_body = null;
        $content_type = $this->handleContentType();

        switch ($content_type) {
            case "application/json": $request_body = json_decode(file_get_contents("php://input"), true);
                break;
            case "multipart/form-data": $request_body = $arrData;
                break;
            case null: return null;
        }

        if(is_null($request_body)) {
            $this->back([
                "type" => "error",
                "message" => "O Body não pode estar nulo"],
                Code::$BAD_REQUEST);
            return null;
        }

        foreach ($REQUIRED_FIELDS as $field) {
            if(!isset($request_body[$field])){
                $this->back([
                    "type" => "error",
                    "message" => "Todos os campos devem estar presentes! Campo não enviado: $field"],
                    Code::$BAD_REQUEST);
                return null;
            }
        }
        return $request_body;
    }
}