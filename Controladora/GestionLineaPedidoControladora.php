<?php  
namespace Controladora;

use Modelo\Producto as Producto;
use Modelo\Pedido as Pedido;
use Modelo\Sucursal as Sucursal;
use Modelo\LineaPedido as LineaPedido;

use Dao\Listas\DaoListaLineaPedido as DaoLineaPedido;
use Dao\BD\DaoBDProducto as DaoBDProducto;

use Exception;

	/**
	* 
	*/
	class GestionLineaPedidoControladora{

		private $listaLineaPedido;
		private $daoProducto;

		function __construct(){

			$this->daoLineaPedido= DaoLineaPedido::getInstance();
			$this->daoProducto= DaoBDProducto::getInstance();
			
		}

		public function vistaAgregar(){

			require(ROOT . 'Vistas/TemplateBase/header.php');	
			require(ROOT . 'Vistas/Pedido/altaLineaPedido.php');
			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

		public function vistaModificar(){

			require(ROOT . 'Vistas/TemplateBase/header.php');
			require(ROOT . 'Vistas/Pedido/modificarLineaPedido.php');
			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

		public function agregar($idProducto, $cantidad){
			
			try{
				$mensaje = '';

				$producto = $this->daoProducto->buscar($idProducto);
				$lineaPedido = new LineaPedido($producto, $cantidad);

				$this->daoLineaPedido->insertar($lineaPedido);

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				header('Location: ' . BASE . 'paginaPrincipal/tienda');

				if(!empty($mensaje)){
					echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
				}
			}
			
		}

		public function eliminar($idProducto){
			
			try {
				$mensaje = '';
				$this->daoLineaPedido->borrar($idProducto);
				
			} catch (Exception $e) {
				$mensaje = $e->getMessage();

			}	finally{

				header('Location: ' . BASE . 'paginaPrincipal/tienda');

				if(!empty($mensaje)){
					echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
				}
			}
			
		}
	}
	?>