<?php

namespace Ijdb;
use \Ijdb\Controllers\JokesController;
use \Framework\DatabaseTable;
use \Framework\Authentication;


class Routes implements \Framework\Routes {

		private $authorsTable;
		private $jokesTable;
		private $categoriesTable;
		private $jokesCategoriesTable;
		private $authentication;

		public function __construct()
		{
			include(__DIR__.'/../../includes/DatabaseConnection.php');
			$this->jokesTable = new DatabaseTable($pdo, 'joke', 'id', '\Ijdb\Entity\Joke', [&$this->authorsTable, &$this->jokesCategoriesTable]);
			$this->authorsTable = new DatabaseTable($pdo, 'author', 'id', '\Ijdb\Entity\Author', [&$this->jokesTable]);
			$this->categoriesTable = new DatabaseTable($pdo, 'category', 'id', '\Ijdb\Entity\Category', [&$this->jokesTable, &$this->jokesCategoriesTable]);
			$this->jokesCategoriesTable = new DatabaseTable($pdo, 'jokes_category', 'category_id');
			$this->authentication = new Authentication($this->authorsTable, 'username', 'password');
		}

		public function checkPermission($permission): bool {
			$user = $this->authentication->getUser();
			if($user && $user->hasPermission($permission)){
				return true;
			} else {
				return false;
			}
		}

		public function getRoutes() : array
		{
			$jokesController = new JokesController($this->jokesTable, $this->authorsTable, $this->categoriesTable, $this->authentication);
			$registersController = new RegistersController($this->authorsTable);
			$loginController = new \Ijdb\Controllers\LoginController($this->authentication);
			$categoriesController = new \Ijdb\Controllers\CategorysController($this->categoriesTable);

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
						],
				'category/edit' => [
					'POST' => [
						'controller' => $categoriesController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $categoriesController,
						'action' => 'edit'
					],
					'login' => true
				],
				'category/index' => [
					'GET' => [
						'controller' => $categoriesController,
						'action' => 'index'
					],
					'login' => true,
					'permissions' => \Ijdb\Entity\Author::LIST_CATEGORIES,
				],
				'category/delete' => [
					'POST' => [
						'controller' => $categoriesController,
						'action' => 'delete'
					],
					'login' => true,
					'permissions' => \Ijdb\Entity\Author::REMOVE_CATEGORIES,
				],
				'author/permissions' => [
					'GET' => [
						'controller' => $registersController,
						'action' => 'permissions'
					],
					'POST' => [
						'controller' => $registersController,
						'action' => 'savePermission',
					],
					'login' => true,
					'permissions' => \Ijdb\Entity\Author::EDIT_USER_ACCESS
				],
				'author/index' => [
					'GET' => [
						'controller' => $registersController,
						'action' => 'index'
					],
					'POST' => [
						'controller' => $registersController,
						'action' => 'delete'
					],
				'login' => true,
				'permissions' => \Ijdb\Entity\Author::EDIT_USER_ACCESS
				]
			];
			return $routes;
	}

	public function getAuthentication() : Authentication
	{
		return $this->authentication;
	}
}