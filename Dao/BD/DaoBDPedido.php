<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Dao\Conexion as Conexion;
use Dao\IDAO as IDAO;
use Modelo\Pedido as Pedido;
use Modelo\Cliente as Cliente;
use Modelo\Sucursal as Sucursal;

use Dao\BD\DaoBDSucursal as DaoSucursal;
use Dao\BD\DaoBDCliente as DaoCliente;
use Dao\BD\DaoBDLineaPedido as DaoLineaPedido;

use Exception;

	/*
	
	modelo:
	private $id;
	private $sucursal;
	private $titular;
	private $total;
	
	data base:
		id_Pedido	id_Titular	id_Sucursal	precio_Total

	*/

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */


class DaoBDPedido extends SingleTon implements IDAO
{	


	//Se le pasa un Objeto Pedido a insertar
	public function insertar($newVal){

		$query= 'INSERT INTO Pedidos (id_Titular, id_Sucursal, precio_Total, estado, fecha) 
		VALUES (:idTitular, :idSucursal, :precioTotal, :estado, :fecha)';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$idTitular= $newVal->getTitular()->getId();
			$idSucursal= $newVal->getSucursal()->getId();
			$precioTotal= $newVal->getTotal();
			$estado= $newVal->getEstado();
			$fecha= $newVal->getFecha();

			$comando->bindParam(':idTitular', $idTitular);
			$comando->bindParam(':idSucursal', $idSucursal);
			$comando->bindParam(':precioTotal', $precioTotal);
			$comando->bindParam(':estado', $estado);
			$comando->bindParam(':fecha', $fecha);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $conexion->lastInsertId();
	}

