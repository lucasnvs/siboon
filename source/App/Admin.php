<?php

namespace Source\App;

use League\Plates\Engine;

class Admin
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/admin", "php");
        $this->view->addFolder('shared', __DIR__ . '/../../themes/shared');

    }

    public function home ()
    {
        echo $this->view->render("home", []);
    }

    public function product ()
    {
        echo $this->view->render("product", []);
    }

    public function productRegister ()
    {
        echo $this->view->render("product_register", []);
    }
}
