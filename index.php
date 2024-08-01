<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Controller\Api\ErrorController;

$route = new Router(url(), ":");

try {
    ob_start();

    $route->namespace("Source\Controller");

    /*
     * WEB - GUEST
     */
    $route->group(null);
    $route->get("/", "WebController:home");
    $route->get("/contato", "WebController:contact");
    $route->get("/entrar", "WebController:login");
    $route->get("/sobre", "WebController:about");
    $route->get("/faq", "WebController:faq");
    $route->get("/secao", "WebController:section"); // rota template
    $route->get("/ops/{errcode}", "WebController:error");

    $route->group("produto");
    $route->get("/{name}", "WebController:product"); // rota template

    /*
     * APP - LOGGED
     */
    $route->group("app");
    $route->get("/perfil", "AppController:profile");

    /*
     * ADMIN
     */
    $route->group("admin");
    $route->get("/login", function () {echo "Login de Admin";});
    $route->get("/", "AdminController:home");
    $route->get("/vendas", function () {echo "Vendas";});
    $route->get("/website", function () {echo "Website";});
    $route->get("/faq", function () {echo "Faq";});
    $route->get("/institucional", function () {echo "Institucional";});
    $route->get("/configuracoes", function () {echo "Configurações";});

    $route->get("/clientes", "AdminController:client");

    $route->group("admin/produtos");
    $route->get("/", "AdminController:product");
    $route->get("/registrar", "AdminController:productRegister");
    $route->get("/{id}/editar", "AdminController:productEdit");

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