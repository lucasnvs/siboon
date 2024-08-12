<?php

namespace Source\Support\Validator;

use InvalidArgumentException;
use Source\Support\Response\Code;

class FieldValidator
{

    const email = "email";
    const password = "password";
    const number = "number";
    const string = "string";
    const required = "required";

    public function validate($element, array $validator)
    {
        if(!$validator) return;
        foreach ($validator as $method) {
            if (method_exists($this, $method)) {
                $this->$method($element);
            }
        }
    }

    private function required($field)
    {
        if($field == "") {
            throw new InvalidArgumentException("Todos os campos devem estar presentes e preenchidos!", Code::$BAD_REQUEST);
        }
    }

    private function email($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email enviado é inválido.", Code::$BAD_REQUEST);
        }
    }

    private function password($password)
    {
        $regex = "/^(?=.*[0-9])(?=.*[!@#$%^&*()_+])[A-Za-z0-9!@#$%^&*()_+]{8,}$/";
        if(!preg_match($regex, $password)) {
            throw new InvalidArgumentException("Senha inválida. Deve ter pelo menos 8 caracteres, incluindo um número e um caractere especial.", Code::$BAD_REQUEST);
        }
    }

    private function number($field)
    {

    }

    private function string($field)
    {

    }

}