<?php
require  __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Controller\Api\ErrorController;
use Source\Exceptions\RouterException;
use Source\Support\Response\Code;

try {
    ob_start();

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header('Access-Control-Allow-Credentials: true');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

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

    $route->get("/{user_id}/enderecos/", "UserController:listUserAddresses");
    $route->post("/{user_id}/enderecos/", "UserController:insertUserAddress");
    $route->post("/{user_id}/enderecos/update/{id}", "UserController:updateUserAddress");
    $route->delete("/{user_id}/enderecos/{id}", "UserController:deleteUserAddress");

    /*
     * Resource: FAQ (Frequently Asked Questions)
     */
    $route->group("faq");
    $route->get("/","FaqController:listFaqs");
    $route->get("/{id}", "FaqController:getFaq");
    $route->post("/", "FaqController:insertFaq");
    $route->post("/update/{id}", "FaqController:updateFaq");
    $route->delete("/{id}", "FaqController:deleteFaq");

    $route->group("faq/topicos");
    $route->get("/","FaqController:listTopics");
    $route->get("/{id}", "FaqController:getTopic");
    $route->post("/", "FaqController:insertTopic");
    $route->post("/update/{id}", "FaqController:updateTopic");
    $route->delete("/{id}", "FaqController:deleteTopic");

    /*
     * Resource: Products
     */
    $route->group("produtos");
    $route->get("/", "ProductController:listProducts");
    $route->get("/{id}", "ProductController:getProduct");
    $route->post("/", "ProductController:insertProduct");
    $route->post("/update/{id}", "ProductController:updateProduct");
    $route->delete("/{id}", "ProductController:deleteProduct");

    /*
     * Resource: Orders // No documentation
     */
    $route->group("pedidos");
    $route->get("/", "OrderController:listOrders");
    $route->get("/{id}", "OrderController:getOrder");
    $route->post("/", "OrderController:createOrder");
    $route->post("/update/{id}", "OrderController:updateOrder");
    $route->delete("/{id}", "OrderController:deleteOrder");
    $route->post("/finalizar", "OrderController:finishOrder");

    /*
     * Resource: Company // No documentation
     */
    $route->group("company");
    $route->get("/", "CompanyController:listInformation");
    $route->post("/", "CompanyController:saveInformation");

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
    if(CONF_IN_DEVELOPMENT === "true") { throw $e; }
    return ErrorController::getUnavailable();
}