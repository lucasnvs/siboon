<?php

namespace Source\App\Api;

use Exception;
use Source\Core\TokenJWT;
use Source\Models\User;

class Users extends Api
{
    // todo: separar funcao de autorizacao e Exception Return
    public function listUsers()
    {
        $user = new User();
        $users = $user->find()->fetch(true);

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                "id" => $user->data()->id,
                "name" => $user->data()->name,
                "email" => $user->data()->email,
                "role" => $user->data()->role
            ];
        }

        $this->back($response, Code::$OK);
    }

    public function getUser(array $data)
    {
        $user = (new User())->findById($data['id']);

        if (!$user) {
            $this->back([
                "type" => "success",
                "message" => "Usuário não existe."
            ], Code::$NOT_FOUND);
            return;
        }

        $this->back([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
        ], Code::$OK);
    }

    public function insertUser(array $data)
    {
        $REQUIRED_FIELDS = ["name", "email", "password"];

        try {
            $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

            $user = new User();
            $user->name = $request_body["name"];
            $user->email = $request_body["email"];
            $user->password = $request_body["password"];

            $insert = $user->save();

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
                    "name" => $user->name,
                    "email" => $user->email
                ]
            ], Code::$CREATED);
        } catch (Exception $e) {
            if($e->getCode() && gettype($e->getCode()) == "integer") {
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

    public function updateUser(array $data)
    {
        $id = $data['id'];
        // Campos Aceitos: "name", "email"
        try {
            $request_body = $this->validateRequestData($data);

            if(!$this->userAuth){
                $this->back([
                    "type" => "error",
                    "message" => "Você não tem permissão."
                ], Code::$UNAUTHORIZED);
                return;
            }

            if($this->userAuth->id != $id){
                $this->back([
                    "type" => "error",
                    "message" => "Você não tem permissão."
                ], Code::$UNAUTHORIZED);
                return;
            }

            $user = (new User())->findById($id);

            if(isset($request_body["name"])){
                $user->name = $request_body["name"];
            }
            if(isset($request_body["email"])){
                var_dump("Existe email");
                $user->email = $request_body["email"];
            }

            if(!$user->updateUser()) {
                $this->back([
                    "type" => "error",
                    "message" => $user->getMessage()
                ], Code::$BAD_REQUEST);
                return;
            }

            $this->back([
                "type" => "success",
                "message" => $user->getMessage()
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

    public function deleteUser(array $data)
    {
        $id = $data['id'];

        if(!$this->userAuth){
            $this->back([
                "type" => "error",
                "message" => "Você não tem permissão."
            ], Code::$UNAUTHORIZED);
            return;
        }

        if($this->userAuth->id != $id){
            $this->back([
                "type" => "error",
                "message" => "Você não tem permissão."
            ], Code::$UNAUTHORIZED);
            return;
        }

        $user = new User();
        $isDestroyed = $user->findById($id)->destroy();
        if(!$isDestroyed){
            $this->back([
                "type" => "error",
                "message" => $user->fail()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Usuário deletado com sucesso!",
        ], Code::$OK);
    }

    public function changePassword(array $data)
    {
        $REQUIRED_FIELDS = ["id", "password", "newPassword", "confirmNewPassword"];

        try {
            $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

            if(!$this->userAuth){
                $this->back([
                    "type" => "error",
                    "message" => "Você não tem permissão."
                ], Code::$UNAUTHORIZED);
                return;
            }

            if($this->userAuth->id != $request_body["id"]){
                $this->back([
                    "type" => "error",
                    "message" => "Você não tem permissão."
                ], Code::$UNAUTHORIZED);
                return;
            }

            $user = new User();
            $exist = $user->findById($request_body["id"]);
            if(!$exist) {
                $this->back([
                    "type" => "error",
                    "message" => "Usuário não existe."
                ], Code::$NO_CONTENT);
                return;
            }

            $isChanged = $exist->updatePassword($request_body["password"], $request_body["newPassword"], $request_body["confirmNewPassword"]);
            if(!$isChanged){
                $this->back([
                    "type" => "error",
                    "message" => $exist->getMessage(),
                ], Code::$INTERNAL_SERVER_ERROR);
                return;
            }

            $this->back([
                "type" => "success",
                "message" => $exist->getMessage()
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

    public function login (array $data)
    {
        $REQUIRED_FIELDS = ["email", "password"];

        try {
            $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);
            var_dump($data);

            $user = new User();
            $login = $user->login($request_body["email"], $request_body["password"]);

            if(!$login){
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
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "token" => $token->create([
                        "id" => $user->id,
                        "name" => $user->name,
                        "email" => $user->email
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