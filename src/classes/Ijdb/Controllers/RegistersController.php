<?php

namespace Ijdb;
use Framework\DatabaseTable;

class RegistersController {

    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable){
        $this->authorsTable = $authorsTable;
    }

    public function registrationForm(){
        return ['template' => 'register.html.php', 'title' => 'Registrati su GjDb'];
    }

    public function success(){
        return ['template' => 'registersuccess.html.php', 'title' => 'Registrazione effettuata con successo.'];
    }

    public function registerUser(){
        $author = $_POST['author'];
        
        if(isset($author['email'])){
            $author['email'] = strtolower($author['email']);
        }
        if(isset($author['username'])){
            $author['name'] = strtolower($author['name']);
        }

        $valid = true;
        $error = [];

        if(empty($author['name'])){
            $valid = false;
            $error[] = 'Attenzione! Il campo nome non può essere vuoto.';
        }

        if(empty($author['email'])){
            $valid = false;
            $error[] = 'Attenzione! Il campo email non può essere vuoto.';
        } else if(!filter_var($author['email'], FILTER_VALIDATE_EMAIL)){
            $valid = false;
            $error[] = 'Attenzione, il formato della e-mail non è corretto';
        } else if(count($this->authorsTable->findByField('email', $author['email'])) > 0){
            $valid = false;
            $error[] = 'Attenzione, la mail inserita è già in uso da parte di un altro utente.';
        }

        if(empty($author['username'])){
            $valid = false;
            $error[] = 'Attenzione! Il campo username non può essere vuoto.';
        } else if(count($this->authorsTable->findByField('username', $author['username']))){
            $valid = false;
            $error[] = 'Attenzione! Questo username è già registrato.';
        }

        if(empty($author['password'])){
            $valid = false;
            $error[] = 'Attenzione! Il campo password non può essere vuoto.';
        } 

        if($valid == true){
            $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);
            try{
                $this->authorsTable->save($author);
            } catch (\PDOException $e){
                echo 'Si è incazzato' . $e . ' ' . $e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage();
            }
    
            header('Location: /author/success');
        } else {
            return ['template' => 'register.html.php', 'variabili' => ['error' => $error, 'author' => $author], 'title' => 'Si è verificato un errore'];
        }
    }
}