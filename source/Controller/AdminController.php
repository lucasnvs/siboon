<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Controller\Api\ProductController;
use Source\Controller\Api\UserController;
use Source\Core\Controller;
use Source\Models\Product\Product;
use Source\Models\User;

class AdminController extends Controller
{
    private $view;
    private $router;

    public function __construct($router)
    {
        parent::__construct();
        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

        $this->router = $router;

        $this->view = new Engine(__DIR__ . "/../../themes/admin", "php");
        $this->view->addFolder('shared', __DIR__ . '/../../themes/shared');
    }

    public function home ()
    {
        echo $this->view->render("home/home", [
            "title" => "Início",
        ]);
    }

    public function product ()
    {
        echo $this->view->render("product/product", [
            "title" => "Produtos",
        ]);
    }

    public function productRegister ()
    {
        echo $this->view->render("product_register/product_register", [
            "title" => "Registrar Produto",
        ]);
    }

    public function productEdit(array $data)
    {
        $product = (new Product())->findById($data["id"]);
        if(!$product) $this->router->redirect("/admin/produtos");

        echo $this->view->render("product_edit/product_edit", [
            "title" => "Editar Produto",
            "productId" => $data["id"],
        ]);
    }

    public function client()
    {
        $clients = (new UserController())->listUsers(isLocalReq: true );
        echo $this->view->render("client/client", [
            "title" => "Clientes",
            "clients" => $clients,
        ]);
    }
}
