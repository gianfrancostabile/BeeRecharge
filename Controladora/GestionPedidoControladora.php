<?php  
namespace Controladora;

use Modelo\Pedido as Pedido;

use Dao\BD\DaoBDSucursal as DaoSucursal;
use Dao\BD\DaoBDLineaPedido as DaoLineaPedido;
use Dao\BD\DaoBDPedido as DaoPedido;

use Exception;
	/**
	* 
	*/
	class GestionPedidoControladora{
		
		private $daoPedido;
		private $daoLineaPedido;
		private $daoSucursal;

		function __construct(){

			$this->daoPedido= DaoPedido::getInstance();
			$this->daoLineaPedido= DaoLineaPedido::getInstance();
			$this->daoSucursal= DaoSucursal::getInstance();
			
		}

		public function vistaLineasPedido(){

			require(ROOT . 'Vistas/TemplateBase/header.php');
			require(ROOT . 'Vistas/TemplateBase/navHeader.php');
			require(ROOT . 'Vistas/Pedido/lineasPedido.php');
			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

		public function vistaAgregarSucursal(){

			try{
				$mensaje = '';
				$this->daoSucursal = DaoSucursal::getInstance();
				$listado= $this->daoSucursal->getAllSucursales();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Pedido/agregarSucursal.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function vistaDireccionEnvio(){

			require(ROOT . 'Vistas/TemplateBase/header.php');
			require(ROOT . 'Vistas/TemplateBase/navHeader.php');
			require(ROOT . 'Vistas/Pedido/direccionEnvio.php');
			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

		public function listaPedidosUsuario(){


			if (isset($_SESSION['cuentaUsuario'])) {

				$cuenta = $_SESSION['cuentaUsuario'];
				
				$listado = $this->daoPedido->getPedidosCliente($cuenta->getPersona()->getId());

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Pedido/listaPedidosUsuario.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

			}	else {
				header('Location: ' . BASE . 'paginaPrincipal/inicio');
			}	
		}

		public function listaPedidosAdmin($busqueda='', $datoABuscar=''){


			if (isset($_SESSION['cuentaUsuario'])) {
				
				switch ($busqueda) {
					case 'Fecha':
					$fecha = str_replace('/', '-', $datoABuscar);
					$listado = $this->daoPedido->getPedidosFecha($fecha);
					break;

					case 'Cliente':
					$listado = $this->daoPedido->getPedidosCliente($datoABuscar);
					break;

					case 'Sucursal':
					$listado = $this->daoPedido->getPedidosSucursal($datoABuscar);
					break;

					default:
					$listado = $this->daoPedido->getAllPedidos();
					break;
				}

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Pedido/listaPedidosAdmin.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

			}	else {
				header('Location: ' . BASE . 'paginaPrincipal/inicio');
			}	
		}

		public function vistaDetallePedido($idPedido){

			try{
				$mensaje = '';
				$pedido = $this->daoPedido->buscar($idPedido);
				
			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Pedido/detallePedido.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');
				
				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function agregar($pedido){

			if(is_null($pedido)){
				throw new Exception("Pedido no creado.");			
			}

			if (is_null($pedido->getTitular()->getDni())) {
				throw new Exception("No hay un titular en el pedido.");				
			}

			if (is_null($pedido->getSucursal()->getNombre())) {
				throw new Exception("No hay una Sucursal seleccionada en el pedido.");				
			}

			$pedido->setEstado('Solicitado');

			ini_set('date.timezone','America/Buenos_Aires'); 
			$hoy = date("Y-m-d"); 

			$pedido->setFecha($hoy);
			$id = $this->daoPedido->insertar($pedido);

			if ($id != 0) {
				
				foreach ($pedido->getLineasPedidos() as $key => $value) {
					$value->setIdPedido($id);

					$this->daoLineaPedido->insertar($value);
				}
				
				unset($_SESSION['pedido']);
				$pedido->setId($id);

				return $pedido;

			}	else {
				throw new Exception("Pedido no ingresado");
				
			}
		}

		public function modificar($idPedido, $estado){

			$pedido = $this->daoPedido->buscar($idPedido);

			if ($pedido != null) {

				$pedido->setEstado($estado);
				$this->daoPedido->modificar($idPedido, $pedido);
				$this->listaPedidosAdmin();
				echo "<script>alert('Pedido Actualizado.')</script>";

			}	else{
				$this->listaPedidosAdmin();
				echo "<script>alert('Pedido Inexistente.')</script>";
			}
		}

		public function eliminar(){
			
		}

		public function agregarSucursal($idPedido){

			if (isset($_SESSION['pedido'])) {
				
				try{
					$mensaje = '';

					$sucursal = $this->daoSucursal->buscar($idPedido);

					$pedido = $_SESSION['pedido'];
					$pedido->setSucursal($sucursal);

				}	catch(Exception $e){
					$mensaje = $e->getMessage();

				}	finally {

					$_SESSION['pedido'] = $pedido;

					if (empty($mensaje)) {
						$this->vistaDireccionEnvio();

					}	else {

						header('Location: ' . BASE . 'paginaPrincipal/inicio');
						echo '<script>alert("' . $mensaje . '")</script>';	
					}

				}

			}	else {

				header('Location: ' . BASE . 'paginaPrincipal/inicio');
				echo '<script>alert("No haz creado ningun Pedido.")</script>';	
			}
		}

		public function formListaPedidosAdmin($idPedido, $estado, $btn){
			
			switch ($btn) {
				case 'btn_detalle':
				$this->vistaDetallePedido($idPedido);
				break;
				
				case 'btn_actualizar':
				$this->modificar($idPedido, $estado);
				break;

				default:
				header('Location: ' . BASE . 'paginaPrincipal/inicio');
				break;
			}

		}

	}
	?>