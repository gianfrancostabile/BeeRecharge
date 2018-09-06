<?php 
namespace Vistas\Sucursal;

use Modelo\Sucursal as Sucursal;

if (!isset($listado)) {
	echo '<script language="javascript">alert("No hay Sucursales Cargadas...");</script>'; 
	header('Location: ' . BASE . 'paginaPrincipal/inicio');

}
?>

	<!--
	
		Inicio Mapa Google Maps

	-->

	<div class="pt-3">
		
		<article class="container fondo-secondary border-all-primary">

			<header id="headerListaProductos" class="text-center fuente-montserrat">
				<h2>Sucursales</h2>
				<p class="color-gray fuente-lato">Estas son las Sucursales con las que estamos trabajando.</p>
			</header>

			<div id="map">

			</div>

			
			<div class="table-responsive mt-4">

				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nombre</th>
							<th scope="col">Dirección</th>
							<th scope="col">Teléfono</th>
						</tr>
					</thead>

					<tbody>

						<?php if (!empty($listado)){ ?>
						<?php foreach ($listado as $key => $value) { ?>
						
						<tr class="sucursalRow">

							<td scope="row">
								<input type="radio" name="sucursales" id="radio<?= $key ?>" data-target="<?= $value->getDireccion() ?>" value="<?= $value->getId() ?>" required>
							</td>
							<td>
								<label for="radio<?= $key ?>" data-type="NombreSucursal"><?= $value->getNombre() ?></label>
							</td>
							<td>
								<label for="radio<?= $key ?>" data-type="DireccionSucursal"><?= $value->getDireccion() ?></label>
							</td>
							<td>
								<label for="radio<?= $key ?>" data-type="TelefonoSucursal"><?= $value->getTelefono() ?></label>
							</td>

						</tr>


						<?php } ?>	
						<?php } else { ?>

						<tr>	
							<th colspan="8" class="text-center"><label>No hay Sucursales que mostrar</label></th>
						</tr>

						<?php } ?>
					</tbody>

				</table>
				
			</div>	

			<p class="font-weight-light font-italic text-right">(*) Selecciona el circulo de la columna para visualizar la sucursal en el mapa.</p>

		</article>

	</div>

	<!--
	
		Fin Mapa Google Maps

	-->