<?php  
namespace Modelo;
use Exception as Exception;

	/**
	* 
	*/
	class Foto{
		
		private $direccion;

		public function subirFoto($foto, $carpeta){
			
			$carpetas= array("Perfiles", "Productos");

			if (!empty($foto)) {

				if (in_array($carpeta, $carpetas)) {
					$imageDirectory = ROOT . 'Imagenes/' . $carpeta . '/';
					

					if(!file_exists($imageDirectory)){
						mkdir($imageDirectory);

					}

					if($foto['name'] != ''){
						
						$extensionesPermitidas= array('png', 'jpg');
						$tamanioMaximo= 5000000;
						$nombreArchivo= basename($foto['name']);

						$file = $imageDirectory . $nombreArchivo;	

						$fileExtension = pathinfo($file, PATHINFO_EXTENSION);

						if(in_array($fileExtension, $extensionesPermitidas)){

							if($foto['size'] < $tamanioMaximo){ 
								
								if(move_uploaded_file($foto["tmp_name"], $file)){	

									$ruta= BASE . 'Imagenes/' . $carpeta . '/' . $nombreArchivo;
									$this->direccion= $ruta;
									
								}	else
								throw new Exception("Error al mover la Foto.");	
								
							}	else
							throw new Exception("Error, Se excedio el tamaño permitido.");	
							
						}	else
						throw new Exception("Error, formato de foto no permitida.");	
						
					}	else
					throw new Exception("Error, pongale un nombre a la foto.");	

				}	else
				throw new Exception("Error, selecciono la carpeta de destino incorrecta.");

			}	else
			$this->direccion= null;	

		}

		
		public function getDireccion(){
			return $this->direccion;
		}

		public function setDireccion($newVal){
			return $this->direccion= $newVal;
		}
	}

	?>