<?php 
namespace Vistas\Cuenta\Registrar; 

?>


<form action="" method="POST" enctype="multipart/form-data" class="px-4 py-3" id="formularioRegistrarse">

	<div class="row">
		<div class="form-group col-sm-6">
			<label for="nombre" class="col-form-label">Nombre: </label>
			<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingrese su Nombre" minlength="2" required value="Pepe"></input>
		</div>	

		<div class="form-group col-sm-6">
			<label for="apellido" class="col-form-label">Apellido: </label>
			<input type="text" class="form-control form-control-sm" id="apellido" name="apellido" placeholder="Ingrese su Apellido" minlength="2" required value="Langa"></input>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6">
			<label for="dni" class="col-form-label">DNI: </label>
			<input type="text" class="form-control form-control-sm" id="dni" name="dni" placeholder="Ingrese su DNI" minlength="4" required value="465789789"></input>
		</div>	

		<div class="form-group col-sm-6">
			<label for="telefono" class="col-form-label">Teléfono / Celular: </label>
			<input type="text" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Ingrese su Número de Teléfono" minlength="7" required value="1112345646"></input>
		</div>
	</div>	

	<div class="row">
		<div class="form-group col-sm-6">
			<label for="localidad" class="col-form-label">Localidad: </label>
			<input type="text" class="form-control form-control-sm" id="localidad" name="localidad" placeholder="ej.: Mar del Plata" required value="Mar del Plata"></input>
		</div>	

		<div class="form-group col-sm-6">
			<label for="fecha" class="col-form-label">Fecha de Nacimiento: </label>
			<input type="date" class="form-control form-control-sm" id="fecha" name="fecha" placeholder="Ingrese su Fecha de Nacimiento" minlength="6" required value="1998-03-20"></input>
		</div>	
	</div>	

	<div class="row">
		<div class="form-group col-sm-6">
			<label for="direccion" class="col-form-label">Direccion: </label>
			<input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese su Domicilio" minlength="6" required value="JB Justo 001"></input>
		</div>

		<div class="form-group col-sm-6">
			<label for="email" class="col-form-label">E-mail: </label>
			<input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="ej.: ejemplo@hotmail.com" required value="pepito@gmail.com"></input>
		</div>	
	</div>	

	<div class="row">
		<div class="form-group col-sm-6">
			<label for="contrasenia1" class="col-form-label">Contraseña: </label>
			<input type="password" class="form-control form-control-sm" id="contrasenia1" name="contrasenia1" placeholder="Ingrese su Contraseña" minlength="7" required value="peperoni"></input>
		</div>

		<div class="form-group col-sm-6">
			<label for="contrasenia2" class="col-form-label">Repita la Contraseña: </label>
			<input type="password" class="form-control form-control-sm" id="contrasenia2" name="contrasenia2" placeholder="Repita su Contraseña" minlength="7" required value="peperoni"></input>
		</div>
	</div>	

	<div class="form-group">
		<label for="foto" class="col-form-label">Foto de Perfil: </label>
		<input type="file" id="foto" name="foto" style="color: transparent;">
	</div>

	<div id="mensajes">
		<div id="alert-success-registrar" class="alert alert-success quitarContenedor" role="alert">
			Datos cargados correctamente!
		</div>

		<div id="alert-danger-registrar" class="alert alert-danger quitarContenedor" role="alert">
			Datos cargados erroneamente...
		</div>
	</div>

	<div class="text-center">
		<i id="iconoCarga"  class="fa fa-spinner fa-pulse fa-2x fa-fw quitarContenedor"></i>
		<a href="<?= BASE ?>paginaPrincipal/inicio" class="btn btn-secondary">Salir</a>
		<input type="submit" class="btn btn-primary" id="inputRegistrarse" value="Registrarse">
	</div>
</form>
