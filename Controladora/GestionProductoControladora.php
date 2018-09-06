<?php  
namespace Controladora;

use Modelo\Producto as Producto;
use Modelo\TipoCerveza as TipoCerveza;
use Modelo\Foto as Foto;

//use Dao\Listas\DaoListaProducto as DaoProducto;
use Dao\BD\DaoBDProducto as DaoProducto;

//use Dao\Listas\DaoListaTipoCerveza as DaoTipoCerveza;
use Dao\BD\DaoBDTipoCerveza as DaoTipoCerveza;

use Exception;

	/**
	* 
	*/
	class GestionProductoControladora{
		
		private $daoListaProducto;
		private $daoListaTipoCerveza;

		function __construct(){
			$this->daoListaProducto= DaoProducto::getInstance();
			$this->daoListaTipoCerveza= DaoTipoCerveza::getInstance();

		}

		public function vistaAgregar(){

			try{
				$mensaje = '';
				$listadoTipoCerveza= $this->daoListaTipoCerveza->getAllTiposCervezas();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Producto/altaProducto.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function vistaModificar(){
			
			try{
				$mensaje = '';
				$listadoProductos= $this->daoListaProducto->getAllProductos();
				$listadoTipoCerveza= $this->daoListaTipoCerveza->getAllTiposCervezas();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Producto/modificarProducto.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function vistaEliminar(){
			
			try{
				$mensaje = '';
				$listadoProductos= $this->daoListaProducto->getAllProductos();

			}	catch(Exception $e){
				$mensaje = $e->getMessage();

			}	finally {

				require(ROOT . 'Vistas/TemplateBase/header.php');
				require(ROOT . 'Vistas/TemplateBase/navHeader.php');
				require(ROOT . 'Vistas/Producto/bajaProducto.php');
				require(ROOT . 'Vistas/TemplateBase/footer.php');

				if(!empty($mensaje)){
					echo '<script> alert("' . $mensaje . '")</script>';
				}
			}
		}

		public function agregar($nombre, $factor, $capacidad, $idTipoCerveza){

			if (!empty($_FILES['foto']['name'])) {
				$foto= $_FILES['foto'];

			}	else{
				$foto= null;
			}

			try{
				$mensaje="";

				$rutaFoto= new Foto();
				$rutaFoto->subirFoto($foto, "Productos");

				$tipoCerveza= $this->daoListaTipoCerveza->buscar($idTipoCerveza);
				$producto= new Producto($nombre, $factor, $capacidad, $tipoCerveza, $rutaFoto);
				$this->daoListaProducto->insertar($producto);

			}	catch(Exception $e){
				$mensaje= $e->getMessage();

			}	finally{

				$this->vistaAgregar();

				if(!empty($mensaje)){
					echo '<script>alert("' . $mensaje . '")</script>'; 
				}
			}
		}

		public function modificar($idModif, $nombre, $factor, $capacidad, $idTipoCerveza){
			
			if (!empty($_FILES['foto']['name'])) {
				$foto= $_FILES['foto'];

			}	else{
				$foto= null;
			}
			
			try{
				$mensaje="";
				
				$rutaFoto= new Foto();
				$rutaFoto->subirFoto($foto, "Productos");

				$tipoCerveza= $this->daoListaTipoCerveza->buscar($idTipoCerveza);
				$producto= new Producto($nombre, $factor, $capacidad, $tipoCerveza, $rutaFoto);
				
				$this->daoListaProducto->modificar($idModif, $producto);

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

				$this->daoListaProducto->borrar($id);

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
				
				$producto= $this->daoListaProducto->buscar($id);

				$_SESSION['productoModif']= $producto;

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