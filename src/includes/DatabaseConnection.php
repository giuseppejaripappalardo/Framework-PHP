<?php

$debug = true;

try{
	$pdo = new PDO('mysql:host=gjnas.serveftp.com;dbname=GjServer;charset=utf8', 'g.pappalardo', 'Roccerirva48@');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($debug) && $debug === true) {
		$output = "Connessione MySQL stabilita";
		$title = "Connessione MySQL stabilita";	
	}
} catch(PDOException $e){
	$output = 'Connessione fallita, si è verificato un errore.';
	if(isset($debug) && $debug === true) {
		$output = rtrim($output, '.');
		$output .= ': '. $e->getMessage() . ' nel file: ' . $e->getFile() . ' alla riga ' . $e->getLine();
	}
}
