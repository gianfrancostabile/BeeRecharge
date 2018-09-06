<?php 
namespace Vistas;

?>


	<!--

		Comienzo de la lista de productos

	-->

	<div class="pt-3 pb-5">

		<article id="listaProductos" class="container mb-3 px-5 fondo-secondary border-all-primary">

			<header id="headerListaProductos" class="text-center fuente-montserrat">
				<h2>Productos Disponibles</h2>
				<p class="color-gray fuente-lato">Estos son algunos de los productos disponibles a la venta.</p>
			</header>

			<section class="row">
				
				<?php foreach ($listado as $key => $value) { ?>

				<article class="col-lg-3 col-md-4 col-sm-6 mb-4">
					
					<div class="card">
						
						<a href="<?= $value->getFotoDireccion() ?>" data-fancybox="group" data-caption="Cerveza <?= $value->getNombre() ?> de <?= $value->getCapacidad() ?>ml." data-from="card" class="card-img-top">
							<img src="<?= $value->getFotoDireccion() ?>" alt="Cerveza <?= $value->getNombre() ?>"/>
						</a>

						<div class="card-footer">
							<h5 class="card-title text-center"><?= $value->getNombre() . " " . $value->getCapacidad() . "ml."?></h5>
						</div>

					</div>

				</article>

				<?php } ?>	

			</section>

		</article>

	</div>
	<!--

		Fin de la lista de productos

	-->

	<!--
	
		Inicio Mapa Google Maps

	-->
	<div id="mapaSucursalesIndex" class="fondo-secondary">

		<header id="headerMapa" class="text-center fuente-montserrat py-4">
			<h2>Mapa con las Sucursales</h2>
			<p class="color-gray fuente-lato">Aqui podrás visualizar las Sucursales con sus respectivas direcciones.</p>
		</header>

		<div id="map">

		</div>

		<!-- 

			Inicio sucursales del google maps 

		-->
		<div class="table-responsive mt-4 quitarContenedor">

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

					<?php if (!empty($listadoSucursales)){ ?>
					<?php foreach ($listadoSucursales as $key => $value) { ?>
					
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
		<!-- 

			Fin sucursales del google maps 

		-->

	</div>
	<!--
	
		Fin Mapa Google Maps

	-->
