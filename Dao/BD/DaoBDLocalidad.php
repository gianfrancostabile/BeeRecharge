<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Modelo\Foto as Foto;
use Dao\IDAO as IDAO;
use Dao\Conexion as Conexion;
use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoBDLocalidad extends SingleTon implements IDAO
{

	public function insertar($newVal){

	}

	public function modificar($idModif, $newVal){
		
	}

	// $newVal es el Nombre de la Localidad
	public function buscar($newVal){
		
		$idLocalidad= null;

		try{
			$query= 'SELECT * 
			FROM Localidades
			WHERE nombre_Localidad = :nombreLocalidad';

			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':nombreLocalidad', $newVal);

			$comando->execute();

			if($row = $comando->fetch()){

				$idLocalidad = $row['id_Localidad'];
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
		
		return $idLocalidad;
	}

	public function borrar($newVal){
		
	}


	public function getAllLocalidades(){
		
		$listado= array();

		try{
			$query= 'SELECT * 
			FROM 	Localidades';

			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);
			
			$comando->execute();
			
			while ($row = $comando->fetch()){

				array_push($listado, $row['nombre_Localidad']);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

	public function getLocalidadXID($id){

		$nombreLocalidad= null;

		$query= 'SELECT * 
		FROM Localidades
		WHERE id_Localidad = :idLocalidad';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idLocalidad', $id);

			$comando->execute();

			if($row = $comando->fetch()){

				$nombreLocalidad = $row['nombre_Localidad'];
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
		
		return $nombreLocalidad;
	}
}
?>