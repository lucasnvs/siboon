<?php
namespace Source\Support;
use Dotenv\Dotenv;

/**
 * Environment (.env) access class.
 */
abstract class Env {

    /**
     * Get value from .env key.
     *
     * @param string $name
     * @return array|false|string
     */
    public static function get(string $name)
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
        $dotenv->load();

        return getenv($name);
    }
}