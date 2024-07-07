<?php

namespace Source\Core;

use PDO;
use PDOException;
use ReflectionMethod;

abstract class Model
{

    protected $entity;

    private $message;

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function selectAll (): ?array
    {
        $conn = Connect::getInstance();
        $query = "SELECT * FROM {$this->entity}";
        return $conn->query($query)->fetchAll();
    }

    public function selectById (int $id): ?array
    {
        $conn = Connect::getInstance();
        $query = "SELECT * 
                  FROM {$this->entity}
                  WHERE id = {$id}";
        return $conn->query($query)->fetchAll();
    }
    public function insert(): ?int
    {
        $values = get_object_vars($this);// pegar os valores dos atributos e inserir em um arra
        array_shift($values);
        array_shift($values);

        foreach ($values as $key => $value){
            echo "{$value} => {$key} <br>";
            $values[$key] = is_null($value) ? "NULL" : "'{$value}'";
        }

        $valuesString = implode(",", $values);

        $conn = Connect::getInstance();
        $query = "INSERT INTO {$this->entity} VALUES ({$valuesString})";

        try {
            $result = $conn->query($query);
            $this->message = "Registro inserido com sucesso!";
            return $result ? $conn->lastInsertId() : null;
        } catch (PDOException $exception) {
            $this->message = "Erro ao inserir: {$exception->getMessage()}";
            return false;
        }

    }

    public function get_attributes_array() {
        $attributes = [];

        $publicProperties = get_object_vars($this);
        foreach ($publicProperties as $key => $value) {
            if($key == "entity" || $key == "message") continue;
            $attributes[$key] = $value;
        }

        return $attributes;
    }
}