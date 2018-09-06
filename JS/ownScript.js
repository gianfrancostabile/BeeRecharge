
/* 


INICIO SCRIPTS QUE APLICAN SOBRE EL BODY 


*/
var body = $('body'), 
height_navbar = $('#barraNavegacion').outerHeight(),
height_footer = $('#footer-site').outerHeight();

body.css('padding-top', height_navbar);	
body.css('padding-bottom', height_footer);
/* 


FIN SCRIPTS QUE APLICAN SOBRE EL BODY 


*/



/* ---------------------------------------------------------------------------------------------------------------------- */



/* 


INICIO SCRIPTS QUE APLICAN SOBRE LA TIENDA 


*/
var fn_win_scroll = function($window, $boton) {

	var body = $('body'),
	paddingB_body = body.css("padding-bottom").split('px'),
	height_scrolled = $window.scrollTop(),
	height_document = $(document).height() - paddingB_body[0],
	height_window = $window.outerHeight();


	if((height_scrolled + height_window + 18) >= height_document){
		$boton.removeClass('fixed-scroll');
		$boton.addClass('position-absolute');
		$boton.css('bottom', '18px');

	}	else {
		$boton.removeClass('position-absolute');
		$boton.addClass('fixed-scroll');
		$boton.css('bottom', '1%');
	}
}

var btn_flotante = $('#btn-flotante');
btn_flotante.css('right', '1%');
fn_win_scroll($(window), btn_flotante);

$(window).scroll(function(){
	fn_win_scroll($(this), btn_flotante);
});
/* 


FIN SCRIPTS QUE APLICAN SOBRE LA TIENDA 


*/



/* ---------------------------------------------------------------------------------------------------------------------- */



/* 


INICIO SCRIPTS QUE APLICAN SOBRE EL SLIDER DEL INDEX 


*/
var sliderIndex = $('#sliderIndex');
sliderIndex.css('margin-top', -height_navbar); //contrarestro el padding top que tiene el body
/* 


FIN SCRIPTS QUE APLICAN SOBRE EL SLIDER DEL INDEX 


*/



/* ---------------------------------------------------------------------------------------------------------------------- */



/* 


INICIO SCRIPTS QUE APLICAN SOBRE EL GOOGLE MAPS


*/
var map;

function initMap() {

	var initPos = {lat: -37.997162, lng: -57.54972};

	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 13,
		center: initPos,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	$('.sucursalRow').each(function(){

		var direccionSucursal = $(this).find('label[data-type="DireccionSucursal"]').html();
		var nombreSucursal = $(this).find('label[data-type="NombreSucursal"]').html();
		var telefonoSucursal = $(this).find('label[data-type="TelefonoSucursal"]').html();

		var resSucursal = direccionSucursal + ', Mar del Plata, Buenos Aires, Argentina';
		var geocoderSucursal = new google.maps.Geocoder();

		geocoderSucursal.geocode({ 'address': resSucursal }, geocodeResult);

		function geocodeResult(results, status) {

			if (status == 'OK') {

				var markerOptions = { 
					position: results[0].geometry.location,
					map: map,
					icon: '../Imagenes/iconoBar.png',
					title: nombreSucursal
				}
				var marker = new google.maps.Marker(markerOptions);

				var contentString = '<div id="content">'+
				'<div id="siteNotice">'+
				'</div>'+
				'<h4 id="firstHeading" class="firstHeading">' + nombreSucursal + '</h4>'+
				'<div id="bodyContent">'+
				'<p>Dirección: ' + direccionSucursal + 
				'<br>Teléfono: ' + telefonoSucursal + '</p>'+
				'</div>'+
				'</div>';

				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});

				marker.addListener('click', function() {
					map.setZoom(14);
					map.setCenter(marker.getPosition());
					infowindow.open(map, marker);
				});

			} else {
				alert("Geocoding no tuvo éxito debido a: " + status);
			}
		}
	});


}

$(document).ready(function(){

	var radiobtn_sucursal = $('input[type="radio"][name="sucursales"]');

	radiobtn_sucursal.change(function(){

		var direccion = $(this).attr('data-target');
		var res = direccion + ', Mar del Plata, Buenos Aires, Argentina';
		var geocoder = new google.maps.Geocoder();

		geocoder.geocode({ 'address': res }, geocodeResult);

		function geocodeResult(results, status) {

			if (status == 'OK') {
				
				map.setZoom(16);
				map.setCenter(results[0].geometry.location);

			} else {
				alert("Geocoding no tuvo éxito debido a: " + status);
			}
		}
	});
});
/* 


FIN SCRIPTS QUE APLICAN SOBRE EL GOOGLE MAPS


*/



/* ---------------------------------------------------------------------------------------------------------------------- */



/* 


INICIO SCRIPTS QUE APLICAN SOBRE EL LOGIN/REGISTRAR


*/
$(document).ready(function(){

	var btn_logearse = $('#inputLogearse');

	btn_logearse.on('click', function(e){

		e.preventDefault();

		var iconoCarga = $('#iconoCarga');
		var mensajeSuccess = $('#alert-success-login');
		var mensajeDanger = $('#alert-danger-login');

		$.ajax({

			url : '../gestionCuenta/login',
			data : 	$("#formularioLogearse").serialize(),
			type : 'POST',

			beforeSend : function(){
				iconoCarga.show();
			},

			success : function(rta){

				if(rta.trim() == "ok"){
					setTimeout(function(){

						iconoCarga.hide();
					}, 1000);

					mensajeSuccess.show(1000);
					setTimeout(function(){

						mensajeSuccess.hide(1000);
						window.location = '../paginaPrincipal/inicio';
					}, 3000);


				}	else {
					console.log(rta);

					setTimeout(function(){

						iconoCarga.hide();
					}, 1000);

					mensajeDanger.show(1000);
					setTimeout(function(){

						mensajeDanger.hide(1000);
					}, 3000);
				}
			}
		});
	});

});


$(document).ready(function(){

	var btn_registrarse = $('#inputRegistrarse');

	btn_registrarse.on('click', function(e){

		e.preventDefault();

		var iconoCarga = $('#iconoCarga');
		var mensajeSuccess = $('#alert-success-registrar');
		var mensajeDanger = $('#alert-danger-registrar');

		$.ajax({

			url : '../gestionCuenta/registrar',
			data : 	$("#formularioRegistrarse").serialize(),
			type : 'POST',

			beforeSend : function(){
				iconoCarga.show();
			},

			success : function(rta){

				if(rta.trim() == "ok"){
					setTimeout(function(){

						iconoCarga.hide();
					}, 1000);

					mensajeSuccess.show(1000);
					setTimeout(function(){

						mensajeSuccess.hide(1000);
					}, 3000);

				}	else {
					console.log(rta);

					setTimeout(function(){

						iconoCarga.hide();
					}, 1000);

					mensajeDanger.show(1000);
					setTimeout(function(){

						mensajeDanger.hide(1000);
					}, 3000);
				}
			}
		});
	});
});

$('#tabLoginRegistrarse a').on('click', function (e) {
	e.preventDefault();
	$(this).tab('show');
});
/* 


FIN SCRIPTS QUE APLICAN SOBRE EL LOGIN/REGISTRAR


*/

$('.carousel').carousel({
	interval: 4000
})