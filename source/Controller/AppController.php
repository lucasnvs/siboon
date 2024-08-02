<?php

namespace Source\Controller;

use League\Plates\Engine;
use Source\Core\Controller;
use Source\Models\User;

class AppController extends Controller
{
    /** @var Engine */
    private $view;
    private $router;

    private $loggedUser = null;

    public function __construct($router)
    {
        parent::__construct();
        $this->setAccessToEndpoint($this->ACCESS_LOGGED);

        $this->view = new Engine(__DIR__ . "/../../themes/app","php");
        $this->view->addFolder('shared', __DIR__ . '/../../themes/shared');

        $this->router = $router;

        if(isset($this->userAuth)) {
            $this->loggedUser = $this->userAuth;
        }

        $this->view->addData(["loggedUser" => $this->loggedUser]);
    }

    public function profile()
    {
        $loggedUser = (new User())->findById($this->userAuth->id);
        echo $this->view->render("profile/profile", [
            "title" => "Perfil",
            "user" => $loggedUser->data()
        ]);
    }
}