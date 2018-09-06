<?php  
namespace Vistas\Tienda;

use Modelo\Pedido as Pedido;

if (isset($_SESSION['cuentaUsuario'])) {
	
	$listadoProductosPedido = array();
	$cantidadProductosPedido = 0;

	if (isset($_SESSION['pedido'])) {
		$pedido = $_SESSION['pedido'];
		$listadoProductosPedido = $pedido->getListaProductos();

		$cantidadProductosPedido = count($listadoProductosPedido);
	}

}	else {
	header('Location: ' . BASE . 'paginaPrincipal/inicio');
}


?>


<article id="lista-productos" class="pt-3 position-relative">	

	<div class="container px-0">
		<header id="header" class="text-center fondo-secondary border-all-primary fuente-montserrat pt-1 mb-4">
			<h2>Tienda</h2>
			<p class="color-gris fuente-lato">Aqui podrá seleccionar las Cervezas que quiera comprar.</p>
		</header>
	</div>

	<div class="container fondo-secondary border-all-primary">

		<?php if(!empty($listado)) { ?>
		<section class="row card-group">

			<!-- INICIO FOREACH -->
			<?php foreach ($listado as $key => $value) {	?>

			<!-- INICIO PRODUCTO -->


			<!--


				PRODUCTO A AGREGAR


			-->
			<?php if(!in_array($value, $listadoProductosPedido)) {	?>

			<article class="col-lg-3 col-md-4 col-sm-6 my-2">

				<div class="card" data-identidad="productoTienda">

					<a href="<?= $value->getFotoDireccion() ?>" data-fancybox data-caption="Cerveza <?= $value->getNombre() ?> de <?= $value->getCapacidad() ?>ml." data-from="card" class="card-img-top">
						<img src="<?= $value->getFotoDireccion() ?>" alt="Cerveza <?= $value->getNombre() ?>"/>
					</a>

					<hr>

					<div class="card-body">

						<h5 class="card-title text-center"><strong><?= substr($value->getNombre(), 0, 14) ?></strong></h5>

						<p class="card-text">
							Precio por Litro: $ <?= $value->getTipoCerveza()->getPrecioLitro() ?><br>
							Capacidad: <?= $value->getCapacidad() ?> ml.<br>
							Precio Total: $ <?= $value->calcularPrecioCapacidad() ?>
						</p>

						<div class="text-center">
							<button type="button" class="btn btn-secondary cursor-pointer" data-toggle="modal" data-target="#modalInfo<?= $key ?>"><i class="fa fa-info" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-success cursor-pointer" data-toggle="modal" data-target="#modalAgregar<?= $key ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
						</div>

					</div>

				</div>

			</article>

			<!-- INICIO MODAL -->
			<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregar<?= $key ?>" aria-labelledby="modalAgregar<?= $key ?>" aria-hidden="true">

				<div class="modal-dialog" role="document">

					<div class="modal-content">

						<div class="modal-header">

							<h5 class="modal-title"><strong>Cerveza <?= $value->getNombre() ?></strong></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>

						</div>

						<div class="modal-body">

							<form action="<?= BASE ?>gestionLineaPedido/agregar" method="POST">

								<input type="number" name="idProducto" value="<?= $value->getId() ?>" hidden>

								<div class="form-inline">
									<div class="form-group">
										<label for="cantidadProducto" class="col-form-label">Cantidad: </label>
										<input type="number" name="cantProducto" min="1" value="1" id="cantidadProducto" class="form-control form-control-sm ml-sm-2 " required>
									</div>
								</div>	

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<input type="submit" class="btn btn-primary" id="inputProductoAgregar" value="Agregar">
								</div>

							</form>

						</div>
					</div>
				</div>
			</div>
			<!-- FIN MODAL -->

			<?php } else { ?>


			<!--


				PRODUCTO A ELIMINAR


			-->
			<article class="col-lg-3 col-md-4 col-sm-6 my-2">

				<div class="card" data-identidad="productoTienda">

					<form action="<?= BASE ?>gestionLineaPedido/eliminar" method="POST">

						<a href="<?= $value->getFotoDireccion() ?>" data-fancybox data-caption="Cerveza <?= $value->getNombre() ?> de <?= $value->getCapacidad() ?>ml." data-from="card" class="card-img-top">
							<img src="<?= $value->getFotoDireccion() ?>" alt="Cerveza <?= $value->getNombre() ?>"/>
						</a>

						<hr>

						<div class="card-body">

							<input type="number" name="idProducto" value="<?= $value->getId() ?>" hidden>
							<h5 class="card-title text-center"><strong><?= substr($value->getNombre(), 0, 14) ?></strong></h5>

							<p class="card-text">
								Precio por Litro: $ <?= $value->getTipoCerveza()->getPrecioLitro() ?><br>
								Capacidad: <?= $value->getCapacidad() ?> ml.<br>
								Precio Total: $ <?= $value->calcularPrecioCapacidad() ?>
							</p>

							<div class="text-center">
								<button type="button" class="btn btn-secondary cursor-pointer" data-toggle="modal" data-target="#modalInfo<?= $key ?>"><i class="fa fa-info" aria-hidden="true"></i></button>
								<button type="submit" class="btn btn-danger cursor-pointer"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
							</div>

						</div>


					</form>
				</div>

			</article>

			<?php } ?>

			<!-- FIN PRODUCTO -->

			<!-- INICIO MODAL -->
			<div class="modal fade" tabindex="-1" role="dialog" id="modalInfo<?= $key ?>" aria-labelledby="modalInfo<?= $key ?>" aria-hidden="true">

				<div class="modal-dialog" role="document">

					<div class="modal-content">

						<div class="modal-header">

							<h5 class="modal-title"><strong>Cerveza <?= $value->getNombre() ?></strong></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>

						</div>

						<div class="modal-body">

							<div class="row">
								<img class="img-cerveza-tienda col-md-4" src="<?= $value->getFotoDireccion() ?>" alt="Cerveza <?= $value->getNombre() ?>" data-from="modal">

								<p class="col-md-8">
									<strong>Precio por Litro:</strong> $ <?= $value->getTipoCerveza()->getPrecioLitro() ?>.
									<br>
									<strong>Capacidad:</strong> <?= $value->getCapacidad() ?> ml.
									<br>
									<strong>Tipo de Cerveza:</strong> <?= $value->getTipoCerveza()->getNombre() ?>.
									<br>
									<strong>Descripción:</strong> <?= $value->getTipoCerveza()->getDescripcion() ?>.
								</p>
							</div>

						</div>

					</div>

				</div>

			</div>
			<!-- FIN MODAL -->


			<?php } ?>
			<!-- FIN FOREACH -->

		</section>

		<?php } else { ?>

		<h2 class="my-3 text-center">No hay productos en este índice...</h2>

		<?php } ?>



		<!-- 

			INICIO PAGINACION 

		-->
		<?php if(!empty($listado)) { ?>
		<hr>
		<nav aria-label="navPaginacion">

			<ul class="pagination justify-content-center">

				<!-- INICIO BOTONES ANTERIORES A LA PAGINA ACTUAL -->
				<!-- ENTRA SI ES LA PAGINA ACTUAL ES LA PRIMERA PAGINA DE LA PAGINACION -->
				<?php if($pagina == 1){ ?>

				<li class="page-item disabled">
					<span class="page-link"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
				</li>

				<!-- ENTRA SI LA PAGINA ACTUAL NO ES LA PRIMERA DE LA PAGINACION -->
				<?php } else { ?>

				<!-- ICONO 'atras' -->
				<li class="page-item">
					<a class="page-link" href="<?= BASE ?>paginaPrincipal/tienda/<?= $pagina-1 ?>">
						<i class="fa fa-angle-double-left" aria-hidden="true"></i>
					</a>
				</li>

				<?php if($pagina-2 >= 1) { ?>
				<li class="page-item">
					<a class="page-link" href="<?= BASE ?>paginaPrincipal/tienda/<?= $pagina-2 ?>">
						<?= $pagina-2 ?>
					</a>
				</li>
				<?php } ?>

				<li class="page-item">
					<a class="page-link" href="<?= BASE ?>paginaPrincipal/tienda/<?= $pagina-1 ?>">
						<?= $pagina-1 ?>
					</a>
				</li>

				<?php } ?>
				<!-- FIN BOTONES ANTERIORES A LA PAGINA ACTUAL -->



				<!-- PAGINA ACTUAL -->
				<li class="page-item active">
					<a class="page-link"  href="<?= BASE ?>paginaPrincipal/tienda/<?= $pagina ?>">
						<?= $pagina ?>
						<span class="sr-only">(current)</span>
					</a>
				</li>


				<!-- INICIO BOTONES DESPUES A LA PAGINA ACTUAL -->
				<!-- ENTRA SI ES LA PAGINA ACTUAL ES LA ULTIMA PAGINA DE LA PAGINACION -->
				<?php if($pagina == $cantidadPaginas){ ?>

				<li class="page-item disabled">
					<span class="page-link">
						<i class="fa fa-angle-double-right" aria-hidden="true"></i>
					</span>
				</li>

				<!-- ENTRA SI LA PAGINA ACTUAL NO ES LA ULTIMA DE LA PAGINACION -->
				<?php } else { ?>

				<li class="page-item">
					<a class="page-link" href="<?= BASE ?>paginaPrincipal/tienda/<?= $pagina+1 ?>">
						<?= $pagina+1 ?>
					</a>
				</li>

				<?php if($pagina+2 <= $cantidadPaginas) { ?>
				<li class="page-item">
					<a class="page-link" href="<?= BASE ?>paginaPrincipal/tienda/<?= $pagina+2 ?>">
						<?= $pagina+2 ?>
					</a>
				</li>
				<?php } ?>

				<!-- ICONO 'adelante' -->
				<li class="page-item">
					<a class="page-link" href="<?= BASE ?>paginaPrincipal/tienda/<?= $pagina+1 ?>">
						<i class="fa fa-angle-double-right" aria-hidden="true"></i>
					</a>
				</li>

				<?php }  ?>
				<!-- FIN BOTONES DESPUES A LA PAGINA ACTUAL -->


			</ul>
		</nav>

		<?php } ?>
		<!-- 

			FIN PAGINACION 

		-->

	</div>

	<a id="btn-flotante" href="<?= BASE ?>gestionPedido/vistaLineasPedido" class="btn btn-info fixed-scroll"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= $cantidadProductosPedido ?></a>

</article>
