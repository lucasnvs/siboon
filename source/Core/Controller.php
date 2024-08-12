<?php

namespace Source\Core;

use Source\Exceptions\AuthorizationException;
use Source\Support\Response\Code;

abstract class Controller
{
    protected $userAuth = [];
    protected int $endpointAccess;
    protected $ACCESS_LOGGED = 1;
    protected $ACCESS_ADMIN = 2;
    private ?string $authorizationBearer = null;

    public function __construct()
    {
        $headers = getallheaders();

        if (isset($_COOKIE[CONF_AUTHORIZATION_COOKIE_NAME])) {
            $this->authorizationBearer = str_replace('Bearer ', '', $_COOKIE[CONF_AUTHORIZATION_COOKIE_NAME]);
            $this->authorizationBearer = htmlspecialchars($this->authorizationBearer);
        }

        if(isset($headers["Authorization"])){
            $this->authorizationBearer = str_replace('Bearer ', '', $headers['Authorization']);
            $this->authorizationBearer = htmlspecialchars($this->authorizationBearer);
        }
    }

    public function setAccessToEndpoint(int $access, $id = null): void
    {
        $this->endpointAccess = $access;

        if($this->authorizationBearer == null) {
            throw new AuthorizationException("Authorization Bearer não foi encontrado na requisição.");
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
            throw new AuthorizationException("Sem permissão para esse endpoint. $decode->access", code: Code::$UNAUTHORIZED);
        }

        if(isset($id) && $decode->access < $this->ACCESS_ADMIN) {
            if($decode->id != $id){
                throw new AuthorizationException("Sem permissão para esse endpoint.", code: Code::$UNAUTHORIZED);
            }
        }
    }
}