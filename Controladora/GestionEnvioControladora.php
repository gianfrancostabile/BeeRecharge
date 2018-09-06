<?php  
namespace Controladora;

use Modelo\Pedido as Pedido;
use Modelo\Envio as Envio;

use Controladora\GestionPedidoControladora as GestionPedidoControladora;
use Dao\BD\DaoBDEnvio as DaoEnvio;

use Exception;
	/**
	* 
	*/
	class GestionEnvioControladora{
		
		private $controladoraPedido;
		private $daoEnvio;

		function __construct(){
			$this->controladoraPedido = new GestionPedidoControladora();
			$this->daoEnvio = DaoEnvio::getInstance();
		}

		public function agregar($radio, $direccionElegida){
		
			if(isset($_SESSION['pedido'])){

				try {
					$mensaje = '';

					$pedido = $_SESSION['pedido'];
					$pedidoCargado = $this->controladoraPedido->agregar($pedido);

					if($radio === 'porDireccionElegida'){

						ini_set('date.timezone','America/Buenos_Aires'); 
						$hora = date("H:i:s");
						$hoy = date("d-m-y"); 

						$envio = new Envio($direccionElegida, $hoy, $hora, $pedidoCargado);

						$this->daoEnvio->insertar($envio);
					}

				} catch (Exception $e) {
					$mensaje= $e->getMessage();

				}	finally{
		
					header('Location: ' . BASE . 'paginaPrincipal/inicio');

					if(!empty($mensaje)){
						echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
					}
				}
			}
		}

		public function modificar(){

		}

		public function eliminar(){
			
		}


	}
	?>