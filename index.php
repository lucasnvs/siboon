<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Controller\Api\ErrorController;

$route = new Router(url(), ":");

try {
    ob_start();

    $route->namespace("Source\Controller");

    $route->group(null);

    // Guest
    $route->get("/", "WebController:home");
    $route->get("/contato", "WebController:contact");
    $route->get("/entrar", "WebController:login");
    $route->get("/sobre", "WebController:about");
    $route->get("/faq", "WebController:faq");
    $route->get("/secao", "WebController:section"); // rota template
    $route->get("/ops/{errcode}", "WebController:error");

    $route->group("produto");
    $route->get("/{name}", "WebController:product"); // rota template

    $route->group(null);
    // Logged
    $route->get("/perfil", "WebController:profile"); // rota de user logado

    // Admin
    $route->group("admin");
    $route->get("/login", function () {
        echo "Login de Admin";
    });
    $route->get("/", "AdminController:home");
    $route->get("/produtos", "AdminController:product");
    $route->get("/produtos/registrar", "AdminController:productRegister");

    $route->group(null);

    $route->dispatch();

    if ($route->error()) {
        $route->redirect("/ops/{$route->error()}");
    }

    ob_end_flush();
} catch (Exception $e) {
    if(ErrorController::getExceptionName($e) == "authorization") {
        $route->redirect("/entrar");
    }

    return ErrorController::getErrorMessage($e);
}