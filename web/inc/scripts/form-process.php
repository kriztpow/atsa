<?php 
//proceso del formulario

function recogeDato($campo){ 
     return isset($_REQUEST[$campo])?$_REQUEST[$campo]:'';
}

//a quienes llegan los formularios
$paraSubscriptor = 'voces@atsa.org.ar';
$paraContacto    = 'web@atsa.org.ar';
$paraPieForm     = 'web@atsa.org.ar';
$paraAfiliate    = 'web@atsa.org.ar';

$form_type      = recogeDato('form_type'); 
$cabeceras      = 'MIME-Version: 1.0' . "\r\n";
$cabeceras     .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras     .= 'From: ATSA <web@atsa.org.ar>' . "\r\n";
//exito del formulario
$exito = 0;


switch ( $form_type ) {
//formulario de subscripcion en voces de sanidad
	case 'subscribe':
		global $cabeceras;
		global $paraSubscriptor;
		global $exito;
		$emailSubscriptor = recogeDato('email-subs'); 

		$asunto = 'Nuevo Subscriptor';
		$mensaje = 'Email nuevo: ' . $emailSubscriptor;
		mail($paraSubscriptor, $asunto, $mensaje, $cabeceras);

		$exito = 1;
		echo $exito;
		break;

//formulario de la página de contacto
	case 'contact':
		global $cabeceras;
		global $paraContacto;
		global $exito;
		$email        = recogeDato('email');
		$nombre       = recogeDato('name');
		$emailConfirm = recogeDato('email-confirm');
		$asunto       = recogeDato('subjet');
		$section      = recogeDato('section');
		$texto        = recogeDato('msj');

		$cabeceras .= 'Reply-To: ' . $email . "\r\n";

		$mensaje  = 'Nombre: ' . $nombre . '<br>';
		$mensaje .= 'Email: ' . $email . '<br>';
		$mensaje .= 'Section: ' . $section . '<br>';
		$mensaje .= $texto;

		mail($paraContacto, $asunto, $mensaje, $cabeceras);
		$exito = 1;
		echo $exito;
		break;

//formulario del footer
	case 'footer-form':
		global $paraPieForm;
		global $cabeceras;
		global $exito;
		$email        = recogeDato('email');
		$nombre       = recogeDato('name');
		$texto        = recogeDato('msj');
		$asunto       = 'Nuevo mensaje de contacto';
		$cabeceras .= 'Reply-To: ' . $email . "\r\n";

		$mensaje  = 'Nombre: ' . $nombre . '<br>';
		$mensaje .= 'Email: ' . $email . '<br>';
		$mensaje .= $texto;

		mail($paraPieForm, $asunto, $mensaje, $cabeceras);
		$exito = 1;
		echo $exito;
		break;

//formulario de la página de afiliacion
	case 'afiliate':
		global $cabeceras;
		global $paraAfiliate;
		global $exito;
		$email           = recogeDato('email');
		$apellido        = recogeDato('apellido');
		$nombre          = recogeDato('nombre');
		$nacionalidad    = recogeDato('nacionalidad');
		$estadocivil     = recogeDato('estadocivil');
		$sexo            = recogeDato('sexo');
		$fechanacimiento = recogeDato('fechanacimiento');
		$profesion       = recogeDato('profesion');
		$estudios        = recogeDato('estudios');
		$cuil            = recogeDato('cuil');
		$dni             = recogeDato('dni');
		$discapacidad    = recogeDato('discapacidad');
		$calle           = recogeDato('calle');
		$altura          = recogeDato('altura');
		$piso            = recogeDato('piso');
		$depto           = recogeDato('depto');
		$codigopostal    = recogeDato('codigopostal');
		$localidad       = recogeDato('localidad');
		$otros           = recogeDato('otros');
		$celular         = recogeDato('celular');
		$tel             = recogeDato('tel');
		$obsTel          = recogeDato('obs-tel');
		$obsEmail        = recogeDato('obs-email');
		$cuitempresa     = recogeDato('cuitempresa');
		$nombreempresa   = recogeDato('nombreempresa');
		$fechaingreso    = recogeDato('fechaingreso');
		$msj             = recogeDato('msj');

		if ( $discapacidad == '' ) {
			$discapacidad = 'No';
		} else {
			$discapacidad = 'Sí';
		}
		//ahora va el mensaje
		$asunto          = 'Nuevo Afiliado - ATSA';
		$cabeceras      .= 'Reply-To: ' . $email . "\r\n";

		$mensaje  = 'Nombre: ' . $nombre . '<br>';
		$mensaje .= 'Email: ' . $email . '<br>';
		$mensaje  =	'<html>'.
					'<head><title>' .$asunto. '</title></head>'.
					'<body><h1>'.$asunto.'</h1>'.
					'<table>'.
					'<tr><td>Apellido: '.
					'</td><td>'.
					$apellido.
					'</td></tr>'.
					'<tr><td>Nombre: '.
					'</td><td>'.
					$nombre.
					'</td></tr>'.
					'<tr><td>Nacionalidad: '.
					'</td><td>'.
					$nacionalidad.
					'</td></tr>'.
					'<tr><td>Estado Civil: '.
					'</td><td>'.
					$estadocivil.
					'</td></tr>'.
					'<tr><td>Sexo: '.
					'</td><td>'.
					$sexo.
					'</td></tr>'.
					'<tr><td>Fecha de Nacimiento: '.
					'</td><td>'.
					$fechanacimiento.
					'</td></tr>'.
					'<tr><td>Profesión: '.
					'</td><td>'.
					$profesion.
					'</td></tr>'.
					'<tr><td>Estudios: '.
					'</td><td>'.
					$estudios.
					'</td></tr>'.
					'<tr><td>CUIL: '.
					'</td><td>'.
					$cuil.
					'</td></tr>'.
					'<tr><td>DNI: '.
					'</td><td>'.
					$dni.
					'</td></tr>'.
					'<tr><td>Discapacidad: '.
					'</td><td>'.
					$discapacidad.
					'</td></tr>'.
					'<tr><td>&nbsp; '.
					'</td><td><h2>Domicilio</h2>'.
					'</td></tr>'.
					'<tr><td>Calle: '.
					'</td><td>'.
					$calle.
					'</td></tr>'.
					'<tr><td>Altura: '.
					'</td><td>'.
					$altura.
					'</td></tr>'.
					'<tr><td>Piso: '.
					'</td><td>'.
					$piso.
					'</td></tr>'.
					'<tr><td>Depto: '.
					'</td><td>'.
					$depto.
					'</td></tr>'.
					'<tr><td>Código Postal: '.
					'</td><td>'.
					$codigopostal.
					'</td></tr>'.
					'<tr><td>Localidad: '.
					'</td><td>'.
					$localidad.
					'</td></tr>'.
					'<tr><td>Otros: '.
					'</td><td>'.
					$otros.
					'</td></tr>'.
					'<tr><td>&nbsp; '.
					'</td><td><h2>Contacto</h2>'.
					'</td></tr>'.
					'<tr><td>Celular: '.
					'</td><td>'.
					$celular.
					'</td></tr>'.
					'<tr><td>Teléfono: '.
					'</td><td>'.
					$tel.
					'</td></tr>'.
					'<tr><td>Observación Teléfono: '.
					'</td><td>'.
					$obsTel.
					'</td></tr>'.
					'<tr><td>Email: '.
					'</td><td>'.
					$email.
					'</td></tr>'.
					'<tr><td>Observación Email: '.
					'</td><td>'.
					$obsEmail.
					'</td></tr>'.
					'<tr><td>&nbsp; '.
					'</td><td><h2>Empresa</h2>'.
					'</td></tr>'.
					'<tr><td>CUIT: '.
					'</td><td>'.
					$cuitempresa.
					'</td></tr>'.
					'<tr><td>Nombre: '.
					'</td><td>'.
					$nombreempresa.
					'</td></tr>'.
					'<tr><td>Fecha de Ingreso: '.
					'</td><td>'.
					$fechaingreso.
					'</td></tr>'.
					'<tr><td>&nbsp; '.
					'</td><td><h2>Mensaje</h2>'.
					'</td></tr>'.
					'<tr><td>&nbsp; '.
					'</td><td>'.
					$msj.
					'</td></tr>'.
					'</table>'.
					'</body>'.
					'</html>';	

		//se envia el email
		mail($paraAfiliate, $asunto, $mensaje, $cabeceras);
		$exito = 1;
		echo $exito;
		break;
	}
?>

