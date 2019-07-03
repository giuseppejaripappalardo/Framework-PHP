<?php

namespace Ijdb;
use \Ijdb\Controllers\JokesController;
use \Framework\DatabaseTable;

class Routes implements \Framework\Routes {

    public function getRoutes(){

		include(__DIR__.'/../../includes/DatabaseConnection.php');
		
		$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
		$authorsTable = new DatabaseTable($pdo, 'author', 'id');
		$jokesController = new JokesController($jokesTable, $authorsTable);
		$registersController = new RegistersController($authorsTable);
		
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
				]
				],
				'joke/edit' => [
					'GET' => [
						'controller' => $jokesController,
						'action' => 'edit'
					],
					'POST' => [
						'controller' => $jokesController,
						'action' => 'saveEdit'
					]
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
							]
						]
			];
		return $routes;
	}
}