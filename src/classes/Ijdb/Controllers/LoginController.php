<?php

namespace Ijdb\Controllers;

class LoginController {

    public function error(){
        return ['template' => 'loginerror.html.php', 'title' => 'Non hai ancora effettuato l\'accesso!'];
    }
}