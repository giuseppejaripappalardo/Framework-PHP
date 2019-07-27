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
    private $jokesCategoriesTable;

    public function __construct(DatabaseTable $authorsTable, DatabaseTable $jokesCategoriesTable){
        $this->authorsTable = $authorsTable;
        $this->jokesCategoriesTable = $jokesCategoriesTable;
    }

    public function getAuthor()
    {
    	if(!isset($this->author)){
           $this->author = $this->authorsTable->findById($this->authorid);
        }
        return $this->author;
    }
    
    public function addCategory($categoryid){
        $jokeCat = ['joke_id' => $this->id, 'category_id' => $categoryid];
        $this->jokesCategoriesTable->save($jokeCat);
    }
    
    public function hasCategory($categoryid)
    {
    	$jokeCategoires = $this->jokesCategoriesTable->findByField('joke_id', $this->id);
    	foreach($jokeCategoires as $jokeCategory)
	    {
	    	if($jokeCategory->category_id == $categoryid)
		    {
		    	return true;
		    }
	    }
    }
    
    public function clearCategories()
    {
    	$this->jokesCategoriesTable->deleteWhere('joke_id', $this->id);
    }
}