<?php

try {
	include __DIR__ . '/../vendor/autoload.php';
	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
	$EntryPoint = new \Framework\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\Routes());
	$EntryPoint->run();
}
catch (\PDOException $e) {
	$title = 'An error has occurred';
	$article = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}