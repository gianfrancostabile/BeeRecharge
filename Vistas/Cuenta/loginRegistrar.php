<?php 
namespace Vistas\Cuenta;

?>	

<article class="container pt-3">

	<ul class="nav nav-tabs" id="tabLoginRegistrarse">

		<li class="nav-item">
			<a class="nav-link active" data-target="#panelLogin" id="botonLogearse" data-toggle="tab" href="#login" aria-controls="login" aria-selected="true">Logearse</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" data-target="#panelRegistrarse" id="botonRegistrarse" data-toggle="tab" href="#registrarse" aria-controls="registrarse" aria-selected="false">Registrarse</a>
		</li>

	</ul>

	<div class="tab-content fondo-secondary border-blr-primary">
		<article id="panelLogin" class="tab-pane active" id="login" role="tabpanel" aria-labelledby="login-tab">
			<?php require(ROOT . 'Vistas/Cuenta/Login/loginCuenta.php'); ?>
		</article>

		<article id="panelRegistrarse" class="tab-pane" id="registrarse" role="tabpanel" aria-labelledby="registrarse-tab">
			<?php require(ROOT . 'Vistas/Cuenta/Registrar/registrarCuenta.php'); ?>			
		</article>
	</div>

</article>
