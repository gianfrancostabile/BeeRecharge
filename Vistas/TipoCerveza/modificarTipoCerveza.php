<?php 
namespace Vistas\TipoCerveza; 

use Modelo\TipoCerveza as TipoCerveza;

if (isset($_SESSION['tipoCervezaModif'])) {
	$tipoCerveza= $_SESSION['tipoCervezaModif'];
}

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Modificar Tipo de Cerveza</h2>
		</header>

		<form action="<?= BASE ?>gestionTipoCerveza/buscar" method="POST" class="px-4 py-2">
			
			<div class="form-inline" id="campoBuscar">
				
				<div class="form-group">
					<label for="nombreModif" class="col-form-label">Nombre Tipo Cerveza: </label>
					<select name="tipoCerveza" id="nombreModificar" class="custom-select mx-sm-3" required>
						<?php  

						echo "<option value=''>Elija una...</option>";
						foreach ($listado as $key => $value) {
							echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
						}
						?>
					</select>
					

					<input type="submit" class="btn btn-primary" id="inputBuscar" value="Buscar">
				</div>
				
			</div>	

		</form>

	</article>

	<?php if(isset($_SESSION["tipoCervezaModif"])) { ?>
	
	<article class="container fondo-secondary border-all-primary mt-3">

		<form action="<?= BASE ?>gestionTipoCerveza/modificar" method="POST" class="mx-2 my-2">

			<input type="number" name="idModif" value="<?= $tipoCerveza->getId() ?>" hidden>

			<div class="row">

				<div class="form-group col-sm-6" id="campoNombre">
					<label for="nombre" class="col-form-label">Nombre: </label>
					<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingrese el Nombre del Tipo de Cerveza" value="<?= $tipoCerveza->getNombre() ?>" required></input>
				</div>	

				<div class="form-group col-sm-6">
					<label for="precioLitro" class="col-form-label">Precio por Litro: </label>
					<input type="text" class="form-control form-control-sm" id="precioLitro" name="precioLitro" placeholder="Ingrese el Precio por Litro" value="<?= $tipoCerveza->getPrecioLitro() ?>" required></input>
				</div>
			</div>

			<div class="form-group" id="campoDescripcion">
				<label for="descripcion" class="col-form-label">Descripción: </label>
				<textarea class="form-control form-control-sm campoDescripcion" id="descripcion" name="descripcion" placeholder="Describa al tipo de cerveza..." rows="3" required><?= $tipoCerveza->getDescripcion() ?></textarea>
			</div>	

			<footer class="text-center mt-2">
				<a href="<?= BASE ?>paginaPrincipal/menuAdmin" class="btn btn-secondary">Salir</a>
				<input type="submit" class="btn btn-primary" id="inputModificar" value="Modificar">
			</footer>
		</form>

	</article>
	<?php } ?>

</div>


<?php 
if (isset($_SESSION["tipoCervezaModif"])) {
	unset($_SESSION["tipoCervezaModif"]);
}
?>