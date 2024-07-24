<?php

namespace Source\Core;

use Exception;
use InvalidArgumentException;
use Source\Exceptions\AuthorizationException;
use Source\Response\Code;

class ApiController
{
    protected $userAuth = [];
    protected array $ALLOWED_REQUEST_TYPES = ["application/json", "multipart/form-data"];
    protected int $endpointAccess;
    protected $ACCESS_LOGGED = 1;
    protected $ACCESS_ADMIN = 2;
    private ?string $authorizationBearer = null;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');

        $headers = getallheaders();

        if(isset($headers["Authorization"])){
            $this->authorizationBearer = str_replace('Bearer ', '', $headers['Authorization']);
            $this->authorizationBearer = htmlspecialchars($this->authorizationBearer);
        }
    }

    public function setAccessToEndpoint(int $access, $id = null): void
    {
        $this->endpointAccess = $access;

        if($this->authorizationBearer == null) {
            throw new AuthorizationException("Authorization Bearer não foi encontrado no header da requisição.");
        }

        $this->checkBearerIsValid();
        $this->checkPermissionBearer($id);
    }

    private function checkBearerIsValid()
    {
        $JWT = new TokenJWT();
        $tokenIsValid = $JWT->verify($this->authorizationBearer);

        if(!$tokenIsValid){
            throw new AuthorizationException("Bearer token não é válido.", code: Code::$UNAUTHORIZED);
        }

        $this->userAuth = $JWT->token->data;
    }

    private function checkPermissionBearer($id)
    {
        $JWT = new TokenJWT();
        $decode = $JWT->decode($this->authorizationBearer);

        if (!is_numeric($decode->access) OR $decode->access < $this->endpointAccess) {
            throw new AuthorizationException("Sem permissão para esse endpoint.", code: Code::$UNAUTHORIZED);
        }

        if(isset($id)) {
            if($decode->id != $id){
                throw new AuthorizationException("Sem permissão para esse endpoint.", code: Code::$UNAUTHORIZED);
            }
        }
    }

    protected function back (array $response, int $code = 200) : void
    {
        http_response_code($code);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    private function validateContentType () : string
    {
        if(empty($_SERVER['CONTENT_LENGTH'])) {
            throw new InvalidArgumentException("Você deve enviar conteúdo.", Code::$BAD_REQUEST);
        }

        $content_type = isset($_SERVER['CONTENT_TYPE']) ? explode(";", $_SERVER['CONTENT_TYPE'])[0] : '';

        if (!in_array($content_type, $this->ALLOWED_REQUEST_TYPES)) {
            throw new InvalidArgumentException("Os 'Content-Type' aceitos são application/json e multipart/form-data.", Code::$BAD_REQUEST);
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