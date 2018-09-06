<?php
	namespace Dao\Listas;

	use Config\SingleTon as SingleTon;
	use Modelo\TipoCerveza as TipoCerveza;
	use Dao\IDAO as IDAO;
	use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoListaTipoCerveza extends SingleTon implements IDAO
{

	private $listado;
	private $idAutoIncrement;

	function __construct(){
		
		if (isset($_SESSION['listaTipoCerveza'])) {
			$this->listado= $_SESSION['listaTipoCerveza'];
			$this->idAutoIncrement= $_SESSION['idAutoIncrementTipoCerveza'];
		
		}	else{
			$this->listado= array();
			$this->idAutoIncrement= 1;
		}
	}

	// $newVal es el objeto de Tipo Cerveza que se va a insertar en la lista
	public function insertar($newVal){

		try{
			//valida si no hay ningun tipo de cerveza con el mismo ID o Nombre que contiene $newVal, si encuentra una coincidencia, devuelve una exception y la capturo cancelando el ingreso del dato a la lista. 
			$this->validarTipoCerveza($newVal);
			
			$newVal->setId($this->idAutoIncrement);
			$this->idAutoIncrement++;

			//agrego el tipo de cerveza a la lista 
			array_push($this->listado, $newVal);

		}	catch(Exception $e){
			throw new Exception($e->getMessage());
		
		}	finally{
			$_SESSION['listaTipoCerveza']= $this->listado;
			$_SESSION['idAutoIncrementTipoCerveza']= $this->idAutoIncrement;
		}
	}

	// $newVal es la id que va a borrar de la lista
	public function borrar($newVal){

		try {		
			//obtengo la posicion en la que se encuentra el tipo de cerveza enviando como dato unico su ID, lanzará una exception cuando no encuentre el dato en la lista
			$pos= $this->getPosTipoCervezaId($newVal);

			//borro de la lista el dato que se encuentra en al posicion de busque anteriormente
			unset($this->listado[$pos]);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
			
		}	finally{
			$_SESSION['listaTipoCerveza']= $this->listado;

		}
	}

	// $idModif es la ID del tipo de cerveza que se va a modificar, $newVal es el nuevo tipo de cerveza que ingresará en el lugar de la $idModif.
	public function modificar($idModif, $newVal){

		try{
			//valida y devuelve la posicion en que se encuentra la ID Vieja
			$pos= $this->validarTipoCervezaEnModificacion($idModif, $newVal);
			$newVal->setId($idModif);
			
			//piso los valores que se encontraban en la posicion de la ID vieja con los valores de la nueva.
			$this->listado[$pos]= $newVal;
		
		}	catch(Exception $e){
			throw new Exception($e->getMessage());
		
		}	finally{
			$_SESSION['listaTipoCerveza']= $this->listado;
		}
	}

	// $newVal es la id que va a buscar en la lista, retorna el tipo de cerveza con la ID que se obtiene por parámetro
	public function buscar($newVal){
		
		foreach ($this->listado as $key => $value) {
			
			if($value->getId() == $newVal){
				return $value;
			}
		}

		throw new Exception("No se ha encontrado ningun Tipo de Cerveza con ese nombre.");
	}

	//retorna todos la lista de tipos de cerveza
	public function getAllTiposCervezas(){
		return $this->listado;
	}

	//valida si no el tipo de cerveza que obtengo por paramatro no coincide con algun tipo de cerveza de la lista, comparando por la ID y tambien por el Nombre, lanzando una exception cuando encuentre una coincidencia.
	public function validarTipoCerveza($tipoCerveza){

		if (!empty($this->listado)) {

			foreach ($this->listado as $key => $value) {

				if(strtolower($value->getNombre()) === strtolower($tipoCerveza->getNombre())){
					throw new Exception("Ya hay un Tipo de Cerveza cargado con el nombre '" . $tipoCerveza->getNombre() . "'.");

				}

			}
		}
	}

	//esta funcion sirve para la validacion de modificar un tipo de cerveza, la $idTipoCervezaVieja representa a la ID de aquel tipo de cerveza que va a ser reemplazado y el $tipoCerveazNueva sera el tipo de cerveza con los nuevo valores que tomará, por lo tanto a la hora de hacer la comparacion tengo que evitar que compare con la $idTipoCervezaVieja, esto es porque puede pasar que el usuario al modicarla no cambie los valores de la ID y/o del Nombre, pudiendo tirar una exception y que no pueda ser modificado. Comparará por el nombre y por la ID y si encuentra una coincidencia lanza una exception. Si encuentro la $idTipoCervezaVieja en el arreglo, ademas de no hacer que compare con el nuevo tipo de cerveza, guardo su posicion en la lista para luego sea retornada y ya tener la posicion a ser reemplazada en la lista.
	public function validarTipoCervezaEnModificacion($idTipoCervezaVieja, $tipoCervezaNueva){

		$pos= null;

		foreach ($this->listado as $key => $value) {
			
			if ($value->getId() != $idTipoCervezaVieja) {
				
				if(strtolower($value->getNombre()) == strtolower($tipoCervezaNueva->getNombre())){
					throw new Exception("Ya hay un Tipo de Cerveza cargado con el nombre '" . $tipoCervezaNueva->getNombre() . "'.");

				}
			
			}	else{
				$pos= $key;

			}
		}

		if (is_null($pos)) {
			throw new Exception("El ID '" . $idTipoCervezaVieja . "' no existe.");
		}

		return $pos;
	}

	//obtengo la posicion del tipo de cerveza en la que se encuentra la ID que obtengo por parámetro.
	public function getPosTipoCervezaId($id){

		foreach ($this->listado as $key => $value) {
			
			if ($value->getId() == $id) {
				return $key;
			}
		}

		throw new Exception("Tipo de Cerveza inexistente.");
		
	}

	public function getTipoCerveza($id){

		foreach ($this->listado as $key => $value) {
			
			if ($value->getId() == $id) {
				return $value;
			}
		}

		throw new Exception("Tipo de Cerveza inexistente.");
	}

}
?>