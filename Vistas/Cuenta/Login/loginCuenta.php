<?php 
namespace Vistas\Cuenta\Login; 

?>


<form action="" method="POST" enctype="multipart/form-data" class="px-4 py-3" id="formularioLogearse">

	<div class="form-group">
		<label for="emailLogin" class="col-form-label">Email: </label>
		<input type="email" class="form-control form-control-sm" id="emailLogin" name="email" placeholder="ej.: ejemplo@hotmail.com">
	</div>

	<div class="form-group">
		<label for="contraLogin" class="col-form-label">Contraseña: </label>
		<input type="password" class="form-control form-control-sm" id="contraLogin" name="contra" placeholder="Ingrese su contraseña">
	</div>
	
	<div id="mensajes">
		<div id="alert-success-login" class="alert alert-success quitarContenedor" role="alert">
			Datos cargados correctamente!
		</div>

		<div id="alert-danger-login" class="alert alert-danger quitarContenedor" role="alert">
			Datos cargados erroneamente...
		</div>
	</div>

	<div class="text-center">

		<i id="iconoCarga" class="fa fa-spinner fa-pulse fa-2x fa-fw quitarContenedor"></i>
		<a href="<?= BASE ?>paginaPrincipal/inicio" class="btn btn-secondary">Salir</a>
		<input type="submit" class="btn btn-primary" id="inputLogearse" value="Logearse">

	</div>
</form>
