<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Faq\Question;
use Source\Models\Faq\Type;

class Web
{
    private $view;

    public function __construct($router)
    {
        $this->view = new Engine(__DIR__ . "/../../themes/web","php");
        $this->router = $router;
    }

    public function home ()
    {
        echo $this->view->render("home",[
            "title" => "Home"
        ]);
    }

    public function contact ()
    {
        echo $this->view->render("contact",[
            "title" => "Contato"
        ]);
    }

    public function login ()
    {
        echo $this->view->render("login", [
            "title" => "Entrar"
        ]);
    }

    public function faq()
    {
        $faq = new Question();
        $dataQuestions = $faq->selectAll();

        $faqTypes = new Type();
        $dataTypes = $faqTypes->selectAll();

        echo $this->view->render("faq", [
            "title" => "FAQ",
            "dataQuestions" => $dataQuestions,
            "dataTypes" => $dataTypes
        ]);
    }

    public function about ()
    {
        echo $this->view->render("about", [
            "title" => "Contato"
        ]);
    }

    public function product ()
    {
        $productName = "tshirt-diamond-black-piano";

        $this->router->route("produto/{name}", [
            "name" => $productName
        ]);

        echo $this->view->render("product", [
            "title" => $productName
        ]);
    }

    public function profile () // remover daq e colocar em local de user logado
    {
        echo $this->view->render("profile", [
            "title" => "Perfil"
        ]);
    }
    public function section ()
    {
        echo $this->view->render("section", []);
    }
    public function error(array $data)
    {
        var_dump($data);
    }

}