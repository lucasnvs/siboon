<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Core\ApiController;

class AdminController extends ApiController
{
    private $view;

    public function __construct()
    {
//        $this->setAccessToEndpoint($this->ACCESS_ADMIN);

        $this->view = new Engine(__DIR__ . "/../../themes/admin", "php");
        $this->view->addFolder('shared', __DIR__ . '/../../themes/shared');
    }

    public function home ()
    {
        echo $this->view->render("home/home", []);
    }

    public function product ()
    {
        echo $this->view->render("product/product", []);
    }

    public function productRegister ()
    {
        echo $this->view->render("product_register/product_register", []);
    }
}
