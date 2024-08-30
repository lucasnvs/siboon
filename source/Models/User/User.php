<?php

namespace Source\Models\User;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

class User extends DataLayer {

    private $message;

    public function __construct() {
        parent::__construct("users", ["first_name", "last_name", "email", "password"], timestamps: false);
    }

    /**
     * @return bool
     */
    #[\Override]
    public function save(): bool
    {

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->message = "E-mail inválido!";
            return false;
        }

        $params = http_build_query(["email" => $this->email]);
        $email = $this->find("email = :email", $params);
        $email->fetch();
        if($email->count() == 1) {
            $this->message = "E-mail já cadastrado!";
            return false;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        try {
            $lastId = parent::save();
            if(!$lastId){
                $this->message = $this->fail;
                return false;
            }
            $this->message = "Usuário cadastrado com sucesso!";
            return $lastId;

        } catch (PDOException) {
            $this->message = "Por favor, informe todos os campos!";
            return false;
        }
    }

    /**
     * @return bool
     */
    public function updateUser () : bool
    {

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->message = "E-mail inválido!";
            return false;
        }

        $params = http_build_query(["email" => $this->email, "id" => $this->id]);
        $email = $this->find("email = :email AND id != :id", $params);
        $email->fetch();

        if($email->count() == 1) {
            $this->message = "E-mail já cadastrado!";
            return false;
        }

        try {
            if(!parent::save()) {
                $this->message = $this->fail;
                return false;
            }
            $this->message = "Usuário atualizado com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: {$exception->getMessage()}";
            return false;
        }

    }

    /**
     * @param string $email
     * @param string $password
     * @return bool|User
     */
    public function login(string $email, string $password): bool|User
    {
        $params = http_build_query(["email" => $email]);
        $user = (new User)->find("email = :email", $params)->fetch();

        if (!$user) {
            $this->message = "E-mail não cadastrado!";
            return false;
        }

        if (!password_verify($password, $user->password)) {
            $this->message = "Senha incorreta!";
            return false;
        }

        $this->message = "Usuário logado com sucesso!";

        $this->id = $user->id;
        $this->first_name = $user->first_name;
        $this->email = $user->email;
        $this->role = $user->role;

        return true;
    }

    /**
     * @param string $password
     * @param string $newPassword
     * @param string $confirmNewPassword
     * @return bool
     */
    public function updatePassword (string $password, string $newPassword, string $confirmNewPassword) : bool
    {
        $params = http_build_query(["id" => $this->id]);
        $user = $this->find("id = :id", $params)->fetch();

        if (!password_verify($password, $user->password)) {
            $this->message = "Senha incorreta!";
            return false;
        }

        if ($newPassword != $confirmNewPassword) {
            $this->message = "As senhas não conferem!";
            return false;
        }

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $this->password = $newPassword;

        try {
            if(!parent::save()) {
                $this->message = $this->fail;
                return false;
            }
            $this->message = "Senha atualizada com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: {$exception->getMessage()}";
            return false;
        }

    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

}