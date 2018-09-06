<?php 
namespace Vistas\Producto; 

?>



<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">	

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Alta Producto</h2>
		</header>

		<form action="<?= BASE ?>gestionProducto/agregar" method="POST" enctype="multipart/form-data" class="px-4 py-3">

			<div class="form-group">
				<label for="nombre" class="col-form-label">Nombre: </label>
				<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingrese el Nombre" required></input>
			</div>

			<div class="row">

				<div class="form-group col-sm-6" id="campoFactor">
					<label for="factor" class="col-form-label">Factor: </label>
					<input type="text" class="form-control form-control-sm" id="factor" name="factor" placeholder="Ingrese el Factor" required></input>
				</div>	

				<div class="form-group col-sm-6" id="campoCapacidad">
					<label for="capacidad" class="col-form-label">Capacidad: </label>
					<input type="text" class="form-control form-control-sm" id="capacidad" name="capacidad" placeholder="Ingrese la capacidad" required></input>
				</div>

			</div>

			<div class="row">

				<div class="form-group col-sm-6" id="campoTipoCerveza">
					<label for="tipoCerveza" class="col-form-label">Tipo Cerveza: </label>
					<select name="tipoCerveza" id="tipoCerveza" class="custom-select" required>
						<?php  

						echo "<option value=''>Elija una...</option>";
						foreach ($listadoTipoCerveza as $key => $value) {
							echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";

						}

						?>
					</select>
				</div>	

				<div class="form-group col-sm-6">
					<label for="foto" class="col-form-label">Foto del Producto: </label>
					<input type="file" id="foto" name="foto" class="form-control-sm" style="color: transparent;" required>
				</div>

			</div>

			<footer class="text-center mt-2">
				<a href="<?= BASE ?>paginaPrincipal/menuAdmin" class="btn btn-secondary">Salir</a>
				<input type="submit" class="btn btn-primary" id="inputAgregar" value="Agregar">
			</footer>

		</form>

	</article>

</div>
