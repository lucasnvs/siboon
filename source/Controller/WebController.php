<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Controller\Api\ProductController;
use Source\Core\Controller;

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
        $products = (new ProductController())->listProducts(isLocalReq: true);

        foreach ($products as $product) {
            $product->url = $product->id;
        }

        echo $this->view->render("home/home",[
            "title" => "Home",
            "products" => json_decode(json_encode($products), true),
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
        $product = (new ProductController())->getProduct(["id" => $data["name"]], true);

        if(!$product) {
            $this->router->redirect("/ops/404");
        }

        echo $this->view->render("product/product", [
            "title" => $product->name,
            "product" => json_decode(json_encode($product), true)
        ]);

    }

    public function profile () // remover daq e colocar em local de user logado
    {
        echo $this->view->render("profile/profile", [
            "title" => "Perfil"
        ]);
    }
    public function section ()
    {
        echo $this->view->render("section/section", []);
    }
    public function error(array $data)
    {
        echo $this->view->render("error/error", [
            "title" => $data["errcode"]
        ]);
    }

}