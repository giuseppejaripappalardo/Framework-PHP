<?php

namespace Ijdb\Controllers;
use \Framework\DatabaseTable;
use \Framework\Authentication;

class JokesController {
	private $authorsTable;
	private $jokesTable;
	private $categoriesTable;
	private $authentication;
	
	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, DatabaseTable $categoriesTable, Authentication $authentication){
		$this->authorsTable = $authorsTable;
		$this->jokesTable = $jokesTable;
		$this->categoriesTable = $categoriesTable;
		$this->authentication = $authentication;
	}

	public function index(){
		$author = $this->authentication->getUser();
		$pageLimit = 5;
		$page = $_GET['page'] ?? 1;
		$offset = ($page-1) * $pageLimit;

		if(isset($_GET['category'])) {
			$category = $this->categoriesTable->findById($_GET['category']);
			$jokes = $category->getJokes($pageLimit, $offset);
			$count = $category->getNumJokes();
		} else {
			$jokes = $this->jokesTable->findAll('jokedate DESC', $pageLimit, $offset);
			$count = $this->jokesTable->findCount();
		}

		$categories = $this->categoriesTable->findAll();
	 
		$title = 'Benvenuto nel blog dei Joke!';
		
		return ['title' => $title, 'variabili' => ['joke' => $jokes, 'categories' => $categories, 'user' => $author, 'count' => $count, 'pageLimit' => $pageLimit, 'currentPage' => $page, 'categoryid' => $_GET['category'] ?? null], 'template' => 'article.html.php'];
	}
	
	public function delete(){

		$author = $this->authentication->getUser();
		
		$joke = $this->jokesTable->findById($_POST['id']);
		
		if($joke->authorid != $author->id && !$author->hasPermission(\Ijdb\Entity\Author::DELETE_JOKES)){
				return;
		}

		$delete = $this->jokesTable->delete($_POST['id']);
		header('location: /joke/index');
	}
	
	public function edit() {
		$author = $this->authentication->getUser();
		$categories = $this->categoriesTable->findAll();
		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);
			$title = 'Aggiorna Joke';
		}
		$title = 'Inserisci un Joke';
		return ['template' => 'form.html.php', 'title' => $title, 'variabili' => [ 'joke' => $joke ?? null, 'user' => $author, 'categories' => $categories]];
	}
	
	public function saveEdit(){
		$author = $this->authentication->getUser();
		$joke = $_POST['joke'];
		$joke['jokedate'] = new \DateTime();
		$jokeEntity = $author->addJoke($joke);
		$jokeEntity->clearCategories();
		foreach($_POST['category'] as $categoryId){
			$jokeEntity->addCategory($categoryId);
		}
		header('location: /joke/index');
	}
}
