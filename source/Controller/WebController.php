<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Controller\Api\ProductController;
use Source\Core\Controller;
use Source\Models\Product\Product;

class WebController extends Controller
{
    /** @var Engine */
    private $view;
    private $router;

    private $loggedUser = null;

    public function __construct($router)
    {
        $this->view = new Engine(__DIR__ . "/../../themes/web","php");
        $this->view->addFolder('shared', __DIR__ . '/../../themes/shared');

        $this->router = $router;

        if(isset($this->userAuth)) {
            $this->loggedUser = $this->userAuth;
        }

        $this->view->addData(["loggedUser" => $this->loggedUser]);
    }

    public function home ()
    {
        echo $this->view->render("home/home",[
            "title" => "Home",
        ]);
    }

    public function contact ()
    {
        echo $this->view->render("contact/contact",[
            "title" => "Contato"
        ]);
    }

    public function login ()
    {
        echo $this->view->render("login/login", [
            "title" => "Entrar"
        ]);
    }

    public function faq()
    {
        echo $this->view->render("faq/faq", [
            "title" => "FAQ",
        ]);
    }

    public function about ()
    {
        echo $this->view->render("about/about", [
            "title" => "Contato"
        ]);
    }

    public function product (array $data)
    {
        $product = (new Product())->findById($data["name"]);

        if(!$product) {
            $this->router->redirect("/ops/404");
        }

        echo $this->view->render("product/product", [
            "title" => $product->name,
            "product_id" => $product->id
        ]);

    }

    public function section (array $data)
    {
        $sectionName = $data["section_name"];
        echo $this->view->render("section/section", [
            "title" => $sectionName,
        ]);
    }

    public function error(array $data)
    {
        echo $this->view->render("error/error", [
            "title" => $data["errcode"]
        ]);
    }

}