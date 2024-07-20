<?php
const CONF_DB_HOST = "localhost";
const CONF_DB_USER = "root";
const CONF_DB_PASS = "";
const CONF_DB_NAME = "siboon_db"; // db-inf-3at
const CONF_URL_TEST = "http://localhost/siboon";
const CONF_URL_BASE = "http://localhost/siboon";

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => CONF_DB_HOST,
    "port" => "3306",
    "dbname" => CONF_DB_NAME,
    "username" => CONF_DB_USER,
    "passwd" => CONF_DB_PASS,
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);