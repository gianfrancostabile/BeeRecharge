<?php 
namespace Vistas\Sucursal; 

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">	

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Alta Sucursal</h2>
		</header>

		<form action="<?= BASE ?>gestionSucursal/agregar" method="POST" class="px-4 py-3">

			<div class="form-group">
				<label for="nombre" class="col-form-label">Nombre: </label>
				<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingrese el Nombre" required></input>
			</div>

			<div class="row">

				<div class="form-group col-sm-6">
					<label for="direccion" class="col-form-label">Dirección: </label>
					<input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese la Dirección" required></input>
				</div>	

				<div class="form-group col-sm-6">
					<label for="telefono" class="col-form-label">Teléfono: </label>
					<input type="text" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Ingrese la Teléfono" required></input>
				</div>

			</div>

			<footer class="text-center mt-2">
				<a href="<?= BASE ?>paginaPrincipal/menuAdmin" class="btn btn-secondary">Salir</a>
				<input type="submit" class="btn btn-primary" id="inputAgregar" value="Agregar">
			</footer>

		</form>

	</article>

</div>