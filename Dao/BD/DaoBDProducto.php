<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Modelo\Producto as Producto;
use Modelo\TipoCerveza as TipoCerveza;
use Modelo\Foto as Foto;
use Dao\IDAO as IDAO;
use Dao\Conexion as Conexion;

use Dao\BD\DaoBDTipoCerveza as DaoBDTipoCerveza;

use Exception;
use PDO;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoBDProducto extends SingleTon implements IDAO
{
	//	$newVal es el Objeto de Producto
	public function insertar($newVal){

		$query= 'INSERT INTO Productos (nombre_Producto, factor, capacidad, id_Tipo_Cerveza, foto) 
		VALUES (:nombre, :factor, :capacidad, :idTipoCerveza, :foto)';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$nombre= $newVal->getNombre();
			$factor= $newVal->getFactor();
			$capacidad= $newVal->getCapacidad();
			$idTipoCerveza= $newVal->getTipoCerveza()->getId();
			$foto= $newVal->getFotoDireccion();

			$comando->bindParam(':nombre', $nombre);
			$comando->bindParam(':factor', $factor);
			$comando->bindParam(':capacidad', $capacidad);
			$comando->bindParam(':idTipoCerveza', $idTipoCerveza);
			$comando->bindParam(':foto', $foto);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	// $newVal es la ID del objeto a borrar
	public function borrar($newVal){
		
		$query= 'DELETE FROM Productos 
		WHERE id_Producto= :idProducto';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idProducto', $newVal);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	// $newVal es el Objeto de Producto
	public function modificar($idModif, $newVal){

		$query= 'UPDATE Productos
		SET nombre_Producto= :nombre, factor= :factor, capacidad= :capacidad, id_Tipo_Cerveza= :idTipoCerveza, 
		foto= :foto
		WHERE id_Producto= :idProductoModif';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$nombre= $newVal->getNombre();
			$factor= $newVal->getFactor();
			$capacidad= $newVal->getCapacidad();
			$idTipoCerveza= $newVal->getTipoCerveza()->getId();
			$foto= $newVal->getFotoDireccion();

			$comando->bindParam(':idProductoModif', $idModif);
			$comando->bindParam(':nombre', $nombre);
			$comando->bindParam(':factor', $factor);
			$comando->bindParam(':capacidad', $capacidad);
			$comando->bindParam(':idTipoCerveza', $idTipoCerveza);
			$comando->bindParam(':foto', $foto);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	// $newVal es el ID del Producto
	public function buscar($newVal){
		
		$producto= null;

		$query= 'SELECT * 
		FROM 	Productos  
		WHERE 	id_Producto = :idProducto';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':idProducto', $newVal);

			$comando->execute();

			if($row = $comando->fetch()){

				$foto= new Foto();
				$foto->setDireccion($row['foto']);

				$daoTipoCerveza= DaoBDTipoCerveza::getInstance();
				$tipoCerveza= $daoTipoCerveza->buscar($row['id_Tipo_Cerveza']);
				
				$producto= new Producto($row['nombre_Producto'], $row['factor'], $row['capacidad'], $tipoCerveza, $foto);
				$producto->setId($row['id_Producto']);

			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $producto;
	}


	public function getAllProductos(){
		
		$listado= array();

		$query= 'SELECT * 
		FROM 	Productos';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);
			
			$comando->execute();
			
			while ($row = $comando->fetch()){

				$foto= new Foto();
				$foto->setDireccion($row['foto']);

				$daoTipoCerveza= DaoBDTipoCerveza::getInstance();
				$tipoCerveza= $daoTipoCerveza->buscar($row['id_Tipo_Cerveza']);
				
				$producto= new Producto($row['nombre_Producto'], $row['factor'], $row['capacidad'], $tipoCerveza, $foto);
				$producto->setId($row['id_Producto']);

				array_push($listado, $producto);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

	public function getProductosLimit($inicio, $fin){

		$listado = array();

		$query= 'SELECT * 
		FROM 	Productos
		LIMIT :inicio, :fin';

		try{
			$conexion = Conexion::conectar();
			$comando = $conexion->prepare($query);
			
			$comando->bindParam(':inicio', $inicio, PDO::PARAM_INT);
			$comando->bindParam(':fin', $fin, PDO::PARAM_INT);

			$comando->execute();

			while ($row = $comando->fetch()) {
				
				$foto= new Foto();
				$foto->setDireccion($row['foto']);

				$daoTipoCerveza= DaoBDTipoCerveza::getInstance();
				$tipoCerveza= $daoTipoCerveza->buscar($row['id_Tipo_Cerveza']);
				
				$producto= new Producto($row['nombre_Producto'], $row['factor'], $row['capacidad'], $tipoCerveza, $foto);
				$producto->setId($row['id_Producto']);

				array_push($listado, $producto);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

	public function getCantProductos(){

		$cantidad = 0;
		$query= 'SELECT COUNT(*) as Cantidad
		FROM 	Productos';

		try{
			$conexion = Conexion::conectar();
			$comando = $conexion->prepare($query);

			$comando->execute();

			if ($row = $comando->fetch()) {
				$cantidad = $row['Cantidad'];
			}

		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $cantidad;
	}
}
?>