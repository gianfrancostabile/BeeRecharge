<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Dao\Conexion as Conexion;
use Dao\IDAO as IDAO;
use Modelo\Cliente as Cliente;

use Dao\BD\DaoBDLocalidad as DaoLocalidad;

use Exception;

	/*
	modelo:
	private $id;
	private $apellido;
	private $dni;
	private $fechaNacimiento;
	private $direccion; //agraga EDU
	private $localidad;
	private $nombre;
	private $telefono;

	database:
	id_Cliente	nombre_Cliente	apellido	fecha_Nacimiento	dni	id_Localidadid_Direccion

	*/

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoBDCliente extends SingleTon implements IDAO
{
	public function insertar($newVal){

		$daoLocalidad = DaoLocalidad::getInstance();
		$idLocalidad= $daoLocalidad->buscar($newVal->getLocalidad());

		$query= 'INSERT INTO Clientes (nombre_Cliente, apellido, fecha_Nacimiento, dni, id_localidad, direccion, telefono) 
		VALUES (:nombre, :apellido, :fecha_Nacimiento, :dni, :idLocalidad, :direccion, :telefono)';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$nombre= $newVal->getNombre();
			$apellido= $newVal->getApellido();
			$dni= $newVal->getDNI();
			$fecha_Nac= $newVal->getFechaNacimiento();
			$direccion= $newVal->getDireccion();
			$telefono= $newVal->getTelefono();  

			$comando->bindParam(':nombre', $nombre);
			$comando->bindParam(':apellido', $apellido);
			$comando->bindParam(':fecha_Nacimiento', $fecha_Nac);
			$comando->bindParam(':dni', $dni);
			$comando->bindParam(':idLocalidad', $idLocalidad);
			$comando->bindParam(':direccion', $direccion);
			$comando->bindParam(':telefono', $telefono);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
		
		return $conexion->lastInsertId();
	}

	//se le envia el id de un cliente a borrar
	public function borrar($newVal){

		$query= 'DELETE FROM Clientes 
		WHERE id_Cliente= :idCliente';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$id= $newVal;

			$comando->bindParam(':idCliente', $id);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	public function modificar($idModif, $newVal){

		$query= 'UPDATE Clientes 
		SET nombre_Cliente= :nombre, apellido= :apellido, fecha_Nacimiento= :fecha_Nacimiento , dni= :dni , localidad= :localidad , direccion= :direccion, telefono= :telefono
		WHERE id_Cliente= :id_Cliente_Modif';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$nombre= $newVal->getNombre();
			$apellido= $newVal->getApellido();
			$dni= $newVal->getDNI();
			$fecha_Nac= $newVal->getFechaNacimiento();
			$localidad= $newVal->getLocalidad();  
			$direccion= $newVal->getDireccion();  
			$telefono= $newVal->getTelefono();  

			$id_Cliente_Modif= $idModif; 

			$comando->bindParam(':nombre', $nombre);
			$comando->bindParam(':apellido', $apellido);
			$comando->bindParam(':fecha_Nacimiento', $fecha_Nac);
			$comando->bindParam(':dni', $dni);
			$comando->bindParam(':localidad', $localidad);
			$comando->bindParam(':direccion', $direccion);
			$comando->bindParam(':telefono', $telefono);

			$comando->bindParam(':id_Cliente_Modif', $id_Cliente_Modif);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	//busca cliente por ID
	public function buscar($newVal){

		$Cliente= null;

		$query= 'SELECT * 
		FROM Clientes 
		WHERE id_Cliente= :id';
		
		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':id', $newVal);

			$comando->execute();

			if($row = $comando->fetch()){

				$daoLocalidad = DaoLocalidad::getInstance();
				$nombreLocalidad= $daoLocalidad->getLocalidadXID($row['id_Localidad']);

				$Cliente= new Cliente($row['nombre_Cliente'], $row['apellido'], $row['dni'], $row['fecha_Nacimiento'], $row['direccion'], $nombreLocalidad, $row['telefono']);

				$Cliente->setId($row['id_Cliente']);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		if (is_null($Cliente)) {
			throw new Exception("Cliente inexistente");
		}

		return $Cliente;
	}
	
	public function getAllClientes(){

		$listado= array();

		$query= 'SELECT * 
		FROM Clientes';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);
			$comando->execute();

			while ($row = $comando->fetch()){

				$daoLocalidad = DaoLocalidad::getInstance();
				$localidad= $daoLocalidad->getLocalidadXID($row['id_Localidad']);

				$Cliente= new Cliente($row['nombre_Cliente'], $row['apellido'], $row['dni'], $row['fecha_Nacimiento'], $row['direccion'], $localidad, $row['telefono']);

				$Cliente->setId($row['id_Cliente']);

				array_push($listado, $Cliente);

			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
		return $listado;
	}

}
?>