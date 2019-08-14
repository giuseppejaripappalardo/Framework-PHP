<?php

namespace Framework;

class EntryPoint
{
	private $route;
	private $routes;
	private $method;
	
	public function __construct(string $route, string $method, \Framework\Routes $routes){
		$this->route = $route;
		$this->routes = $routes;
		$this->method = $method;
		$this->checkUrl();
	}
	
	private function checkUrl(){
		if($this->route !== strtolower( $this->route )){
			http_response_code(301);
			header('location: /joke/index');
		}
	}
	
	private function loadTemplate($templateFileName, $variabili = [], $authCheck = null) {
		$loggedIn = $authCheck;
		extract($variabili);
		ob_start();
		include(__DIR__ . '/../../../webroot/component/' . $templateFileName);
		return ob_get_clean();
	}

	public function run(){

		$routes = $this->routes->getRoutes();
		$authentication = $this->routes->getAuthentication();

		if(isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()){
			header('location: /login/error');
		} else if (isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])) {
			header('location: /login/error');	
		} 
		else {
		$controller = $routes[$this->route][$this->method]['controller'];
		$action = $routes[$this->route][$this->method]['action'];

		$page = $controller->$action();

		$title = $page['title'];

		if(isset($page['variabili'])){
			$output = $this->loadTemplate($page['template'], $page['variabili'], $authentication->isLoggedIn());
		} else {
			$output = $this->loadTemplate($page['template']);
		}

		$menu = $this->loadTemplate('menu.html.php', ['loggedIn' => $authentication->isLoggedIn()]);

		echo $this->loadTemplate('layout.html.php', ['output' => $output, 'menu' => $menu, 'title' => $title]);
		}
	}
}