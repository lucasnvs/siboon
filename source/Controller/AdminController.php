<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Controller\Api\UserController;
use Source\Core\Controller;
use Source\Models\Product\Product;

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

    public function order()
    {
        echo $this->view->render("order/order", [
            "title" => "Vendas",
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

    public function customer()
    {
        echo $this->view->render("customer/customer", [
            "title" => "Clientes",
        ]);
    }

    public function website()
    {
        echo $this->view->render("website/website", [
            "title" => "Site",
        ]);
    }

    public function faq()
    {
        echo $this->view->render("faq/faq", [
            "title" => "Perguntas Frequentes",
        ]);
    }

    public function config()
    {
        echo $this->view->render("config/config", [
            "title" => "Configurações",
        ]);
    }
}
