<?php
require  __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Controller\Api\ErrorController;
use Source\Exceptions\RouterException;
use Source\Support\Response\Code;

try {

    ob_start();

    $route = new Router(url("api"),":");

    $route->namespace("Source\Controller\Api");


    /*
     * Resource: Users
     */
    $route->group("usuarios");
    $route->get("/", "UserController:listUsers");
    $route->get("/{id}", "UserController:getUser");
    $route->post("/", "UserController:insertUser");
    $route->post("/update/{id}", "UserController:updateUser");
    $route->delete("/{id}", "UserController:deleteUser");
    $route->post("/login", "UserController:login");
    $route->post("/change-password", "UserController:changePassword");

    /*
     * Resource: FAQ (Frequently Asked Questions)
     */
    $route->group("faq");
    $route->get("/","FaqController:listFaqs");
    $route->get("/{id}", "FaqController:getFaq");
    $route->post("/", "FaqController:insertFaq");
    $route->post("/update/{id}", "FaqController:updateFaq");
    $route->delete("/{id}", "FaqController:deleteFaq");

    /*
     * Resource: Products
     */
    $route->group("produtos");
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