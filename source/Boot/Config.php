<?php

use Source\Helpers\Env;

# JWT
define("JWT_SECRET_KEY", Env::get("JWT_SECRET_KEY"));

# DB
define("CONF_DB_HOST", Env::get("DB_HOST"));
define("CONF_DB_USER", Env::get("DB_USER"));
define("CONF_DB_PASS", Env::get("DB_PASS"));
define("CONF_DB_NAME", Env::get("DB_NAME"));
define("CONF_DB_PORT", Env::get("DB_PORT"));

# URL
define("CONF_URL_TEST", Env::get("URL_TEST"));
define("CONF_URL_BASE", Env::get("URL_BASE"));

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => CONF_DB_HOST,
    "port" => CONF_DB_PORT,
    "dbname" => CONF_DB_NAME,
    "username" => CONF_DB_USER,
    "passwd" => CONF_DB_PASS,
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];