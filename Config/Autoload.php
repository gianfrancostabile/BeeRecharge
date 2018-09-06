<?php 
	namespace Config;

	class Autoload{
	
		public static function start(){
			spl_autoload_register(function($nombreclase){
				$ruta= ROOT  . str_replace("\\", '/', $nombreclase) . ".php";
				
				include_once($ruta);
			});
		}
	}

	Autoload::start();

 ?>