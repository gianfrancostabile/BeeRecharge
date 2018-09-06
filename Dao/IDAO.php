<?php  
	namespace Dao;

interface IDAO{

	public function insertar($newVal);
	public function modificar($idModif, $newVal);
	public function borrar($newVal);
	public function buscar($newVal);
}
?>