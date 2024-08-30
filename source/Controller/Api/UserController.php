<?php

namespace Source\Controller\Api;

use InvalidArgumentException;
use PDOException;
use Source\Core\ApiController;
use Source\Core\TokenJWT;
use Source\Models\User\Address;
use Source\Models\User\User;
use Source\Support\DTO;
use Source\Support\Response\Code;
use Source\Support\Response\Response;
use Source\Support\Validator\FieldValidator;
use function Source\Support\UserDTO;

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
            $response[] = DTO::UserDTO($user);
        }

        if ($isLocalReq) return $response;

        return Response::success($response, code: Code::$OK);
    }

    public function getUser(array $data)
    {
        $user = (new User())->findById((int)$data['id']);

        if (!$user) {
            return Response::success(message: "Usuário não existe.", code: Code::$NO_CONTENT);
        }

        return Response::success(DTO::UserDTO($user), code: Code::$OK);
    }

    public function insertUser(array $data)
    {
        $FIELDS = [
            "first_name" => [FieldValidator::required],
            "last_name" => [FieldValidator::required, FieldValidator::string],
            "email" => [FieldValidator::required, FieldValidator::email],
            "password" => [FieldValidator::required, FieldValidator::password],
        ];
        $request_body = parent::validate($data, $FIELDS);

        $user = new User();

        $ALLOW_TO_SET = [
            "first_name" => "first_name",
            "last_name" => "last_name",
            "email" => "email",
            "password" => "password"
        ];
        parent::setObjectAttributes($user, $ALLOW_TO_SET, $request_body);

        $insert = $user->save();

        if (!$insert) {
            throw new PDOException($user->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(DTO::UserDTO($user), message: $user->getMessage(), code: Code::$CREATED);
    }

    public function updateUser(array $data)
    {
        $id = $data['id'];
        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $id);

        $FIELDS = [
            "first_name" => [FieldValidator::string],
            "last_name" => [FieldValidator::string],
            "email" => [FieldValidator::email],
        ];

        $ALLOW_TO_SET = [
            "first_name" => "first_name",
            "last_name" => "last_name",
            "email" => "email",
        ];

        $request_body = parent::validate($data, $FIELDS);

        $user = (new User())->findById($id);

        if(!$user){
            throw new PDOException("Usuário com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        parent::setObjectAttributes($user, $ALLOW_TO_SET, $request_body);

        if (!$user->updateUser()) {
            throw new PDOException($user->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: $user->getMessage(), code: Code::$OK);
    }

    public function deleteUser(array $data)
    {
        $id = $data['id'];
        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $id);

        $user = (new User())->findById($id);

        if (!isset($user)) {
            throw new InvalidArgumentException("Usuário com id $id não existe.", code: Code::$BAD_REQUEST);
        }

        $isDestroyed = $user->destroy();

        if (!$isDestroyed) {
            throw new PDOException($user->fail(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Usuário deletado com sucesso.", code: Code::$OK);
    }

    public function changePassword(array $data)
    {
        $FIELDS = [
            "id" => [FieldValidator::required],
            "password" => [FieldValidator::required, FieldValidator::password],
            "newPassword" => [FieldValidator::required, FieldValidator::password],
            "confirmNewPassword" => [FieldValidator::required, FieldValidator::password],
        ];
        $request_body = parent::validate($data, $FIELDS);

        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $request_body["id"]);

        $user = new User();
        $exist = $user->findById($request_body["id"]);
        if (!$exist) {
            throw new InvalidArgumentException("Usuário não existe.", code: Code::$BAD_REQUEST);
        }

        $isChanged = $exist->updatePassword($request_body["password"], $request_body["newPassword"], $request_body["confirmNewPassword"]);

        if (!$isChanged) {
            throw new InvalidArgumentException($exist->getMessage(), code: Code::$BAD_REQUEST);
        }

        return Response::success(message: "Senha alterada com sucesso.", code: Code::$OK);
    }

    public function login(array $data)
    {
        $FIELDS = [
            "email" => [FieldValidator::required],
            "password" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);

        $user = new User();
        $login = $user->login($request_body["email"], $request_body["password"]);

        if (!$login) {
            throw new InvalidArgumentException($user->getMessage(), Code::$BAD_REQUEST);
        }

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

        $EXPIRE_TIME = 24 * 60 * 60; // 24 Hours
        setcookie(CONF_AUTHORIZATION_COOKIE_NAME, "Bearer " . $signature, (time() + $EXPIRE_TIME), "/");

        return Response::success($response, message: $user->getMessage(), code: Code::$OK);
    }

    public function listUserAddresses(array $data)
    {
        $user_id = $data['user_id'];

        $params = http_build_query(["user_id" => $user_id]);
        $addresses = (new Address())->find("user_id = :user_id", $params)->fetch(true);

        if(!$addresses){
            return Response::success("Nenhum endereço cadastrado para este usuário", code: Code::$NO_CONTENT);
        }

        $response = [];
        foreach ($addresses as $address) {
            $response[] = $address->data();
        }

        return Response::success($response, message: "Endereços encontrados!", code: Code::$OK);
    }

    public function insertUserAddress(array $data)
    {
        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $data['user_id']);

        $FIELDS = [
            "cep" => [FieldValidator::required],
            "street_avenue" => [FieldValidator::required],
            "number" => [FieldValidator::required],
            "complement" => [FieldValidator::required],
            "district" => [FieldValidator::required],
            "city" => [FieldValidator::required],
            "state" => [FieldValidator::required],
        ];

        $request_body = parent::validate($data, $FIELDS);
        $address = new Address();
        $address->user_id = $data['user_id'];
        $address->setData($request_body);

        if(!$address->save()){
            throw new PDOException($address->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Endereço cadastrado para o usuário.", code: Code::$OK);
    }

    public function updateUserAddress(array $data)
    {

    }

    public function deleteUserAddress(array $data)
    {
        $user_id = $data['user_id'];
        $address_id = $data['id'];
        parent::setAccessToEndpoint($this->ACCESS_LOGGED, $user_id);

        $address = (new Address())->findById($address_id);

        if (!isset($address)) {
            throw new InvalidArgumentException("Endereço não existe.", code: Code::$BAD_REQUEST);
        }

        $isDestroyed = $address->destroy();

        if (!$isDestroyed) {
            throw new PDOException($address->fail()->getMessage(), code: Code::$INTERNAL_SERVER_ERROR);
        }

        return Response::success(message: "Endereço deletado com sucesso.", code: Code::$OK);
    }
}