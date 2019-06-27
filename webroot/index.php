<?php

try {
	error_reporting(E_ALL);  
	ini_set("display_errors", 1);  
	ini_set("display_startup_errors", 1); 
	ini_set("track_errors", 1);   
	ini_set("log_errors", 1);  
	ini_set("error_log", "/logz.txt");  
	ini_set("log_errors_max_len", 0);  

	require_once(__DIR__.'/../src/classes/EntryPoint.php');
	require_once(__DIR__ .'/../src/config/Routes.php');

	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
	$EntryPoint = new EntryPoint($route, new Routes());
	$EntryPoint->run();

}
catch (PDOException $e) {
	$title = 'An error has occurred';
	$article = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
} 