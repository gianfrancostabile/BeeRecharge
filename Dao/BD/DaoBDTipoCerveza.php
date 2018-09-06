<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Modelo\TipoCerveza as TipoCerveza;
use Dao\Conexion as Conexion;
use Dao\IDAO as IDAO;
use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoBDTipoCerveza extends SingleTon implements IDAO
{

	public function insertar($newVal){

		$query= 'INSERT INTO Tipos_Cervezas (nombre_Tipo_Cerveza, descripcion, precio_Litro) 
		VALUES (:nombre, :descripcion, :precioLitro)';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$nombre= $newVal->getNombre();
			$descripcion= $newVal->getDescripcion();
			$precioLitro= $newVal->getPrecioLitro();

			$comando->bindParam(':nombre', $nombre);
			$comando->bindParam(':descripcion', $descripcion);
			$comando->bindParam(':precioLitro', $precioLitro);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}


	public function borrar($newVal){

		$query= 'DELETE FROM Tipos_Cervezas 
		WHERE id_Tipo_Cerveza= :idTipoCerveza';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$id= $newVal;

			$comando->bindParam(':idTipoCerveza', $id);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}


	public function modificar($idModif, $newVal){

		$query= 'UPDATE Tipos_Cervezas 
		SET nombre_Tipo_Cerveza= :nombre, descripcion= :descripcion, precio_Litro= :precioLitro 
		WHERE id_Tipo_Cerveza= :idModif';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$nombre= $newVal->getNombre();
			$descripcion= $newVal->getDescripcion();
			$precioLitro= $newVal->getPrecioLitro();

			$comando->bindParam(':idModif', $idModif);
			$comando->bindParam(':nombre', $nombre);
			$comando->bindParam(':descripcion', $descripcion);
			$comando->bindParam(':precioLitro', $precioLitro);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}


	public function buscar($newVal){
		
		$tipoCerveza= null;

		$query= 'SELECT * 
		FROM Tipos_Cervezas 
		WHERE id_Tipo_Cerveza= :idTipoCerveza';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$id= $newVal;

			$comando->bindParam(':idTipoCerveza', $id);

			$comando->execute();

			if($row = $comando->fetch()){

				$tipoCerveza= new TipoCerveza($row['nombre_Tipo_Cerveza'], $row['descripcion'], $row['precio_Litro']);
				$tipoCerveza->setId($row['id_Tipo_Cerveza']);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $tipoCerveza;
	}

	public function getAllTiposCervezas(){

		$listado= array();

		$query= 'SELECT * 
		FROM Tipos_Cervezas';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);
			$comando->execute();

			while ($row = $comando->fetch()){

				$tipoCerveza= new TipoCerveza($row['nombre_Tipo_Cerveza'], $row['descripcion'], $row['precio_Litro']);
				$tipoCerveza->setId($row['id_Tipo_Cerveza']);

				array_push($listado, $tipoCerveza);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

	public function getIdTipoCerveza($nombreTC){

		$id = null;

		$query = 'SELECT *
		FROM Tipos_Cervezas
		WHERE nombre_Tipo_Cerveza = :nombreTipoCerveza';

		try{
			$conexion = Conexion::conectar();
			$comando = $conexion->prepare($query);

			$comando->bindParam(':nombreTipoCerveza', $nombre);

			$comando->execute();

			if ($row = $comando->fetch()) {
				$id = $row['id_Tipo_Cerveza'];
			} 
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $id;
	}

}
?>