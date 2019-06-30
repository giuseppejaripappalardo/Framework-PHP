<?php

namespace Ijdb;
use \Ijdb\Controllers\JokesController;
use \Framework\DatabaseTable;

class Routes {

    public function callAction($route){

		include(__DIR__.'/../../includes/DatabaseConnection.php');
		
		$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
		$authorsTable = new DatabaseTable($pdo, 'author', 'id');
	
		if($route == strtolower($route )){
			if($route  === 'joke/index'){
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->index();
			}
			else if($route  === 'joke/edit'){
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->edit();
			}
			else if($route  === 'joke/delete'){
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->delete();
			}
		/*	else if($route === 'register'){
				$controller = new RegisterController($authorsTable);
				$page = $controller->showForm();
			} */
			else if($route === ''){
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->index();
			} else {
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->index();
				$error = 'Si è verificato un errore, stai cercando una pagina inesistente';
			}
		}
		return ['page' => $page, 'error' => $error ?? ''];
	}
}