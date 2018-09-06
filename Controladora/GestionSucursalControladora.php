<?php  
namespace Controladora;

use Modelo\Sucursal as Sucursal;
use Modelo\Direccion as Direccion;

	//use Dao\Listas\DaoListaSucursal as DaoSucursal;
use Dao\BD\DaoBDSucursal as DaoSucursal;

use Exception;

	/**
	* 
	*/
	class GestionSucursalControladora{
		
		private $daoSucursal;

		function __construct(){
			$this->daoSucursal= DaoSucursal::getInstance();

		}

		public function vistaAgregar(){

			require(ROOT . 'Vistas/TemplateBase/header.php');
			require(ROOT . 'Vistas/TemplateBase/navHeader.php');
			require(ROOT . 'Vistas/Sucursal/altaSucursal.php');
			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

		public function vistaModificar(){

			try{
				$mensaje = '';
				$listado= $this->daoSucursal->getAllSucursales();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Sucursal/modificarSucursal.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function vistaEliminar(){
			
			try{
				$mensaje = '';
				$listado= $this->daoSucursal->getAllSucursales();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Sucursal/bajaSucursal.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function vistaSucursales(){

			try{
				$mensaje = '';
				$listado= $this->daoSucursal->getAllSucursales();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Sucursal/verSucursales.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function agregar($nombre, $direccion, $telefono){

			try{
				$mensaje="";

				$sucursal= new Sucursal($nombre, $direccion, $telefono);

				$this->daoSucursal->insertar($sucursal);

			}	catch(Exception $e){	
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaAgregar($mensaje);

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
			
		}

		public function modificar($idModif, $nombre, $direccion, $telefono){
			try{
				$mensaje="";

				$sucursal= new Sucursal($nombre,$direccion,$telefono);

				$this->daoSucursal->modificar($idModif, $sucursal);

			}	catch(Exception $e){
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaModificar();

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function eliminar($id){
			try{
				$mensaje="";

				$this->daoSucursal->borrar($id);

			}	catch(Exception $e){
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaEliminar();

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function buscar($id){
			
			try{
				$mensaje="";
				
				$sucursal= $this->daoSucursal->buscar($id);

				$_SESSION['sucursalModif']= $sucursal;
				
			}	catch(Exception $e){
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaModificar();

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}
	}
	?>