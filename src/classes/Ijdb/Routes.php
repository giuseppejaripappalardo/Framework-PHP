<?php

namespace Ijdb;
use \Ijdb\Controllers\JokesController;
use \Framework\DatabaseTable;
use \Framework\Authentication;


class Routes implements \Framework\Routes {

		private $authorsTable;
		private $jokesTable;
		private $authentication;

		public function __construct()
		{
			include(__DIR__.'/../../includes/DatabaseConnection.php');
			$this->jokesTable = new DatabaseTable($pdo, 'joke', 'id', '\Ijdb\Entity\Joke', [&$this->authorsTable]);
			$this->authorsTable = new DatabaseTable($pdo, 'author', 'id', '\Ijdb\Entity\Author', [&$this->jokesTable]);
			$this->authentication = new Authentication($this->authorsTable, 'username', 'password');
		}

		public function getRoutes() : array
		{
			$jokesController = new JokesController($this->jokesTable, $this->authorsTable, $this->authentication);
			$registersController = new RegistersController($this->authorsTable);
			$loginController = new \Ijdb\Controllers\LoginController($this->authentication);

			$routes = [
				'author/register' => [
					'GET' => [
						'controller' => $registersController,
						'action' => 'registrationForm'
					],
					'POST' => [
						'controller' => $registersController,
						'action' => 'registerUser'
					]
				],
					'author/success' => [
						'GET' => [
							'controller' => $registersController,
							'action' => 'success'
						]
					],
				'joke/index' => [
					'GET' => [
						'controller' => $jokesController,
						'action' => 'index'
					],
					],
					'joke/edit' => [
						'GET' => [
							'controller' => $jokesController,
							'action' => 'edit'
						],
						'POST' => [
							'controller' => $jokesController,
							'action' => 'saveEdit'
						],
						'login' => true,
						],
						'' => [
							'GET' => [
								'controller' => $jokesController,
								'action' => 'index',
							]
							],
						'joke/delete' => [
								'POST' => [
									'controller' => $jokesController,
									'action' => 'delete',
								],
								'login' => 'true'
							],
						'login/error' => [
								'GET' => [
									'controller' => $loginController,
									'action' => 'error'
								]
								],
						'login' => [
								'GET' => [
									'controller' => $loginController,
									'action' => 'loginForm'
								],
								'POST' => [
									'controller' =>  $loginController,
									'action' => 'processLogin'
							]
							],
						'logout' => [
							'GET' => [
							'controller' => $loginController,
							'action' => 'logout'
							]
						]
				];
			return $routes;
	}

	public function getAuthentication() : Authentication
	{
		return $this->authentication;
	}
}