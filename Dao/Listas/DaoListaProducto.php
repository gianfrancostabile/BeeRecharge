<?php
	namespace Dao\Listas;

	use Config\SingleTon as SingleTon;
	use Modelo\Producto as Producto;
	use Dao\IDAO as IDAO;
	use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoListaProducto extends SingleTon implements IDAO
{

	private $listado;
	private $idAutoIncrement;
		
	function __construct(){
		
		if (isset($_SESSION['listaProducto'])) {		
			$this->listado= $_SESSION['listaProducto'];
			$this->idAutoIncrement= $_SESSION['idAutoIncrementProducto'];
		
		}	else{
			$this->listado= array();
			$this->idAutoIncrement= 1;
		}
	}

	public function insertar($newVal){

		try {
			
			$this->validarProducto($newVal);

			$newVal->setId($this->idAutoIncrement);
			$this->idAutoIncrement++;

			array_push($this->listado, $newVal);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		
		}	finally{
			$_SESSION['listaProducto']= $this->listado;
			$_SESSION['idAutoIncrementProducto']= $this->idAutoIncrement;

		}
	}

	public function borrar($newVal){
		
		try {

			$pos= $this->getPosProductoId($newVal);
			unset($this->listado[$pos]);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		
		}	finally{
			$_SESSION['listaProducto']= $this->listado;
			$_SESSION['idAutoIncrementProducto']= $this->idAutoIncrement;

		}
	}


	public function modificar($idModif, $newVal){

		try{
			//valida y devuelve la posicion en que se encuentra la ID Vieja
			$pos= $this->validarProductoEnModificacion($idModif, $newVal);

			//piso los valores que se encontraban en la posicion de la ID vieja con los valores de la nueva.
			$this->listado[$pos]= $newVal;
		
		}	catch(Exception $e){
			throw new Exception($e->getMessage());
		
		}	finally{
			$_SESSION['listaProducto']= $this->listado;
			$_SESSION['idAutoIncrementProducto']= $this->idAutoIncrement;
		}
	}

	public function buscar($newVal){
	
		foreach ($this->listado as $key => $value) {

			if($value->getId() == $newVal){
				return $value;
			}
		}
	}

	public function getAllProductos(){
		return $this->listado;
	}
	
	//valida si el producto que obtengo por paramatro no coincide con algun producto de la lista, comparando por la ID y tambien por el Nombre, lanzando una exception cuando encuentre una coincidencia.
	public function validarProducto($producto){

		if (!empty($this->listado)) {

			foreach ($this->listado as $key => $value) {

				if(strtolower($value->getNombre()) === strtolower($producto->getNombre())){
					throw new Exception("Ya hay un Producto cargado con el nombre '" . $producto->getNombre() . "'.");

				}	else if($value->getId() == $producto->getId()){
					throw new Exception("Ya hay un Producto cargado con el ID '" . $producto->getId() . "'.");

				}

			}
		}
	}

	//esta funcion sirve para la validacion de modificar un Producto, la $idTipoCervezaVieja representa a la ID de aquel Producto que va a ser reemplazado y el $tipoCerveazNueva sera el Producto con los nuevo valores que tomará, por lo tanto a la hora de hacer la comparacion tengo que evitar que compare con la $idTipoCervezaVieja, esto es porque puede pasar que el usuario al modicarla no cambie los valores de la ID y/o del Nombre, pudiendo tirar una exception y que no pueda ser modificado. Comparará por el nombre y por la ID y si encuentra una coincidencia lanza una exception. Si encuentro la $idTipoCervezaVieja en el arreglo, ademas de no hacer que compare con el nuevo Producto, guardo su posicion en la lista para luego sea retornada y ya tener la posicion a ser reemplazada en la lista.
	public function validarProductoEnModificacion($idProductoViejo, $productoNuevo){

		$pos= null;

		foreach ($this->listado as $key => $value) {
			
			if ($value->getId() != $idProductoViejo) {
				
				if(strtolower($value->getNombre()) === strtolower($productoNuevo->getNombre())){
					throw new Exception("Ya hay un Producto cargado con el nombre '" . $productoNuevo->getNombre() . "'.");

				}	else if($value->getId() === $productoNuevo->getId()){
					throw new Exception("Ya hay un Producto cargado con el ID '" . $productoNuevo->getId() . "'.");

				}
			
			}	else{
				$pos= $key;

			}
		}

		if (is_null($pos)) {
			throw new Exception("El ID '" . $idProductoViejo . "' no existe.");
		}

		return $pos;
	}

	public function getPosProductoId($newVal){
		
		foreach ($this->listado as $key => $value) {

			if($value->getId() == $newVal){
				return $key;
			}
		}
		
		throw new Exception("No hay ningun Producto con la ID '" . $newVal . "'.");
	}
}
?>