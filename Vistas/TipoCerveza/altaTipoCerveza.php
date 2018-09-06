<?php 
	namespace Vistas\TipoCerveza;
	
?>	
	
	<div class="pt-3">
		
		<article class="container fondo-secondary border-all-primary">	

			<header class="text-center fuente-montserrat border-bottom-primary pt-4">
				<h2>Alta Tipo de Cerveza</h2>
			</header>

			<form action="<?= BASE ?>gestionTipoCerveza/agregar" method="POST" class="px-4 py-3">

				<div class="row">

					<div class="form-group col-sm-6" id="campoNombre">
						<label for="nombre" class="col-form-label">Nombre: </label>
						<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingrese el Nombre del Tipo de Cerveza" required></input>
					</div>	

					<div class="form-group col-sm-6">
						<label for="precioLitro" class="col-form-label">Precio por Litro: </label>
						<input type="text" class="form-control form-control-sm" id="precioLitro" name="precioLitro" placeholder="Ingrese el Precio por Litro" required></input>
					</div>
				</div>

				<div class="form-group" id="campoDescripcion">
					<label for="descripcion" class="col-form-label">Descripción: </label>
					<textarea class="form-control form-control-sm campoDescripcion" id="descripcion" name="descripcion" placeholder="Describa al tipo de cerveza..." rows="3" required></textarea>
				</div>	

				<footer class="text-center mt-2">
					<a href="<?= BASE ?>paginaPrincipal/menuAdmin" class="btn btn-secondary">Salir</a>
					<input type="submit" class="btn btn-primary" id="inputAgregar" value="Agregar">
				</footer>

			</form>

		</article>

	</div>