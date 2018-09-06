<?php 
namespace Vistas\Sucursal; 

use Modelo\Sucursal as Sucursal;

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">	

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Baja Sucursal</h2>
		</header>

		<form action="<?= BASE ?>gestionSucursal/eliminar" method="POST" class="px-4 py-3">

			<div class="form-inline" id="campoEliminar">

				<div class="form-group">

					<label for="idEliminar" class="col-form-label">Nombre Sucursal: </label>
					<select name="sucursal" id="nombreEliminar" class="custom-select mx-md-3" required>
						<?php  

						echo "<option value=''>Elija una...</option>";
						foreach ($listado as $key => $value) {
							echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
						}

						?>
					</select>

					<input type="submit" class="btn btn-primary" value="Borrar">

				</div>

			</div>	

		</form>

	</article>

</div>
