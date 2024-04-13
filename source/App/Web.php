<?php

namespace Source\App;

use League\Plates\Engine;

class Web
{
    private $view;

public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/web","php");
    }

    public function home ()
    {
        echo $this->view->render("home",[]);
    }

    public function contact ()
    {
        echo $this->view->render("contact",[]);
    }

    public function login ()
    {
        echo $this->view->render("login", []);
    }

    public function faq()
    {
        echo $this->view->render("faq", []);
    }

    public function about ()
    {
        echo $this->view->render("about", []);
    }

    public function error(array $data)
    {
        var_dump($data);
    }

}