<?php

namespace Source\Controller\Api;

use InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Core\TokenJWT;
use Source\Models\User;
use Source\Response\Code;
use Source\Response\Response;

class UserController extends ApiController
{
    public function listUsers(array $data = null, $isLocalReq = false)
    {
        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

        $user = new User();
        $users = $user->find()->fetch(true);

        if (!$users) {
            return Response::success(message: "Nenhum usuário encontrado.", code: Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                "id" => $user->id,
                "name" => $user->first_name." ".$user->last_name,
                "email" => $user->email,
                "role" => $user->role
            ];
        }

        if ($isLocalReq) return $response;

        return Response::success($response, code: Code::$OK);
    }

    public function getUser(array $data, $isLocalReq = false)
    {

        $user = (new User())->findById($data['id']);

        if (!$user) {
            return Response::success(message: "Usuário não existe.", code: Code::$NO_CONTENT);
        }

        $response = [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role" => $user->role,
        ];

        if ($isLocalReq) return $response;

        return Response::success($response, Code::$OK);
    }

    public function insertUser(array $data)
    {
        $REQUIRED_FIELDS = ["first_name", "last_name", "email", "password"];

        $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

        $user = new User();
        $user->first_name = $request_body["first_name"];
        $user->last_name = $request_body["last_name"];
        $user->email = $request_body["email"];
        $user->password = $request_body["password"];

        $insert = $user->save();

        if (!$insert) {
            throw new PDOException($user->getMessage(), code: Code::$BAD_REQUEST);
        }

        $response = [
            "user" => [
                "id" => $insert,
                "name" => $user->first_name . " " . $user->last_name,
                "email" => $user->email
            ]
        ];

        return Response::success($response, message: $user->getMessage(), code: Code::$CREATED);
    }

    public function updateUser(array $data)
    {
        $id = $data['id'];
        $request_body = $this->validateRequestData($data); // Campos Aceitos: "name", "email"

        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $id);

        $user = (new User())->findById($id);

        if (isset($request_body["name"])) {
            $user->name = $request_body["name"];
        }
        if (isset($request_body["email"])) {
            $user->email = $request_body["email"];
        }

        if (!$user->updateUser()) {
            throw new PDOException($user->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: $user->getMessage(), code: Code::$OK);
    }

    public function deleteUser(array $data)
    {
        $id = $data['id'];

        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $id);

        $user = new User();
        $isDestroyed = $user->findById($id)->destroy();
        if (!$isDestroyed) {
            throw new PDOException($user->fail(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Usuário deletado com sucesso.", code: Code::$OK);
    }

    public function changePassword(array $data)
    {
        $REQUIRED_FIELDS = ["id", "password", "newPassword", "confirmNewPassword"];

        $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $request_body["id"]);

        $user = new User();
        $exist = $user->findById($request_body["id"]);
        if (!$exist) {
            throw new PDOException("Usuário não existe.", code: Code::$BAD_REQUEST);
        }

        $isChanged = $exist->updatePassword($request_body["password"], $request_body["newPassword"], $request_body["confirmNewPassword"]);

        if (!$isChanged) {
            throw new InvalidArgumentException($exist->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: "Senha alterada com sucesso.", code: Code::$OK);
    }

    public function login(array $data)
    {
        $REQUIRED_FIELDS = ["email", "password"];

        $request_body = $this->validateRequestData($data, $REQUIRED_FIELDS);

        $user = new User();
        $login = $user->login($request_body["email"], $request_body["password"]);

        if (!$login) {
            throw new InvalidArgumentException($user->getMessage(), Code::$BAD_REQUEST);
        }

        $access = 0;
        match ($user->role) {
            "CLIENT" => $access = $this->ACCESS_LOGGED,
            "ADMIN" => $access = $this->ACCESS_ADMIN,
        };

        $token = new TokenJWT();

        $signature = $token->create([
            "id" => $user->id,
            "name" => $user->first_name,
            "email" => $user->email,
            "role" => $user->role,
            "access" => $access
        ]);

        $response = [
            "id" => $user->id,
            "name" => $user->first_name,
            "email" => $user->email,
            "token" => $signature
        ];

        setcookie("AUTHORIZATION", "Bearer ".$signature, (time() + (24*60*60)), "/");

        return Response::success($response, message: $user->getMessage(), code: Code::$OK);
    }
}