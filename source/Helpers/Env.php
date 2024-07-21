<?php
namespace Source\Helpers;
use Dotenv\Dotenv;

abstract class Env {

    public static function get(string $name)
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
        $dotenv->load();

        return getenv($name);
    }
}