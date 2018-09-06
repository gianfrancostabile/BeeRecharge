<?php 
	
	require_once('Config/Constantes.php');
	require_once('Config/Autoload.php');

	use Config\Router as Router;
	use Config\Request as Request;

	if (!isset($_SESSION)) {
		session_start();
	}
	
	$router= new Router(new Request());
?>

