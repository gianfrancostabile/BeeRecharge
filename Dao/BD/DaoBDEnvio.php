<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Modelo\Envio as Envio;
use Dao\Conexion as Conexion;
use Dao\IDAO as IDAO;
use Dao\BD\DaoBDPedido as DaoBDPedido;

use Exception;


	/*
	
	modelo:
	private $id;
	private $direccion;
	private $fecha;
	private $horaFin;
	private $horaInicio;
	private $pedido;
	
	database:
	id_Envio direccion id_Pedido fecha hora_Inicio hora_Fin

	*/

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoBDEnvio extends SingleTon implements IDAO
{
	public function insertar($newVal){

		$query= 'INSERT INTO Envios(direccion, id_Pedido, fecha_Emitida, hora_Emitida) 
		VALUES (:direccion, :idPedido, :fecha, :hora)';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$direccion= $newVal->getDireccion();
			$idPedido= $newVal->getPedido()->getId();
			$fecha= $newVal->getFecha();
			$hora= $newVal->getHoraEmitida();

			$comando->bindParam(':direccion', $direccion);
			$comando->bindParam(':idPedido', $idPedido);
			$comando->bindParam(':fecha', $fecha);
			$comando->bindParam(':hora', $hora);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	//se le envia el id de un envio a borrar
	public function borrar($newVal){

		$query= 'DELETE FROM Envios 
		WHERE id_Envio= :idEnvio';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$id= $newVal;

			$comando->bindParam(':idEnvio', $id);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	public function modificar($idModif, $newVal){

		$query= 'UPDATE Envios 
		SET direccion= :direccion, id_Pedido= :idPedido, fecha_Emitida= :fecha, hora_Emitida= :hora
		WHERE id_Envio= :idModif';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$direccion= $newVal->getDireccion();
			$idPedido= $newVal->getPedido();
			$fecha= $newVal->getFecha();
			$hora= $newVal->getHoraEmitida();

			$comando->bindParam(':direccion', $direccion);
			$comando->bindParam(':idPedido', $idPedido);
			$comando->bindParam(':fecha', $fecha);
			$comando->bindParam(':hora', $hora);

			$comando->bindParam(':idModif', $idModif);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	//newVal es el id del Envio a buscar
	public function buscar($newVal){
		
		$Envio= null;

		$query= 'SELECT * 
		FROM Envios 
		WHERE id_Envio= :idEnvio';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$id= $newVal;

			$comando->bindParam(':idEnvio', $id);

			$comando->execute();

			if($row = $comando->fetch()){

				$DaoPedido=DaoBDPedido::getInstance();
				$Pedido= $DaoPedido->getPedido_x_ID($row['id_Pedido']);

				$Envio= new Envio($row['id_Direccion'], $row['fecha'], $row['hora_Inicio'], $row['hora_Fin'], $Pedido); 

				$Envio->setId($row['id_Envio']);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $Envio;
	}

	public function getAllEnvios(){

		$listado= array();

		$query= 'SELECT * 
		FROM Envios';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->execute();
			
			while ($row = $comando->fetch()){

				$DaoPedido=DaoBDPedido::getInstance();
				$Pedido= $DaoPedido->getPedido($row['id_Pedido']);
				
				$Envio= new Envio($row['id_Direccion'], $row['fecha'], $row['hora_Inicio'], $row['hora_Fin'], $Pedido); 

				$Envio->setId($row['id_Envio']);

				array_push($listado, $Envio);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

}
?>