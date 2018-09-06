<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Modelo\LineaPedido as LineaPedido;
use Dao\Conexion as Conexion;
use Dao\IDAO as IDAO;

use Dao\BD\DaoBDProducto as DaoProducto;
use Exception;

	/*
	
	modelo:
	private $id;
	private $cantidad;
	private $producto;
	private $subtotal;

	databese:
	id_Linea_Pedido	id_Producto	id_Pedido	cantidad	subtotal

	*/

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoBDLineaPedido extends SingleTon implements IDAO
{
	public function insertar($newVal){

		$query= 'INSERT INTO lineas_pedidos(id_Producto, id_Pedido, cantidad, subtotal) 
		VALUES (:idProducto, :idPedido, :cantidad, :subtotal)';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$idProducto= $newVal->getProducto()->getId();
			$idPedido= $newVal->getIdPedido();
			$cantidad= $newVal->getCantidad();
			$subtotal= $newVal->getSubtotal();

			$comando->bindParam(':idProducto', $idProducto);
			$comando->bindParam(':idPedido', $idPedido);
			$comando->bindParam(':cantidad', $cantidad);
			$comando->bindParam(':subtotal', $subtotal);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	//se le envia el id de un LineaPedido a borrar
	public function borrar($newVal){

		$query= 'DELETE FROM lineas_pedidos 
		WHERE id_Linea_Pedido= :idLineaPedido';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idLineaPedido', $newVal);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	public function modificar($idModif, $newVal){

		$query= 'UPDATE lineas_pedidos 
		SET	id_Producto= :idProducto, id_Pedido= :idPedido, cantidad= :cantidad, subtotal= :subtotal
		WHERE id_Linea_Pedido= :idLineaPedido';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$idProducto= $newVal->getProducto();
			$idPedido= $newVal->getIdPedido();
			$cantidad= $newVal->getCantidad();
			$subtotal= $newVal->getSubtotal();

			$comando->bindParam(':idProducto', $idProducto);
			$comando->bindParam(':idPedido', $idProducto);
			$comando->bindParam(':cantidad', $cantidad);
			$comando->bindParam(':subtotal', $subtotal);

			$comando->bindParam(':idLineaPedido', $idModif);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	//newVal es el id del LineaPedido a buscar
	public function buscar($newVal){
		
		$LineaPedido= null;

		$query= 'SELECT * 
		FROM lineas_pedidos
		WHERE id_Linea_Pedido= :idLineaPedido';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idLineaPedido', $newVal);

			$comando->execute();

			if($row = $comando->fetch()){
				
				$daoProducto = DaoProducto::getInstance();
				$producto = $daoProducto->buscar($row['id_Producto']);

				$LineaPedido= new LineaPedido($producto, $row['cantidad']);
				$LineaPedido->setSubTotal($row['subtotal']);
				$LineaPedido->setIdPedido($row['id_Pedido']);

				$LineaPedido->setId($row['id_Linea_Pedido']);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $LineaPedido;
	}

	public function getAllLineasPedidosFromPedido($idPedido){

		$listado= array();

		$query= 'SELECT * 
		FROM lineas_pedidos
		WHERE id_Pedido = :idPedido';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idPedido', $idPedido);

			$comando->execute();
			
			while ($row = $comando->fetch()){

				$daoProducto = DaoProducto::getInstance();
				$producto = $daoProducto->buscar($row['id_Producto']);

				$LineaPedido= new LineaPedido($producto, $row['cantidad']);
				$LineaPedido->setSubTotal($row['subtotal']);
				$LineaPedido->setIdPedido($row['id_Pedido']);

				$LineaPedido->setId($row['id_Linea_Pedido']);

				array_push($listado, $LineaPedido);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

}
?>