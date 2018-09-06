<?php  
namespace Vistas\Pedido;

if (!isset($listado)) {
	header('Location: ' . BASE . 'paginaPrincipal/inicio');
}
?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">

		<header id="headerListaProductos" class="text-center fuente-montserrat">
			<h2>Lista de Tus Pedidos</h2>
			<p class="color-gray fuente-lato">Aqui encontraras los pedidos que haz realizado.</p>
		</header>

		<div class="table-responsive">

			<table class="table table-hover mt-3">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Sucursal</th>
						<th scope="col">Total</th>
						<th scope="col">Fecha Emitida</th>
						<th scope="col">Estado</th>
						<th scope="col">Detalles</th>
					</tr>
				</thead>

				<tbody>
					<?php if (!empty($listado)){ ?>
					<?php foreach ($listado as $key => $value) { ?>

					<form action="<?= BASE ?>gestionPedido/vistaDetallePedido" method="POST">

						<input type="number" name="idPedido" value="<?= $value->getId() ?>" hidden>

						<tr>
							<td><label><?= $value->getId() ?></label></td>
							<td><label><?= $value->getSucursal()->getNombre() ?></label></td>
							<td><label>$ <?= $value->getTotal() ?></label></td>
							<td><label><?= $value->getFecha() ?></label></td>
							<td><label><?= $value->getEstado() ?></label></td>
							<td><button type="submit" class="btn btn-secondary cursor-pointer"><i class="fa fa-info" aria-hidden="true"></i></button></td>
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