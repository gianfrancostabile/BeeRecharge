<?php  
namespace Controladora;

use Modelo\TipoCerveza as TipoCerveza;

	//use Dao\Listas\DaoListaTipoCerveza as DaoTipoCerveza;
use Dao\BD\DaoBDTipoCerveza as DaoTipoCerveza;

use Exception;

	/**
	* 
	*/
	class GestionTipoCervezaControladora{
		
		private $daoTipoCerveza;

		function __construct(){
			$this->daoTipoCerveza= DaoTipoCerveza::getInstance();
			
		}

		public function vistaAgregar(){
			
			require(ROOT . 'Vistas/TemplateBase/header.php');
			require(ROOT . 'Vistas/TemplateBase/navHeader.php');
			require(ROOT . 'Vistas/TipoCerveza/altaTipoCerveza.php');
			require(ROOT . 'Vistas/TemplateBase/footer.php');
		}

		public function vistaModificar(){
			
			try{
				$mensaje = '';
				$listado= $this->daoTipoCerveza->getAllTiposCervezas();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/TipoCerveza/modificarTipoCerveza.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function vistaEliminar(){
			
			try{
				$mensaje = '';
				$listado= $this->daoTipoCerveza->getAllTiposCervezas();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/TipoCerveza/bajaTipoCerveza.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function agregar($nombre, $precioLitro, $descripcion){

			try{

				$mensaje="";

				$tipoCerveza= new TipoCerveza($nombre, $descripcion, $precioLitro);
				$this->daoTipoCerveza->insertar($tipoCerveza);

			}	catch(Exception $e){	
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaAgregar();
				
				if(!empty($mensaje)){
					echo '<script>alert("' . $mensaje . '")</script>'; 
				}
			}
		}

		public function modificar($idModif, $nombre, $precioLitro, $descripcion){
			
			try{
				$mensaje="";

				$tipoCerveza= new TipoCerveza($nombre, $descripcion, $precioLitro);
				$this->daoTipoCerveza->modificar($idModif, $tipoCerveza);

			}	catch(Exception $e){
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaModificar();
				
				if(!empty($mensaje)){
					echo '<script>alert("' . $mensaje . '")</script>'; 
				}
			}

		}

		public function eliminar($id){
			
			try{
				$mensaje="";

				$this->daoTipoCerveza->borrar($id);

			}	catch(Exception $e){
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaEliminar();
				
				if(!empty($mensaje)){
					echo '<script>alert("' . $mensaje . '")</script>'; 
				}
			}
		}

		public function buscar($id){
			
			try{
				$mensaje="";
				
				$tipoCerveza= $this->daoTipoCerveza->buscar($id);
				$_SESSION['tipoCervezaModif']= $tipoCerveza;
				
			}	catch(Exception $e){
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaModificar();

				if(!empty($mensaje)){
					echo '<script>alert("' . $mensaje . '")</script>'; 
				}
			}
		}
	}
	?>