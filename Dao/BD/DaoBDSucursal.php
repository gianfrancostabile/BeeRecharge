<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Modelo\Sucursal as Sucursal;
use Dao\IDAO as IDAO;
use Dao\Conexion as Conexion;
use Exception;

	/*

	modelo:
	private $id;
	private $nombre;
	private $direccion;
	
	datebese:
	id_Sucursal	nombre_Sucursal	id_direccion

	*/

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoBDSucursal extends SingleTon implements IDAO
{
	//	$newVal es el Objeto de Sucursal
	public function insertar($newVal){

		$query= 'INSERT INTO Sucursales (nombre_Sucursal, direccion, telefono) 
		VALUES (:nombre, :direccion, :telefono)';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$nombre= $newVal->getNombre();
			$direccion= $newVal->getDireccion();
			$telefono= $newVal->getTelefono();

			$comando->bindParam(':nombre', $nombre);
			$comando->bindParam(':direccion', $direccion);
			$comando->bindParam(':telefono', $telefono);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	// $newVal es la ID del objeto sucursal a borrar
	public function borrar($newVal){
		
		$query= 'DELETE FROM Sucursales 
		WHERE id_Sucursal= :idSucursal';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$id= $newVal;

			$comando->bindParam(':idSucursal', $id);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	// $newVal es el Objeto de Sucursal
	public function modificar($idModif, $newVal){

		$query= 'UPDATE Sucursales
		SET nombre_Sucursal= :nombreSucursal, direccion= :direccion, telefono= :telefono
		WHERE id_Sucursal= :idSucursalModif';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$idSucursalModif= $idModif;

			$nombre= $newVal->getNombre();
			$direccion= $newVal->getDireccion();
			$telefono= $newVal->getTelefono();

			$comando->bindParam(':nombreSucursal', $nombre);
			$comando->bindParam(':direccion', $direccion);
			$comando->bindParam(':telefono', $telefono);

			$comando->bindParam(':idSucursalModif', $idSucursalModif);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}
	
	//Obtiene Sucursal por ID
	public function buscar($newVal){
		
		$Sucursal= null;

		$query= 'SELECT * 
		FROM Sucursales 
		WHERE id_Sucursal= :idSucursal';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idSucursal', $newVal);

			$comando->execute();

			if($row = $comando->fetch()){
				
				$Sucursal= new Sucursal($row['nombre_Sucursal'], $row['direccion'], $row['telefono']);

				$Sucursal->setId($row['id_Sucursal']);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $Sucursal;


	}


	public function getAllSucursales(){

		$listado= array();

		$query= 'SELECT * 
		FROM Sucursales';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);
			$comando->execute();
			
			while ($row = $comando->fetch()){

				$Sucursal= new Sucursal($row['nombre_Sucursal'], $row['direccion'], $row['telefono']);

				$Sucursal->setId($row['id_Sucursal']);

				array_push($listado, $Sucursal);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}


	//Obtiene la Pos de la Sucursal por ID
	public function getPosSucursal($newVal){


		if (!empty($this->listado)) {
			
			foreach ($this->listado as $key => $value) {

				if(strtolower($value->getNombre()) === strtolower($newVal)){
					return $key;
				}
			}
		}
		
		throw new Exception("No existe la Sucursal '" . $newVal . "'.");
	}

}


?>