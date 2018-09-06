<?php
	namespace Dao\Listas;

	use Config\SingleTon as SingleTon;
	use Modelo\Pedido as Pedido;
	use Dao\IDAO as IDAO;
	use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoListaPedido extends SingleTon implements IDAO
{

	private $listado;

	function __construct(){
		
		if (isset($_SESSION['listaPedido'])) {
			$this->listado= $_SESSION['listaPedido'];
		
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
		$_SESSION['listaPedido']= $this->listado;
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
				if(strtolower($value->getID()) === strtolower($newVal)){
					throw new Exception("Ya hay un Pedido cargado con el ID '" . $newVal . "'.");

				}
			}
		}
	}
}
?>