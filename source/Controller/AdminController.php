<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Controller\Api\ProductController;
use Source\Controller\Api\UserController;
use Source\Core\Controller;
use Source\Models\User;

class AdminController extends Controller
{
    private $view;

    public function __construct()
    {
        parent::__construct();
        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

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
        $products = (new ProductController())->listProducts(isLocalReq: true);
        echo $this->view->render("product/product", [
            "title" => "Produtos",
            "products" => json_decode(json_encode($products), true)
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
//        $product = (new ProductController())->getProduct($data, isLocalReq: true);
        echo $this->view->render("product_edit/product_edit", [
            "title" => "Editar Produto",
//            "product" => $product
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