	//se le pasa el ID de Pedido a borrar
	public function borrar($newVal){

		$query= 'DELETE FROM Pedidos 
		WHERE id_Pedido= :idPedido';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idPedido', $newVal);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	public function modificar($idModif, $newVal){

		$query= 'UPDATE Pedidos SET id_Titular= :idTitular, id_Sucursal= :idSucursal, precio_Total= :precioTotal,
		estado= :estado, fecha= :fecha
		WHERE id_Pedido= :idPedido';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$idTitular= $newVal->getTitular()->getId();
			$idSucursal= $newVal->getSucursal()->getId();
			$precioTotal= $newVal->getTotal();
			$estado= $newVal->getEstado();
			$fecha= $newVal->getFecha();

			$comando->bindParam(':idTitular', $idTitular);
			$comando->bindParam(':idSucursal', $idSucursal);
			$comando->bindParam(':precioTotal', $precioTotal);
			$comando->bindParam(':estado', $estado);
			$comando->bindParam(':fecha', $fecha);

			$comando->bindParam(':idPedido', $idModif);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	//se pasa el ID para buscar un Pedido
	public function buscar($newVal){
		
		$Pedido= null;

		$query= 'SELECT * 
		FROM Pedidos 
		WHERE id_Pedido= :idPedido';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$idABuscar= $newVal;

			$comando->bindParam(':idPedido', $idABuscar);

			$comando->execute();

			if($row = $comando->fetch()){

				$daoSucursal= DaoSucursal::getInstance();
				$sucursal= $daoSucursal->buscar($row['id_Sucursal']);

				$daoCliente= DaoCliente::getInstance(); 
				$cliente= $daoCliente->buscar($row['id_Titular']);

				$daoLineaPedido= DaoLineaPedido::getInstance();
				$lineasPedidos = array();
				$lineasPedidos= $daoLineaPedido->getAllLineasPedidosFromPedido($row['id_Pedido']);

				$Pedido= new Pedido($sucursal, $cliente);
				$Pedido->setTotal($row['precio_Total']);
				$Pedido->setEstado($row['estado']);
				$Pedido->setLineasPedidos($lineasPedidos);
				$Pedido->setFecha($row['fecha']);

				$Pedido->setId($row['id_Pedido']);

			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $Pedido;
	}

	public function getAllPedidos(){

		$listado= array();

		$query= 'SELECT * 
		FROM Pedidos';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);
			$comando->execute();

			while($row = $comando->fetch()){

				$daoSucursal= DaoSucursal::getInstance();
				$sucursal= $daoSucursal->buscar($row['id_Sucursal']);

				$daoCliente= DaoCliente::getInstance(); 
				$cliente= $daoCliente->buscar($row['id_Titular']);

				$daoLineaPedido= DaoLineaPedido::getInstance();
				$lineasPedidos = array();
				$lineasPedidos= $daoLineaPedido->getAllLineasPedidosFromPedido($row['id_Pedido']);

				$Pedido= new Pedido($sucursal, $cliente);
				$Pedido->setTotal($row['precio_Total']);
				$Pedido->setEstado($row['estado']);
				$Pedido->setLineasPedidos($lineasPedidos);
				$Pedido->setFecha($row['fecha']);

				$Pedido->setId($row['id_Pedido']);

				array_push($listado, $Pedido);

			}
		}	catch(Exception $e){
			throw new Exception($e->getMessage());
			
		}

		return $listado;
	}

	public function getPedidosCliente($id){

		$listado= array();

		$query= 'SELECT * 
		FROM Pedidos
		WHERE id_Titular= :id';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':id', $id);

			$comando->execute();

			while($row = $comando->fetch()){

				$daoSucursal= DaoSucursal::getInstance();
				$sucursal= $daoSucursal->buscar($row['id_Sucursal']);

				$daoCliente= DaoCliente::getInstance(); 
				$cliente= $daoCliente->buscar($row['id_Titular']);

				$daoLineaPedido= DaoLineaPedido::getInstance();
				$lineasPedidos = array();
				$lineasPedidos= $daoLineaPedido->getAllLineasPedidosFromPedido($row['id_Pedido']);

				$Pedido= new Pedido($sucursal, $cliente);
				$Pedido->setTotal($row['precio_Total']);
				$Pedido->setEstado($row['estado']);
				$Pedido->setLineasPedidos($lineasPedidos);
				$Pedido->setFecha($row['fecha']);

				$Pedido->setId($row['id_Pedido']);

				array_push($listado, $Pedido);

			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

	public function getPedidosSucursal($nombreSucursal){

		$listado= array();

		$query= 'SELECT * 
		FROM Pedidos p INNER JOIN Sucursales s
		ON p.id_Sucursal = s.id_Sucursal
		WHERE s.nombre_Sucursal= :nombreSucursal';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':nombreSucursal', $nombreSucursal);

			$comando->execute();

			while($row = $comando->fetch()){

				$daoSucursal= DaoSucursal::getInstance();
				$sucursal= $daoSucursal->buscar($row['id_Sucursal']);

				$daoCliente= DaoCliente::getInstance(); 
				$cliente= $daoCliente->buscar($row['id_Titular']);

				$daoLineaPedido= DaoLineaPedido::getInstance();
				$lineasPedidos = array();
				$lineasPedidos= $daoLineaPedido->getAllLineasPedidosFromPedido($row['id_Pedido']);

				$Pedido= new Pedido($sucursal, $cliente);
				$Pedido->setTotal($row['precio_Total']);
				$Pedido->setEstado($row['estado']);
				$Pedido->setLineasPedidos($lineasPedidos);
				$Pedido->setFecha($row['fecha']);

				$Pedido->setId($row['id_Pedido']);

				array_push($listado, $Pedido);

			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

	public function getPedidosFecha($fecha){

		$listado= array();

		$query= 'SELECT * 
		FROM Pedidos
		WHERE fecha= :fecha';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':fecha', $fecha);

			$comando->execute();
			
			while($row = $comando->fetch()){

				$daoSucursal= DaoSucursal::getInstance();
				$sucursal= $daoSucursal->buscar($row['id_Sucursal']);

				$daoCliente= DaoCliente::getInstance(); 
				$cliente= $daoCliente->buscar($row['id_Titular']);
				
				$daoLineaPedido= DaoLineaPedido::getInstance();
				$lineasPedidos = array();
				$lineasPedidos= $daoLineaPedido->getAllLineasPedidosFromPedido($row['id_Pedido']);

				$Pedido= new Pedido($sucursal, $cliente);
				$Pedido->setTotal($row['precio_Total']);
				$Pedido->setEstado($row['estado']);
				$Pedido->setLineasPedidos($lineasPedidos);
				$Pedido->setFecha($row['fecha']);

				$Pedido->setId($row['id_Pedido']);

				array_push($listado, $Pedido);
				
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

}
?>