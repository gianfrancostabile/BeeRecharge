<?php  
namespace Controladora;

use Dao\BD\DaoBDProducto as DaoProducto;
use Dao\BD\DaoBDSucursal  as DaoSucursal;

use Exception;
	/**
	* 
	*/
	class PaginaPrincipalControladora{

		private $daoProducto;
		private $daoSucursal;

		function __construct(){

			$this->daoProducto= DaoProducto::getInstance();
			$this->daoSucursal= DaoSucursal::getInstance();
		}

		public function inicio(){

			try{
				$mensaje = '';

				$listado = $this->daoProducto->getProductosLimit(0, 8);
				$listadoSucursales = $this->daoSucursal->getAllSucursales();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/TemplateBase/sliderHeader.php');
				require(ROOT . 'Vistas/index.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function tienda($pagina='1'){

			try{
				$mensaje = '';

				$cantidadTraer = 8;
				$inicioLimit= ($pagina - 1) * $cantidadTraer;

				$listado = $this->daoProducto->getProductosLimit($inicioLimit, $cantidadTraer);
				$cantidadProductos = $this->daoProducto->getCantProductos();

				$cantidadPaginas = ceil($cantidadProductos / $cantidadTraer);

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Tienda/tienda.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function masInfo(){
			require(ROOT . 'Vistas/TemplateBase/header.php');

			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

		public function menuAdmin(){
			require(ROOT . 'Vistas/TemplateBase/header.php');
			require(ROOT . 'Vistas/TemplateBase/navHeader.php');
			require(ROOT . 'Vistas/Cuenta/menuAdmin.php');
			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

	}


	?>
