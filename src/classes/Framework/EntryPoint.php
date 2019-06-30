<?php

namespace Framework;

class EntryPoint
{
	private $route;
	private $routes;
	
	public function __construct($route, $routes){
		$this->route = $route;
		$this->routes = $routes;
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

		$page = $this->routes->callAction($this->route);

		extract($page);
		$title = $page['title'];
		
		if(isset($page['error'])){
			$error = $page['error'];
		}

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