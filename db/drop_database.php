<?php
require dirname(__FILE__, 2) . "/vendor/autoload.php";

try {
    $pdo = new PDO(
        "mysql:host=" . CONF_DB_HOST,
        CONF_DB_USER,
        CONF_DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

    if (CONF_IN_DEVELOPMENT == "true") {
        if (defined('CONF_DB_NAME') && !empty(CONF_DB_NAME)) {
            $pdo->exec("DROP DATABASE IF EXISTS " . CONF_DB_NAME);

            echo "Banco de dados '" . CONF_DB_NAME . "' excluído com sucesso.";
        } else {
            throw new Exception("O nome do banco de dados não está definido.");
        }
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Sem autorização."], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
