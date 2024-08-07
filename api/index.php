<?php
require  __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Controller\Api\ErrorController;
use Source\Exceptions\RouterException;
use Source\Response\Code;

try {

    ob_start();

    $route = new Router(url("api"),":");

    $route->namespace("Source\Controller\Api");

    $route->group("usuarios"); // Working
    $route->get("/", "UserController:listUsers");
    $route->get("/{id}", "UserController:getUser");
    $route->post("/", "UserController:insertUser");
    $route->post("/update/{id}", "UserController:updateUser");
    $route->delete("/{id}", "UserController:deleteUser");
    $route->post("/login", "UserController:login");
    $route->post("/change-password", "UserController:changePassword");

    $route->group("faq");
    $route->get("/","FaqController:listFaqs");

    $route->group("produtos"); // Working
    $route->get("/", "ProductController:listProducts");
    $route->get("/{id}", "ProductController:getProduct");
    $route->post("/", "ProductController:insertProduct");
    $route->post("/update/{id}", "ProductController:updateProduct");
    $route->delete("/{id}", "ProductController:deleteProduct");

    $route->group(null);

    $route->dispatch();

    /** ERROR REDIRECT */
    if ($route->error()) {
        header('Content-Type: application/json; charset=UTF-8');
        throw new RouterException("endpoint_not_found", Code::$NOT_FOUND);
    }

    ob_end_flush();
} catch (Exception $e) {
    return ErrorController::getErrorMessage($e);
} catch (Error $e) {
    if(CONF_IN_DEVELOPMENT) {
        throw $e;
    }
    return ErrorController::getUnavailable();
}