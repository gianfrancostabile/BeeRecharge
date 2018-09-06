<?php
namespace Dao\Listas;

use Modelo\Producto as Producto;
use Modelo\LineaPedido as LineaPedido;
use Modelo\Sucursal as Sucursal;
use Modelo\Pedido as Pedido;

use Config\SingleTon as SingleTon;
use Dao\IDAO as IDAO;

use Exception;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class DaoListaLineaPedido extends SingleTon implements IDAO
{


	function __construct(){
		

	}

	public function insertar($newVal){

		if (!isset($_SESSION['pedido'])) {

			$cuenta = $_SESSION['cuentaUsuario'];
			$nuevoPedido = new Pedido(new Sucursal(), $cuenta->getPersona());
			$_SESSION['pedido'] = $nuevoPedido;

		}

		$pedido = $_SESSION['pedido'];

		$pedido->agregarLineaPedido($newVal);

		$_SESSION['pedido'] = $pedido;
	}

	public function borrar($newVal){

		if (isset($_SESSION['pedido'])) {
			
			$pedido = $_SESSION['pedido'];

			try{
				$pedido->borrarLineaPedido($newVal);

			}	catch(Exception $e){
				throw new Exception($e->getMessage());

			}	finally {
				$_SESSION['pedido'] = $pedido;

			}

		}	else{
			throw new Exception("Pedido Inexistente");
			

		}
	}

	public function modificar($idMofif, $newVal){

	}

	public function buscar($newVal){

	}
}
?>