<?php  
	namespace Dao;

	/**
	* 
	*/
	class Conexion{
		
		//Se conecta a la base de datos que se encuentra en la carpeta del proyecto
		public static function conectar(){
            return new \PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
		}
	}
?>