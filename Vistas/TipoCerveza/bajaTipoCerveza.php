<?php 
	namespace Vistas\TipoCerveza; 

	use Modelo\TipoCerveza as TipoCerveza;
?>


	<div class="pt-3">

		<article class="container fondo-secondary border-all-primary">

			<header class="text-center fuente-montserrat border-bottom-primary pt-4">
				<h2>Eliminar Tipo de Cerveza</h2>
			</header>

			<form action="<?= BASE ?>gestionTipoCerveza/eliminar" method="POST" class="px-4 py-2">
				
				<div class="form-inline" id="campoEliminar">
					
					<div class="form-group">
						<label for="nombreModif" class="col-form-label">Nombre Tipo Cerveza: </label>
						<select name="tipoCerveza" id="nombreEliminar" class="custom-select mx-sm-3" required>
							<?php  

								echo "<option value=''>Elija una...</option>";
								foreach ($listado as $key => $value) {
									echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
								}
							?>
						</select>
					

						<input type="submit" class="btn btn-primary" id="inputEliminar" value="Eliminar">
					</div>
					
				</div>	

			</form>

		</article>

	</div>