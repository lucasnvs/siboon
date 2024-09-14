<?php
require dirname(__FILE__, 2) . "/vendor/autoload.php";

use CoffeeCode\DataLayer\Connect;
use Source\Exceptions\AuthorizationException;

function message($message)
{
    return "<p style='padding: 6px; border: 1px solid dodgerblue; border-radius: 10px; background-color: deepskyblue;'>$message</p>";
}

function dbExist($pdo) : bool {
    try {
        $pdo->exec("USE siboon_db;");

        if($pdo->exec("SELECT * FROM users;") == 0) {
            return true;
        }

        return false;
    } catch (Exception|Error $e){
        return false;
    }
}

function initializeTestDB(array $sqlFiles): void
{
    $pdo = new PDO("mysql:host=". CONF_DB_HOST, CONF_DB_USER, CONF_DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(dbExist($pdo)) {
        echo message("Banco de dados ja existe!");
        exit();
    }

    try {
        foreach ($sqlFiles as $file) {
            $sql = file_get_contents($file);
            if(!$sql) {
                echo message("Algo deu errado... SQL de $file não foi retornado.");
                exit();
            }

            $pdo->exec($sql);
            echo message("Arquivo $file executado com sucesso!");
            echo "<br>";
        }
    } catch (PDOException $e) {
        echo message("Erro na conexão ou na execução do arquivo SQL: " . $e->getMessage());
    } catch (Error $e) {
        $instance = "$"."instance";
        if($e->getMessage() == "Typed static property CoffeeCode\DataLayer\Connect::$instance must not be accessed before initialization") {
            echo message("Erro: Banco de dados não existe!");
        }
    }
}

echo "<div style='display: flex; width: 100%; height: 100%; align-items: center; justify-content: center; flex-direction: column;'>";

if(CONF_IN_DEVELOPMENT == "true") {
    // Place the files in execution order.
    initializeTestDB(["siboon_schemas.sql", "values.sql"]);
} else {
    http_response_code(401);
    echo json_encode(["message" => "Sem autorização."], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

echo "</div>";