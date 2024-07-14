<?php

namespace Source\App\Api;

use Source\Core\TokenJWT;
use Source\Models\User;

class Users extends Api
{
    public function insertUser(array $data) {
        var_dump($data);

        $user = new User(
            NULL,
            $data["name"],
            $data["email"],
            $data["password"]
        );

        $insert = $user->insert();

        if(!$insert){
            $this->back([
                "type" => "error",
                "message" => $user->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => $user->getMessage(),
            "user" => [
                "id" => $insert,
                "name" => $user->getName(),
                "email" => $user->getEmail()
            ]
        ]);
    }

    public function updateUser(array $data){

    }

    public function login (array $data) {
        $user = new User();

        if(!$user->login($data["email"],$data["password"])){
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
        ]);

    }
}