<?php 
namespace Vistas\Producto; 

if (isset($_SESSION['productoModif'])) {
	$producto= $_SESSION['productoModif'];
}

?>


<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">	

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Modificar Producto</h2>
		</header>
		
		<form action="<?= BASE ?>gestionProducto/buscar" method="POST" class="px-4 py-3">

			<div class="form-inline" id="campoBuscar">

				<div class="form-group">

					<label for="idModif" class="col-form-label">Nombre Producto: </label>
					<select name="producto" id="nombreEliminar" class="custom-select mx-md-3" required>
						<?php  

						echo "<option value=''>Elija una...</option>";
						foreach ($listadoProductos as $key => $value) {
							echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . " " . $value->getCapacidad() . "ml.</option>";
						}

						?>
					</select>

					<input type="submit" class="btn btn-primary" value="Buscar">

				</div>

			</div>	

		</form>

	</article>

	<?php if (isset($_SESSION['productoModif'])) {	?>

	
	<article class="container fondo-secondary border-all-primary mt-3">

		<form action="<?= BASE ?>gestionProducto/modificar" method="POST" enctype="multipart/form-data" 
			class="mx-2 my-2">

			<input type="number" name="idViejo" value="<?= $producto->getId() ?>" hidden></input>

			<div class="form-group">
				<label for="nombre" class="col-form-label">Nombre: </label>
				<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingrese el Nombre" value="<?= $producto->getNombre() ?>" required></input>
			</div>

			<div class="row">

				<div class="form-group col-sm-6" id="campoFactor">
					<label for="factor" class="col-form-label">Factor: </label>
					<input type="text" class="form-control form-control-sm" id="factor" name="factor" placeholder="Ingrese el Factor" value="<?= $producto->getFactor() ?>" required></input>
				</div>	

				<div class="form-group col-sm-6" id="campoCapacidad">
					<label for="capacidad" class="col-form-label">Capacidad: </label>
					<input type="text" class="form-control form-control-sm" id="capacidad" name="capacidad" placeholder="Ingrese la capacidad" value="<?= $producto->getCapacidad() ?>" required></input>
				</div>

			</div>

			<div class="row">
				
				<div class="form-group col-sm-6" id="campoTipoCerveza">
					<label for="tipoCerveza" class="col-form-label">Tipo Cerveza: </label>
					<select name="tipoCerveza" id="tipoCerveza" class="custom-select" required>
						<?php  
						echo "<option value=''>Elija una...</option>";
						foreach ($listadoTipoCerveza as $key => $value) {

							if ($value->getId() === $producto->getTipoCerveza()->getId()) {
								echo "<option value='" . $value->getId() . "' selected>" . $value->getNombre() . "</option>";
								
							}	else{

								echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
							}
						}
						
						?>
					</select><br>
				</div>	

				<div class="form-group col-sm-6">
					<label for="foto" class="col-form-label">Foto del Producto: </label>
					<input type="file" id="foto" name="foto" class="form-control-sm" style="color: transparent;" required>
				</div>

			</div>

			<footer class="text-center mt-2">
				<a href="<?= BASE ?>paginaPrincipal/menuAdmin" class="btn btn-secondary">Salir</a>
				<input type="submit" class="btn btn-primary" id="inputModificar" value="Modificar">
			</footer>

		</form>
		
	</article>

	<?php }	?>

</div>


<?php 
if (isset($_SESSION["productoModif"])) {
	unset($_SESSION["productoModif"]);
}
?>