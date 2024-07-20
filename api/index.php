<?php
require  __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

ob_start();

$route = new Router(url("api"),":");

$route->namespace("Source\App\Api");

$route->group("usuarios");
$route->get("/", "Users:listUsers");        // Not implemented yet
$route->get("/{id}", "Users:getUser");      // Not tested yet
$route->post("/", "Users:insertUser");      // Not tested yet
$route->post("/update/{id}", "Users:updateUser");
$route->delete("/{id}", "Users:deleteUser");// Not tested yet

$route->post("/login", "Users:login");
$route->post("/change-password", "Users:changePassword");

$route->group("faq");
$route->get("/","Faqs:listFaqs");
$route->get("/{id}", "Faqs:getFaq");
$route->post("/{id}", "Faqs:insertFaq");
$route->post("/update/{id}", "Faqs:updateFaq");

$route->group("produtos"); // Recurso Produto // necessário add middleware
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
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();
