<?php 
namespace Vistas\TemplateBase;

$cuenta = null;

if (isset($_SESSION['cuentaUsuario'])) {
	$cuenta = $_SESSION['cuentaUsuario'];
}	

?>			


<nav class="navbar navbar-expand-md fondo-secondary fuente-lato border-bottom-primary eliminarSeleccion fixed-top" id="barraNavegacion">

	<a class="navbar-brand" href="<?= BASE ?>paginaPrincipal/inicio">BeeRecharge</a>

	<button class="navbar-toggler btn-letter-primary cursor-pointer" type="button" data-toggle="collapse" data-target="#listaItems">
		<i class="fa fa-bars fa-lg" aria-hidden="true"></i>
	</button>

	<div class="collapse navbar-collapse" id="listaItems">

		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link btn-letter-primary" id="btn-Inicio" href="<?= BASE ?>paginaPrincipal/inicio">INICIO</a>
			</li>
			<li class="nav-item">
				<a class="nav-link btn-letter-primary" id="btn-Tienda" href="<?= BASE ?>paginaPrincipal/tienda">TIENDA</a>
			</li>
			<li class="nav-item">
				<a class="nav-link btn-letter-primary" id="btn-Sucursales" href="<?= BASE ?>gestionSucursal/vistaSucursales">SUCURSALES</a>
			</li>
			<li class="nav-item">
				<a class="nav-link btn-letter-primary" id="btn-MasInfo" href="#">MAS INFO</a>
			</li>

			<?php if (!is_null($cuenta)) { ?>

			<li class="nav-item">
				<a class="nav-link btn-letter-primary" id="btn-Novedades" href="<?= BASE ?>gestionPedido/listaPedidosUsuario">TUS PEDIDOS</a>
			</li>

			<?php if ($cuenta->getTipoUsuario() === 'Administrador') {	?>

			<li class="nav-item">
				<a class="nav-link btn-letter-primary" id="btn-Novedades" href="<?= BASE ?>paginaPrincipal/menuAdmin">ADMIN</a>
			</li>

			<?php } ?>

			<?php } ?>
		</ul>

		<div id="login-registrarse" class="d-flex flex-nowrap">

			<?php if (is_null($cuenta)) { ?>
			<a class="nav-link btn btn-outline-primary fx" href="<?= BASE ?>gestionCuenta/vistaLoginRegistrar">
				Iniciar Sesión
			</a>

			<?php } else { ?>
			<div class="text-info font-weight-bold">	
				<?= substr($cuenta->getPersona()->getNombre(), 0, 14) ?>
			</div>

			<!--
			<?php if (!is_null($cuenta->getFotoPerfil())) { ?>

			<img id="fotoPerfilNavBar" src="<?= $cuenta->getFotoPerfil() ?>" alt="Foto de Perfil" class="ml-2">

			<?php } ?> 
		-->

		<a href="<?= BASE ?>gestionCuenta/cerrarSession" class="btn btn-danger btn-sm ml-2 rounded btn-cerrarSesion" title="Cerrar Sesión"><i class="fa fa-power-off text-white" aria-hidden="true"></i></a>
		<?php } ?>
	</div>

</div>

</nav>


<script>
	$(document).ready(function(){

		btn_tienda = $('#btn-Tienda');

		btn_tienda.click(function(event){

			event.preventDefault();

			if ('<?= is_null($cuenta) ?>') {
				alert('Debes estar Logeado para acceder a la tienda...');
				window.location = '<?= BASE ?>gestionCuenta/vistaLoginRegistrar';

			}	else {
				window.location = $(this).attr('href');
			} 

		});
	});
</script>