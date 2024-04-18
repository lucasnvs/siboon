<?php

namespace Source\App;

use League\Plates\Engine;

class Admin
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/admin", "php");
    }

    public function admin ()
    {
        echo $this->view->render("admin", []);
    }
}
