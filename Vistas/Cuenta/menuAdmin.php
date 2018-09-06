<?php  
namespace Vistas\Cuenta;


if (isset($_SESSION['cuentaUsuario'])) {
	$cuenta = $_SESSION['cuentaUsuario'];

	if ($cuenta->getTipoUsuario() !== 'Administrador') {
		header('Location: ' . BASE . 'paginaPrincipal/inicio');
	}

}	else {
	header('Location: ' . BASE . 'paginaPrincipal/inicio');
}

?>

<div class="pt-3" id="panelAdmin">

	<article class="container fondo-secondary border-all-primary">	

		<header class="text-center fuente-montserrat border-bottom-primary pt-4">
			<h2>Panel Administrativo</h2>
		</header>

		<div class="px-4 py-3">

			<ul id="menuAdmin" class="listStyle-none">

				<li>

					<h4 class="fuente-montserrat pt-2" data-tipo="submenu-admin">-Menú Tipos de Cervezas</h4>
					<ul class="list-group">

						<li class="list-group-item"><a href="<?= BASE ?>gestionTipoCerveza/vistaAgregar" class="btn">Agregar un Tipo de Cerveza</a></li>
						<li class="list-group-item"><a href="<?= BASE ?>gestionTipoCerveza/vistaModificar" class="btn">Modificar un Tipo de Cerveza</a></li>
						<li class="list-group-item"><a href="<?= BASE ?>gestionTipoCerveza/vistaEliminar" class="btn">Eliminar un Tipo de Cerveza</a></li>

					</ul>

				</li>

				<li>

					<h4 class="fuente-montserrat pt-5" data-tipo="submenu-admin">-Menú Productos</h4>
					<ul class="list-group">

						<li class="list-group-item"><a href="<?= BASE ?>gestionProducto/vistaAgregar" class="btn">Agregar un Producto</a></li>
						<li class="list-group-item"><a href="<?= BASE ?>gestionProducto/vistaModificar" class="btn">Modificar un Producto</a></li>
						<li class="list-group-item"><a href="<?= BASE ?>gestionProducto/vistaEliminar" class="btn">Borrar un Producto</a></li>
						<br>

					</ul>

				</li>

				<li>

					<h4 class="fuente-montserrat pt-5" data-tipo="submenu-admin">-Menú Sucursales</h4>
					<ul class="list-group">

						<li class="list-group-item"><a href="<?= BASE ?>gestionSucursal/vistaAgregar" class="btn">Agregar una Sucursal</a></li>
						<li class="list-group-item"><a href="<?= BASE ?>gestionSucursal/vistaModificar" class="btn">Modificar una Sucursal</a></li>
						<li class="list-group-item"><a href="<?= BASE ?>gestionSucursal/vistaEliminar" class="btn">Borrar una Sucursal</a></li>

					</ul>
				
				</li>

				<li>

					<h4 class="fuente-montserrat pt-5" data-tipo="submenu-admin">-Menú Pedidos</h4>
					<ul class="list-group">

						<li class="list-group-item"><a href="<?= BASE ?>gestionPedido/listaPedidosAdmin" class="btn">Ver todos los Pedidos</a></li>

					</ul>
				
				</li>

			</ul>	
		</div>

	</article>

</div>
