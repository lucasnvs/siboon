<?php

ob_start();

require  __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url("api"),":");

$route->namespace("Source\App\Api");

$route->group("usuarios");
$route->get("/", "Users:listUsers");        // Not implemented yet
$route->get("/{id}", "Users:getUser");      // Not tested yet
$route->post("/", "Users:insertUser");      // Not tested yet
$route->put("/{id}", "Users:updateUser");
$route->delete("/{id}", "Users:deleteUser");// Not tested yet

$route->post("/login", "Users:login");

$route->group("faq");
$route->get("/","Faqs:listFaqs");
$route->get("/{id}", "Faqs:getFaq");
$route->post("/{id}", "Faqs:insertFaq");

$route->group("produtos"); // Recurso Produto // necessário add middleware
$route->get("/", "Products:listProducts");
$route->get("/{id}", "Products:getProduct");
$route->post("/", "Products:insertProduct");
$route->put("/{id}", "Products:updateProduct");
$route->delete("/{id}", "Products:deleteProduct");

$route->group(null);

$route->dispatch();

/** ERROR REDIRECT */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();
