<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

ob_start();

$route = new Router(url(), ":");

$route->namespace("Source\App");

$route->group(null);

$route->get("/", "Web:home");

$route->get("/admin", "Admin:admin"); // transformar em rota privade de admin

$route->get("/contato", "Web:contact");
$route->get("/entrar", "Web:login");
$route->get("/sobre", "Web:about");
$route->get("/faq", "Web:faq");

$route->get("/perfil", "Web:profile"); // rota de user logado

$route->get("/product", "Web:product"); // rota template
$route->get("/section", "Web:section"); // rota template

$route->get("/ops/{errcode}", "Web:error");

$route->group(null);

$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();