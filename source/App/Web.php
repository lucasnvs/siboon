<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Faq\Question;
use Source\Models\Faq\Type;

class Web
{
    private $view;
    private $router;

    public function __construct($router)
    {
        $this->view = new Engine(__DIR__ . "/../../themes/web","php");
        $this->view->addFolder('shared', __DIR__ . '/../../themes/shared');

        $this->router = $router;
    }

    public function home ()
    {
        $productName = "T-Shirt Diamond Black Piano";

        echo $this->view->render("home/home",[
            "title" => "Home",
            "products" => [
                ["url" => buildStringFriendlyURL($productName)],
                ["url" => buildStringFriendlyURL($productName)]
            ]
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
        $faq = new Question();
        $dataQuestions = $faq->selectAll();

        $faqTypes = new Type();
        $dataTypes = $faqTypes->selectAll();


        $groupedQuestions = [];
        foreach ($dataQuestions as $question) {
            $typeId = $question->type_id;

            if (!isset($groupedQuestions[$typeId])) {
                $groupedQuestions[$typeId] = [];
            }

            $groupedQuestions[$typeId][] = $question;
        }

        $finalObject = [];
        foreach ($dataTypes as $type) {
            $typeId = $type->id;
            $typeDescription = $type->description;

            $questions= [];
            if (isset($groupedQuestions[$typeId])) {
                $questions = $groupedQuestions[$typeId];
            }

            $finalObject[$typeDescription] = $questions;
        }

        echo $this->view->render("faq/faq", [
            "title" => "FAQ",
            "faqs" => $finalObject,
        ]);
    }

    public function about ()
    {
        echo $this->view->render("about/about", [
            "title" => "Contato"
        ]);
    }

    public function product ()
    {
        $productName = "T-Shirt Diamond Black Piano";

        $this->router->route("produto/{name}", [
            "name" => buildStringFriendlyURL($productName)
        ]);

        echo $this->view->render("product/product", [
            "title" => $productName
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