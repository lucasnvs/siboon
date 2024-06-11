<?php

ob_start();

require  __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url("api"),":");

$route->namespace("Source\App\Api");

$route->group("faq");
$route->get("/","Faqs:getFaqs");
$route->get("/{id}", "Faqs:getFaq");

$route->group("produtos"); // Recurso Produto // necessário add middleware
$route->get("/", "Products:getProducts");
$route->get("/{id}", "Products:getProduct");
$route->post("/", "Products:postProduct");
$route->put("/{id}", "Products:putProduct");
$route->delete("/{id}", "Products:deleteProduct");

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
