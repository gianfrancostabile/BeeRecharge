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
class DaoBDTipoUsuario extends SingleTon implements IDAO
{

	public function insertar($newVal){

	}

	public function modificar($idModif, $newVal){
		
	}

	// $newVal es el Nombre del tipo de usuario
	public function buscar($newVal){
		
		$idTipoUsuario= null;

		$query= 'SELECT * 
		FROM Tipos_Usuarios
		WHERE nombre_Tipo_Usuario = :nombreTipoUsuario';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':nombreTipoUsuario', $newVal);

			$comando->execute();

			if($row = $comando->fetch()){

				$idTipoUsuario = $row['id_Tipo_Usuario'];
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
		
		return $idTipoUsuario;
	}

	public function borrar($newVal){
		
	}

	public function getTipoUsuario($id){

		$nombreTipoUsuario= null;

		$query= 'SELECT * 
		FROM Tipos_Usuarios
		WHERE id_Tipo_Usuario = :idTipoUsuario';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idTipoUsuario', $id);

			$comando->execute();

			if($row = $comando->fetch()){

				$nombreTipoUsuario = $row['nombre_Tipo_Usuario'];
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
		
		return $nombreTipoUsuario;
	}

}
?>