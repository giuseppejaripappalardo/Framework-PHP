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
	
	private function loadTemplate($templateFileName, $variabili = []) {
		extract($variabili);
		ob_start();
		include(__DIR__ . '/../../../webroot/component/' . $templateFileName);
		return ob_get_clean();
	}

	public function run(){

		$routes = $this->routes->getRoutes();

		$controller = $routes[$this->route][$this->method]['controller'];
		$action = $routes[$this->route][$this->method]['action'];

		$page = $controller->$action();

		$title = $page['title'];

		if(isset($page['variabili'])){
			$article = $this->loadTemplate($page['template'], $page['variabili']);
		} else {
			$article = $this->loadTemplate($page['template']);
		}

		ob_start();
		include(__DIR__ . '/../../../webroot/component/menu.html.php');
		$menu = ob_get_clean();
		include(__DIR__ . '/../../../webroot/templates/layout.html.php');
	}
}