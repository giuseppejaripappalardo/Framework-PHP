<?php

namespace Ijdb\Controllers;
use \Framework\Authentication;

class LoginController
{
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function error()
    {
        return ['title' => 'Non sei autorizzato.', 'template' => 'loginerror.html.php'];
    }

    public function loginForm()
    {
        return ['title' => 'Accedi a Gjdb', 'template' => 'login.html.php'];
    }

    public function processLogin()
    {
        $author = $_POST['author'];

        if ($this->authentication->login($author['username'], $author['password'])){
            header('location: /joke/index');
        } else {
            return ['template' => 'login.html.php', 'title' => 'Accedi a Gjdb', 'variabili' => ['error' => 'Username o passowrd non validi.', 'author' => $author]];
        }
    }

    public function logout(){
        $_SESSION = [];
        session_destroy();
        header('location: joke\index');
    }
}