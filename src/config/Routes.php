<?php

class Routes {

    public function callAction($route){

		include_once(__DIR__.'/../includes/DatabaseConnection.php');
		include_once(__DIR__.'/../classes/DatabaseTable.php');
		
		$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
		$authorsTable = new DatabaseTable($pdo, 'author', 'id');
	
		if($route == strtolower($route )){
			if($route  === 'joke/index'){
				include(__DIR__.'/../controller/JokesController.php');
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->index();
			}
			else if($route  === 'joke/edit'){
				include(__DIR__.'/../controller/JokesController.php');
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->edit();
			}
			else if($route  === 'joke/delete'){
				include(__DIR__.'/../controller/JokesController.php');
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->delete();
			}
			else if($route === 'register'){
				include(__DIR__.'/../controller/RegisterController.php');
				$controller = new RegisterController($authorsTable);
				$page = $controller->showForm();
			}
			else if($route === ''){
				include(__DIR__.'/../controller/JokesController.php');
				$controller = new JokesController($jokesTable, $authorsTable);
				$page = $controller->index();
			}
		}
		return $page;
	}
}