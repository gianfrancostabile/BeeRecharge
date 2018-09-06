<?php 
namespace Vistas\Sucursal; 

use Modelo\Sucursal as Sucursal;

if (isset($_SESSION['sucursalModif'])) {
	$sucursal= $_SESSION['sucursalModif'];
}

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">	

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Modificar Sucursal</h2>
		</header>

		<form action="<?= BASE ?>gestionSucursal/buscar" method="POST" class="px-4 py-3">

			<div class="form-inline" id="campoBuscar">

				<div class="form-group">

					<label for="idModif" class="col-form-label">Nombre Sucursal: </label>
					<select name="sucursal" id="nombreBuscar" class="custom-select mx-md-3" required>
						<?php  

						echo "<option value=''>Elija una...</option>";
						foreach ($listado as $key => $value) {
							echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
						}

						?>
					</select>

					<input type="submit" class="btn btn-primary" value="Buscar">

				</div>

			</div>	

		</form>

	</article>

	<?php if (isset($_SESSION['sucursalModif'])) {	?>


	<article class="container fondo-secondary border-all-primary mt-3">

		<form action="<?= BASE ?>gestionSucursal/modificar" method="POST" class="px-4 py-3">

			<input type="number" name="idViejo" value="<?= $sucursal->getId() ?>" hidden></input>

			<div class="form-group">
				<label for="nombre" class="col-form-label">Nombre: </label>
				<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingrese el Nombre" value="<?= $sucursal->getNombre() ?>" required></input>
			</div>

			<div class="row">

				<div class="form-group col-sm-6">
					<label for="direccion" class="col-form-label">Dirección: </label>
					<input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese la Dirección" value="<?= $sucursal->getDireccion() ?>"  required></input>
				</div>	

				<div class="form-group col-sm-6">
					<label for="telefono" class="col-form-label">Teléfono: </label>
					<input type="text" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Ingrese la Teléfono" value="<?= $sucursal->getTelefono() ?>"  required></input>
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
if (isset($_SESSION["sucursalModif"])) {
	unset($_SESSION["sucursalModif"]);
}
?>