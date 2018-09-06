<?php  
namespace Vistas\Pedido;

if (isset($listado)) {
	$listaEstados = array('Solicitado', 'En Proceso', 'Enviado', 'Finalizado');

}	else {
	header('Location: ' . BASE . 'paginaPrincipal/inicio');
	
}

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">

		<header id="headerListaProductos" class="text-center fuente-montserrat">
			<h2>Lista de Todos Pedidos</h2>
			<p class="color-gray fuente-lato">Aqui encontraras todos los pedidos que se realizaron.</p>
		</header>

		<form action="<?= BASE ?>gestionPedido/listaPedidosAdmin" method="POST" class="row text-center px-4 py-3">
			<label class="col-sm-3 col-6"><strong>Busqueda por: </strong></label>
			<label class="col-sm-3 col-6"><input type="radio" name="busquedaRadio" id="radioCliente" data-target="#inputBusqueda" value="Cliente" required checked> Cliente</label>
			<label class="col-sm-3 col-6"><input type="radio" name="busquedaRadio" id="radioFecha" data-target="#inputBusqueda" value="Fecha" required> Fecha</label>
			<label class="col-sm-3 col-6"><input type="radio" name="busquedaRadio" id="radioSucursal" data-target="#inputBusqueda" value="Sucursal" required> Sucursal</label>

			<div class="form-inline pt-2">
				<div class="form-group">
					<label class="col-form-label" for="inputBusqueda">Petición: </label>
					<input type="text" name="datoABuscar" id="inputBusqueda" class="form-control mx-2" placeholder="Ingrese el DNI del Cliente." required>
					<input type="submit" class="btn btn-primary" value="Enviar Petición">
				</div>
			</div>

		</form>

		<div class="table-responsive">

			<table class="table table-hover mt-3">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">DNI Cliente</th>
						<th scope="col">Sucursal</th>
						<th scope="col">Total</th>
						<th scope="col">Fecha Emitida</th>
						<th scope="col">Estado</th>
						<th scope="col">Detalles</th>
						<th scope="col">Actualizar</th>
					</tr>
				</thead>

				<tbody>
					<?php if (!empty($listado)){ ?>

					<?php foreach ($listado as $key => $value) { ?>

					<form action="<?= BASE ?>gestionPedido/formListaPedidosAdmin" method="POST">

						<input type="number" name="idPedido" value="<?= $value->getId() ?>" hidden>

						<tr>
							<td><label><?= $value->getId() ?></label></td>
							<td><label><?= $value->getTitular()->getDni() ?></label></td>
							<td><label><?= $value->getSucursal()->getNombre() ?></label></td>
							<td><label>$ <?= $value->getTotal() ?></label></td>
							<td><label><?= $value->getFecha() ?></label></td>
							<td>
								<select name="estado" id="estado" class="custom-select" required>

									<?php foreach ($listaEstados as $key2 => $value2) {

										if ($value2 === $value->getEstado()) { ?>
										<option value='<?= $value2 ?>' selected><?= $value2 ?></option>

										<?php }	else{	?>
										<option value='<?= $value2 ?>'><?= $value2 ?></option>

										<?php }	
									}


									?>
								</select><br>
							</td>

							<td><button type="submit" name="btn_detalle" value="btn_detalle" class="btn btn-secondary cursor-pointer"><i class="fa fa-info" aria-hidden="true"></i></button></td>
							<td><button type="submit" name="btn_actualizar" value="btn_actualizar" class="btn btn-success cursor-pointer"><i class="fa fa-refresh" aria-hidden="true"></i></button></td>

						</tr>

					</form>

					<?php } ?>	
					<?php } else { ?>

					<tr>	
						<th colspan="8" class="text-center"><label>No hay Pedidos que mostrar</label></th>
					</tr>

					<?php } ?>

				</tbody>

			</table>
			
		</div>

	</article>

</div>

<script>
	
	$(document).ready(function(){

		var radio_buttonBusqueda = $('input[name=busquedaRadio]');

		radio_buttonBusqueda.change(function(){

			if ($(this).attr('value') === 'Fecha') {
				$($(this).attr('data-target')).attr('type', 'date');

			}	else {
				$($(this).attr('data-target')).attr('type', 'text');

				if ($(this).attr('value') === 'Cliente') {
					$($(this).attr('data-target')).attr('placeholder', 'Ingrese el ID del Cliente.');

				}	else {
					$($(this).attr('data-target')).attr('placeholder', 'Ingrese el Nombre de la Sucursal.');
				}
			}
		});

	});

</script>