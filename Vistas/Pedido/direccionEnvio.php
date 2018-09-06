<?php  
namespace Vistas\Pedido;

if (isset($_SESSION['pedido'])) {
	$pedido = $_SESSION['pedido'];

	$sucursal = $pedido->getSucursal();

}	else {
	header('Location: ' . BASE . 'paginaPrincipal/inicio');
}

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">

		<header id="headerListaProductos" class="text-center fuente-montserrat">
			<h2>Elegir dirección</h2>
		</header>



		<form action="<?= BASE ?>gestionEnvio/agregar" method="POST">

			<div class="row px-3">

				<label class="col-sm-6 custom-control custom-radio mr-0">
					<input id="radioSucursal" name="radio" type="radio" class="custom-control-input" value="porSucursal" data-target="#panelDireccionSucursal" data-otro="#panelDireccionElegida" required>
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Retirar desde la Sucursal</span>
				</label>

				<label class="col-sm-6 custom-control custom-radio mr-0">
					<input id="radioDireccion" name="radio" type="radio" class="custom-control-input" value="porDireccionElegida" data-target="#panelDireccionElegida" data-otro="#panelDireccionSucursal" required>
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Ingresar una dirección</span>
				</label>

			</div>

			<div id="panelDireccionSucursal" class="quitarContenedor">

				<div class="form-inline w-100">

					<div class="form-group w-100">

						<div class="input-group w-100">
							<label class="input-group-addon" for="direccionSucursal">Dirección: </label>
							<input type="text" class="form-control" placeholder="Direccion de la Sucursal" id="direccionSucursal" name="direccion1" value="<?= $sucursal->getDireccion() ?>" disabled>
						</div>

					</div>

				</div>

			</div>

			<div id="panelDireccionElegida" class="quitarContenedor">

				<div class="form-inline w-100">

					<div class="form-group w-100">

						<div class="input-group w-100">
							<label class="input-group-addon" for="direccionUsuario">Dirección: </label>
							<input type="text" class="form-control" placeholder="Ingrese la Dirección" id="direccionUsuario" name="direccion2" value="<?= $pedido->getTitular()->getDireccion() ?>">
						</div>

					</div>

				</div>

			</div>

			<footer class="text-right my-2">
				<a href="<?= BASE ?>gestionPedido/vistaAgregarSucursal" class="btn btn-secondary">Volver Atrás</a>
				<input type="submit" class="btn btn-primary" id="finalizar" value="Finalizar Pedido">
			</footer>

		</form>

	</article>

</div>

<script>
	
	$(document).ready(function(){

		var radio = $('input[type="radio"]');

		radio.change(function(){

			var panel = $($(this).attr('data-target'));
			var panel_otro = $($(this).attr('data-otro'));

			panel_otro.hide(750);
			panel.toggle(750);
		});

	});

</script>