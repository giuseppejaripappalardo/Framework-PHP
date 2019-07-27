<?php

namespace Ijdb\Entity;
use \Framework\DatabaseTable;

class Author 
{
    public $id;
    public $name;
    public $username;
    public $email;
    public $password;
    private $jokesTable;

    public function __construct(DatabaseTable $jokesTable)
    {
        $this->jokesTable = $jokesTable;
    }

    public function getJokes()
    {
        return $this->jokesTable->findByField('authorid', $this->id);
    }

    public function addJoke($joke)
    {
        $joke['authorid'] = $this->id;
        return $this->jokesTable->save($joke);
    }
}