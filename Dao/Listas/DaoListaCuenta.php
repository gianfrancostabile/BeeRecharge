<?php
namespace Dao\Listas;

use Config\SingleTon as SingleTon;
use Modelo\Cuenta as Cuenta;
use Dao\IDAO as IDAO;
use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoListaCuenta extends SingleTon implements IDAO
{

	private $listado;

	function __construct(){
		
		if (isset($_SESSION['listaCuenta'])) {
			$this->listado= $_SESSION['listaCuenta'];
			
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
		$_SESSION['listaCuenta']= $this->listado;
	}

	public function borrar($newVal){

	}


	public function modificar($newVal1, $newVal2){
		
	}

	public function buscar($newVal){
		
		foreach ($this->listado as $key => $value) {
			
			if($value->getEmail() === $newVal){
				throw new Exception("Ya hay una Cuenta cargada con el email '" . $newVal . "'.");

			}
		}
		
	}

	public function buscarCuentaLogin($mail, $contra){
		
		if (!empty($this->listado)) {
			foreach ($this->listado as $key => $value) {

				if(($value->getEmail() === $mail) && ($value->getContrasenia() === $contra)){
					$_SESSION['cuentaLogeada']= $value;
					
					return $value;
				}
			}
		}

		throw new Exception("El email o la contraseña son incorrectos.");
	}
}
?>