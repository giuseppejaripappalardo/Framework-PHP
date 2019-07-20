<?php

namespace Ijdb\Controllers;
use \Framework\DatabaseTable;
use \Framework\Authentication;

class JokesController {
	private $authorsTable;
	private $jokesTable;
	private $authentication;
	
	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, Authentication $authentication){
		$this->authorsTable = $authorsTable;
		$this->jokesTable = $jokesTable;
		$this->authentication = $authentication;
	}

	public function index(){
	    $jokes = $this->jokesTable->findAll();
		$title = 'Benvenuto nel blog dei Joke!';
		
		return ['title' => $title, 'variabili' => ['joke' => $jokes], 'template' => 'article.html.php'];
	}
	
	public function delete(){

		$author = $this->authentication->getUser();
		
		$joke = $this->jokesTable->findById($_POST['id']);
		
		if($joke->authorid != $author->id){
				return;
		}

		$delete = $this->jokesTable->delete($_POST['id']);
		header('location: /joke/index');
	}
	
	public function edit() {
		$author = $this->authentication->getUser();
		
		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);
		}

		$title = 'Aggiorna Joke';
		return ['template' => 'form.html.php', 'title' => $title, 'variabili' => [ 'joke' => $joke ?? null , 'userId' => $author->id]];
	}
	public function saveEdit(){
		$author = $this->authentication->getUser();

		$joke = $_POST['joke'];
		$joke['jokedate'] = new \DateTime();

		$author->addJoke($joke);

		header('location: /joke/index'); 
	}
}
