<?php 
namespace Vistas\Pedido; 

use Modelo\Pedido as Pedido;

$listadoProductosPedido = array();
$indice = 1;

if (isset($_SESSION['pedido'])) {
	$pedido = $_SESSION['pedido'];

	$listadoProductosPedido = $pedido->getLineasPedidos();
	$titular = $pedido->getTitular();

}	else{
	header('Location: ' . BASE . 'paginaPrincipal/inicio');
	
}

?>

<div class="pt-3">

	<article class="container fondo-secondary border-all-primary">

		<header id="headerListaProductos" class="text-center fuente-montserrat">
			<h2>Pedido</h2>
			<p class="color-gray fuente-lato">Proceso de creación de su propio pedido.</p>
		</header>

		
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
						<th scope="col">Eliminar</th>
					</tr>
				</thead>

				<tbody>
					<?php if (!empty($listadoProductosPedido)){ ?>
					<?php foreach ($listadoProductosPedido as $key => $value) { ?>

					<form action="<?= BASE ?>gestionLineaPedido/eliminar" method="POST">

						<input type="number" name="idProducto" value="<?= $value->getProducto()->getId() ?>" hidden>

						<tr>
							<th><label><?= $indice ?></label></th>
							<td><label><?= $value->getProducto()->getNombre() ?></label></td>
							<td><label>$ <?= $value->getProducto()->getTipoCerveza()->getPrecioLitro() ?></label></td>
							<td><label><?= $value->getProducto()->getCapacidad() ?> ml.</label></td>
							<td><label><?= $value->getCantidad() ?></label></td>
							<td><label>$ <?= $value->getSubtotal() ?></label></td>
							<td><button type="submit" class="btn btn-danger cursor-pointer" id="inputProductoEliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
						</tr>
					</form>

					<?php $indice++; } ?>	
					<?php } else { ?>

					<tr>	
						<th colspan="8" class="text-center"><label>No hay Lineas de Pedido que mostrar</label></th>
					</tr>

					<?php } ?>
				</tbody>

			</table>
			
		</div>

		<footer class="text-right my-2">
			<a href="<?= BASE ?>paginaPrincipal/tienda" class="btn btn-secondary">Salir</a>
			<a href="<?= BASE ?>gestionPedido/vistaAgregarSucursal" class="btn btn-primary" id="inputSiguiente">Siguiente</a>
		</footer>

	</article>

</div>

