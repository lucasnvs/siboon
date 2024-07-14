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

    public function insertUser(array $data)
    {
        $REQUIRED_FIELDS = ["name", "email", "password"];
        $request_body = $this->handleRequestData($REQUIRED_FIELDS, $data);
        if(is_null($request_body)) return;

        try {
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
            $this->back([
                "type" => "error",
                "message" => $e->getMessage()
            ], Code::$INTERNAL_SERVER_ERROR);
        }
    }

    public function updateUser(array $data){

    }

    public function login (array $data) {
        $REQUIRED_FIELDS = ["email", "password"];
        $request_body = $this->handleRequestData($REQUIRED_FIELDS, $data);
        if(is_null($request_body)) return;

        try {
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
            $this->back(['error' => $e->getMessage()], Code::$INTERNAL_SERVER_ERROR);
        }
    }
}