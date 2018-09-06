<?php 
namespace Vistas\Pedido;

if(isset($pedido)){
	$titular = $pedido->getTitular();
	$sucursal = $pedido->getSucursal();
	$listaLineaPedido = $pedido->getLineasPedidos();

	$indice = 1;

}	else {
	header('Location: ' . BASE . 'paginaPrincipal/inicio');
}
?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Detalle del Pedido</h2>
		</header>

		<div class="px-4 py-3">
			
			<div>
				<ul class="listStyle-none d-flex justify-content-between">
					<li><label><strong>Nro. Pedido: </strong><?= $pedido->getId() ?></label></li>
					<li><label><strong>Fecha Emitida: </strong><?= $pedido->getFecha() ?></label></li>
					<li><label><strong>Estado: </strong><?= $pedido->getEstado() ?></label></li>
				</ul>
			</div>

			<div class="row">

				<div class="col-sm-6">
					<h4 class="text-center titulo-submenu">Datos Cliente</h4>
					<ul class="listStyle-none">
						<li><label><strong>Nombre: </strong><?= $titular->getNombre() . " " . $titular->getApellido() ?></label></li>
						<li><label><strong>DNI: </strong><?= $titular->getDni() ?></label></li>
						<li><label><strong>Teléfono: </strong><?= $titular->getTelefono() ?></label></li>
					</ul>
				</div>

				<div class="col-sm-6">
					<h4 class="text-center titulo-submenu">Datos de la Sucursal</h4>
					<ul class="listStyle-none">
						<li><label><strong>Nombre: </strong><?= $sucursal->getNombre() ?></label></li>
						<li><label><strong>Dirección: </strong><?= $sucursal->getDireccion() ?></label></li>
						<li><label><strong>Teléfono: </strong><?= $sucursal->getTelefono() ?></label></li>
					</ul>
				</div>

			</div>

			<div>
				<h4 class="titulo-submenu">Detalle: </h4>

				
				<div class="table-responsive">

					<table class="table table-hover mt-3">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nombre</th>
								<th scope="col">Precio x Litro</th>
								<th scope="col">Capacidad</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Subtotal</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($listaLineaPedido as $key => $value) { ?>

							<tr>
								<th><label><?= $indice ?></label></th>
								<td><label><?= $value->getProducto()->getNombre() ?></label></td>
								<td><label>$ <?= $value->getProducto()->getTipoCerveza()->getPrecioLitro() ?></label></td>
								<td><label><?= $value->getProducto()->getCapacidad() ?> ml.</label></td>
								<td><label><?= $value->getCantidad() ?></label></td>
								<td><label>$ <?= $value->getSubtotal() ?></label></td>
							</tr>

							<?php $indice++; } ?>

							<tr>
								<th colspan="5"><label>TOTAL</label></th>
								<th><label>$ <?= $pedido->getTotal() ?></label></th>
							</tr>	

						</tbody>

					</table>
					
				</div>	

			</div>

		</div>

	</article>

</div>