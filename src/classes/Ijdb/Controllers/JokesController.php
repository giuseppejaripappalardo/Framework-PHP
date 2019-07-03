<?php

namespace Ijdb\Controllers;
use \Framework\DatabaseTable;

class JokesController {
	private $authorsTable;
	private $jokesTable;
	
	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable){
		$this->authorsTable = $authorsTable;
		$this->jokesTable = $jokesTable;
	}
	
	public function index(){
		$query = $this->jokesTable->find('*');
		$author = $this->authorsTable;
		$joke = [];
		
		foreach($query as $jokes){
			$author = $this->authorsTable->findById($jokes['authorid']);
			$joke[] = ['id' => $jokes['id'],
					   'joketext' => $jokes['joketext'],
					   'jokedate' => $jokes['jokedate'],
					   'authorid' => $jokes['authorid'],
					   'name' => $author['name'],
					   'email' => $author['email']];
		}
		$title = 'Benvenuto nel blog dei Joke!';
		
		return ['title' => $title, 'variabili' => ['joke' => $joke], 'template' => 'article.html.php'];
	}
	
	public function delete(){
		$delete = $this->jokesTable->delete($_POST['id']);
		header('location: /joke/index');
	}
	
	public function edit() {
		$title = 'Aggiorna Joke';
		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);
		}
		return ['template' => 'form.html.php', 'title' => $title, 'variabili' => [ 'joke' => $joke ?? null ]];
	}
	public function saveEdit(){
		$joke = $_POST['joke'];
		$joke['jokedate'] = new \DateTime();
		$joke['authorid'] = 1;
		$this->jokesTable->save($joke);
		header('location: /joke/index'); 
	}
}
