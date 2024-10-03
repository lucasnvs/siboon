<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Controller\Api\ErrorController;

try {
    ob_start();

    $route = new Router(url(), ":");
    $route->namespace("Source\Controller");

    /*
     * WEB - GUEST
     */
    $route->group(null);
    $route->get("/", "WebController:home");
    $route->get("/entrar", "WebController:login");
    $route->get("/contato", "WebController:contact");
    $route->get("/sobre", "WebController:about");
    $route->get("/faq", "WebController:faq");
    $route->get("/secao/{section_name}", "WebController:section");
    $route->get("/ops/{errcode}", "WebController:error");

    $route->group("produto");
    $route->get("/{name}", "WebController:product");

    /*
     * APP - LOGGED
     */
    $route->group("app");
    $route->get("/perfil", "AppController:profile");
    $route->get("/checkout", "AppController:checkout");

    /*
     * ADMIN
     */
    $route->group("admin");
    $route->get("/", "AdminController:home");
    $route->get("/vendas", "AdminController:order");
    $route->get("/website", "AdminController:website");
    $route->get("/faq", "AdminController:faq");
    $route->get("/configuracoes", "AdminController:config");

    $route->get("/clientes", "AdminController:customer");

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