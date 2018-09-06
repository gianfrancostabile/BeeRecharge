<?php
	namespace Dao\Listas;

	use Config\SingleTon as SingleTon;
	use Modelo\Sucursal as Sucursal;
	use Dao\IDAO as IDAO;
	use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoListaSucursal extends SingleTon implements IDAO
{

	private $listado;

	function __construct(){
		
		if (isset($_SESSION['listaSucursal'])) {
			$this->listado= $_SESSION['listaSucursal'];
		
		}	else{
			$this->listado= array();
		}
	}

	public function getListado()
	{
		return $this->listado;
	}


	public function insertar($newVal){

		array_push($this->listado, $newVal);
		$_SESSION['listaSucursal']= $this->listado;
	}

	public function borrar($newVal){

	}


	public function modificar($newVal1, $newVal2){
		
	}

	/*	return true cuando encuentra el valor
	 *	return false cuando no lo encuentra
	 */
	public function buscar($newVal){
		
		if (!empty($this->listado)) {
			foreach ($this->listado as $key => $value) {
				if(strtolower($value->getNombre()) === strtolower($newVal)){
					throw new Exception("Ya hay una Sucursal cargada con el nombre '" . $newVal . "'.");

				}
			}
		}
	}
}
?>