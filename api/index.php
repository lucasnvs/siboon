<?php
require  __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\App\Api\ErrorController;
use Source\Exceptions\RouterException;
use Source\Response\Code;

try {

    ob_start();

    $route = new Router(url("api"),":");

    $route->namespace("Source\App\Api");

    $route->group("usuarios"); // Working
    $route->get("/", "Users:listUsers");
    $route->get("/{id}", "Users:getUser");
    $route->post("/", "Users:insertUser");
    $route->post("/update/{id}", "Users:updateUser");
    $route->delete("/{id}", "Users:deleteUser");
    $route->post("/login", "Users:login");
    $route->post("/change-password", "Users:changePassword");

    $route->group("faq");
    $route->get("/","Faqs:listFaqs");
    $route->get("/{id}", "Faqs:getFaq");
    $route->post("/{id}", "Faqs:insertFaq");
    $route->post("/update/{id}", "Faqs:updateFaq");

    $route->group("produtos");
    $route->get("/", "Products:listProducts");
    $route->get("/{id}", "Products:getProduct");
    $route->post("/", "Products:insertProduct");
    $route->post("/update/{id}", "Products:updateProduct");
    $route->delete("/{id}", "Products:deleteProduct");

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
}