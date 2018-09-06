<?php 
namespace Vistas\Pedido; 

?>

<article>
	
	<form action="<?= BASE ?>gestionPedido/agregarSucursal" method="POST">
		
		<?php require(ROOT . 'Vistas/Sucursal/verSucursales.php'); ?>

		<div class="container">
			<footer class="text-right my-2">
				<a href="<?= BASE ?>gestionPedido/vistaLineasPedido" class="btn btn-secondary">Volver Atrás</a>
				<input type="submit" class="btn btn-primary" id="inputSiguiente" value="Siguiente">
			</footer>
		</div>
	</form>

</article>