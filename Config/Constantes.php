<?php 
	namespace Config;

	define("ROOT", str_replace('\\', '/', dirname(__DIR__)) . '/');

	$base= explode($_SERVER['DOCUMENT_ROOT'], ROOT);
	define("BASE", $base[1]);	

	define('DB_HOST', 'localhost');
	define('DB_NAME', 'bdBeer');
	define('DB_USER', 'root');
	define('DB_PASS', '');
 ?>