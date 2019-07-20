<?php

namespace Ijdb\Entity;
use \Framework\DatabaseTable;
class Joke
{
    public $id;
    public $authorid;
    public $jokedate;
    public $joketext;
    private $author;
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable){
        $this->authorsTable = $authorsTable;
    }

    public function getAuthor()
    {
        if(!isset($this->author)){
           $this->author = $this->authorsTable->findById($this->authorid);
        }
        return $this->author;
    }
}