<?php

namespace Source\App\Api;

use Exception;
use Source\Core\TokenJWT;
use Source\Models\User;

class Users extends Api
{

    public function listUsers()
    {
        $data = (new User())->selectAll();
        $this->back($data, Code::$OK);
    }

    public function getUser(array $data)
    {
        $user = (new User())->selectById($data['id'])[0];

        $this->back([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
        ], Code::$OK);
    }

    public function insertUser()
    {
        $REQUIRED_FIELDS = ["name", "email", "password"];

        try {
            $request_body = $this->validateRequestData($REQUIRED_FIELDS);

            $user = new User(
                NULL,
                $request_body["name"],
                $request_body["email"],
                $request_body["password"]
            );

            $insert = $user->insert();

            if(!$insert){
                $this->back([
                    "type" => "error",
                    "message" => $user->getMessage()
                ], Code::$BAD_REQUEST);
                return;
            }

            $this->back([
                "type" => "success",
                "message" => $user->getMessage(),
                "user" => [
                    "id" => $insert,
                    "name" => $user->getName(),
                    "email" => $user->getEmail()
                ], Code::$CREATED
            ]);
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

    public function updateUser()
    {
        $REQUIRED_FIELDS = ["id", "name", "email"];
        try {
            $request_body = $this->validateRequestData($REQUIRED_FIELDS);

            if(!$this->userAuth){
                $this->back([
                    "type" => "error",
                    "message" => "Você não tem permissão."
                ], Code::$UNAUTHORIZED);
                return;
            }

            $this->back([], Code::$OK);

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

    public function deleteUser()
    {

    }

    public function changePassword()
    {
        $REQUIRED_FIELDS = ["password", "newPassword", "confirmNewPassword"];

        try {
            $request_body = $this->validateRequestData($REQUIRED_FIELDS);
            $user = new User($this->userAuth->id);

            if(!$user->updatePassword($request_body["password"], $request_body["newPassword"], $request_body["confirmNewPassword"])){
                $this->back([
                    "type" => "error",
                    "message" => $user->getMessage()
                ]);
                return;
            }

            $this->back([
                "type" => "success",
                "message" => $user->getMessage()
            ]);

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

    public function login ()
    {
        $REQUIRED_FIELDS = ["email", "password"];

        try {
            $request_body = $this->validateRequestData($REQUIRED_FIELDS);

            $user = new User();

            if(!$user->login($request_body["email"],$request_body["password"])){
                $this->back([
                    "type" => "error",
                    "message" => $user->getMessage()
                ]);
                return;
            }

            $token = new TokenJWT();
            $this->back([
                "type" => "success",
                "message" => $user->getMessage(),
                "user" => [
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail(),
                    "token" => $token->create([
                        "id" => $user->getId(),
                        "name" => $user->getName(),
                        "email" => $user->getEmail()
                    ])
                ]
            ], Code::$OK);
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
}