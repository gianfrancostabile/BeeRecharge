<?php 
namespace Vistas\Producto; 

use Modelo\Producto as Producto;

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">	

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Baja Producto</h2>
		</header>
		
		<form action="<?= BASE ?>gestionProducto/eliminar" method="POST" class="px-4 py-3">

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

					<input type="submit" class="btn btn-primary" value="Borrar">

				</div>

			</div>	

		</form>

	</article>

</div>

