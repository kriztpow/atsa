<?php 
//proceso del formulario
use PHPMailer\PHPMailer\PHPMailer;
require_once('../functions.php');

function recogeDato($campo){ 
     return isset($_REQUEST[$campo])?$_REQUEST[$campo]:'';
}

//a quienes llegan los formularios
$paraSubscriptor = 'voces@atsa.org.ar';
$paraContacto    = 'web@atsa.org.ar';
$paraPieForm     = 'web@atsa.org.ar';
$paraAfiliate    = 'asesoramiento@atsa.org.ar';
$paraPeticion    = 'asesoramiento@atsa.org.ar';

//emails segun sección
$Gremiales = 'gremiales@atsa.org.ar';		
$Cultura = 'secretariadecultura@atsa.org.ar';
$Deportes = 'turismo1@atsa.org.ar';
$Turismo = 'turismo@atsa.org.ar';
$Prensa = 'web@atsa.org.ar';
$AccionSocial = 'accionsocial@atsa.org.ar';
$Mujer = 'mujer@atsa.org.ar';
$AsistenciaSocial = 'web@atsa.org.ar';
$Legales = 'web@atsa.org.ar';
$Finanzas = 'web@atsa.org.ar';
$Vitalicios = 'web@atsa.org.ar';
$Complejo = 'complejocultural@atsa.org.ar';		

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
		$emailSubscriptor = filter_var($emailSubscriptor,FILTER_SANITIZE_EMAIL);
		$mensajeRespuesta = '';
		$asunto = 'Nuevo Suscriptor registrado en ATSA';
		$mensaje = 'Suscriptor nuevo: ' . $emailSubscriptor;
		$mensaje .= 'Puede ver el nuevo suscriptor aquí: <a href="'.urlBase().'/voces-de-sanidad/cargar-noticias/index.php?admin=contacts" target="_blank">Click aquí</a>';
		

		$usuario = nuevoSuscriptor ($emailSubscriptor, $paraSubscriptor);

		if ($usuario == 'ok' ) {
			mail($paraSubscriptor, $asunto, $mensaje, $cabeceras);
			$mensajeRespuesta = 'El registro no ha terminado, chequee su bandeja de entrada';
		} 

		if ($usuario == 'falta-email') {

			$mensajeRespuesta = 'No pudimos escribirle un email, pero el usuario ya ha sido registrado, muchas gracias.';
		}

		if ($usuario == 'email-usado') {

			$mensajeRespuesta = 'Este email ya ha sido registrado anteriormente';
		}

		if ($usuario == 'fatal-error') {
			$mensajeRespuesta = 'Hubo un error, intente registrarse más tarde';
		}

		$exito = 1;
		echo $mensajeRespuesta;
		break;

//formulario de la página de contacto
	case 'contact':
		global $cabeceras;
		global $paraContacto;
		global $exito;
		
		global $Gremiales;
		global $Cultura;
		global $Deportes;
		global $Turismo;
		global $Prensa;
		global $AccionSocial;
		global $Mujer;
		global $AsistenciaSocial;
		global $Legales;
		global $Finanzas;
		global $Vitalicios;
		global $Complejo;


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

		//contactos segun sección

		switch ($section) {
			case 'gremiales':
				$paraContacto = $Gremiales;
				
				break;
			
			case 'cultura':
				$paraContacto = $Cultura;
				
				break;

			case 'deporte':
				$paraContacto = $Deportes;
				
				break;

			case 'turismo':
				$paraContacto = $Turismo;
				
				break;

			case 'prensa_y_Difusión':
				$paraContacto = $Prensa;
				
				break;

			case 'accion_social':
				$paraContacto = $AccionSocial;
				
				break;

			case 'genero':
				$paraContacto = $Mujer;
				
				break;

			case 'asistencia_social':
				$paraContacto = $AsistenciaSocial;
				
				break;

			case 'legales':
				$paraContacto = $Legales;
				
				break;

			case 'finanzas':
				$paraContacto = $Finanzas;
				
				break;

			case 'vitalicios':
				$paraContacto = $Vitalicios;
				
				break;

			case 'complejo_cultural':
				$paraContacto = $Complejo;
				
				break;
		}
		
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

//formulario de peticion
	case 'peticion':
		global $cabeceras;
		global $exito;
		$email         = recogeDato('email');
		$nombre        = recogeDato('name');
		$dni           = recogeDato('dni');
		$genero        = recogeDato('genero');
		$asunto        = 'Peticion Firmada por '.$nombre;
		$asuntoUsuario = 'Muchas gracias por tu firma';
		$cabeceras .= 'Reply-To: ' . $email . "\r\n";

		//mensaje usuario
		$imagen = 'https://atsa.org.ar/uploads/images/' . 'email-varon.jpg';
		
		if ($genero == 'mujer') {
			$imagen = 'https://atsa.org.ar/uploads/images/' . 'email-mujer.jpg';
		}

		$mensajeUsuario = getHtmlTemplatePeticion ( $imagen );
		mail($email, $asuntoUsuario, $mensajeUsuario, $cabeceras);
		$exito = 1;
		echo $exito;

		//mensaje administrador
		/*$mensaje  = 'Nombre: ' . $nombre . '<br>';
		$mensaje .= 'Email: ' . $email . '<br>';
		$mensaje .= 'DNI: ' . $dni . '<br>';
		$mensaje .= 'Gnero: ' . $genero . '<br>';

		mail($paraPeticion, $asunto, $mensaje, $cabeceras);*/

		break;

}//switch

function connectDBVoces() {
	global $connectionVoces;
	$connectionVoces = mysqli_connect('localhost', 'derechoc_coco', 'd6m=fD1=ZqKt', 'derechoc_voces-sanidad');
  // Test if connectionVoces succeeded
  if( mysqli_connect_errno() ) {
    die("Database connectionVoces failed: " . mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
  if (!mysqli_set_charset($connectionVoces, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($connectionVoces));
    exit();
	} else {
		mysqli_character_set_name($connectionVoces);
	}
  return $connectionVoces;
}

function nuevoSuscriptor ( $email, $emailFrom ) {
	$connectionVoces = connectDBVoces();
	$tabla = 'suscriptores';
	$queryIsEmail  = "SELECT * FROM " .$tabla. " WHERE susc_email='".$email."' ";

	$isUser = mysqli_query($connectionVoces, $queryIsEmail);

	if ( $email != '' && $isUser->num_rows == 0 ) {
		//no existe usuario

		//entonces registramos usuario

		$newcode = '1';
		
		//genera el codigo
		for ($i=0; $i < 20; $i++) { 
			$newcode .= chr(rand(ord('a'), ord('z')));
		}

		$newSuscriptor  = "INSERT INTO ".$tabla." (susc_email, susc_code_registro) VALUES ('".$email."', '".$newcode."')";

		$newUser = mysqli_query($connectionVoces, $newSuscriptor);
		
		isset($connectionVoces) ? mysqli_close($connectionVoces) : exit;

		if ( ! $newUser ) {
			return 'fatal-error';
		} else {
			
			$emailTo  = $email;
			require_once('phpmailer/PHPMailer.php');
			require_once('phpmailer/SMTP.php');
			require_once('phpmailer/Exception.php');

			$urlUsuario = urlBase().'/voces-de-sanidad/suscribirse?email='.$email.'&ushash='.$newcode;


			$mensaje = 'Bienvenido a Voces De sanidad, Tiene que copiar y pegar este link para terminar el registro: <br>';
			$mensaje .= $urlUsuario;
			$urlLogoEmail = urlBase() . '/voces-de-sanidad/images/logo-dark.png';
			$mensajeHTML = getHtmlTemplateEmail ( $urlLogoEmail, urlBase().'/voces-de-sanidad', $urlUsuario);
			$mail = new PHPMailer;
			//Tell PHPMailer to use SMTP
			//$mail->isSMTP();
			//$mail->Host = 'localhost';
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			$mail->CharSet = 'UTF-8';
			//Set who the message is to be sent from
			$mail->setFrom($emailFrom, 'Voces de Sanidad');
			//Set who the message is to be sent to
			$mail->addAddress($emailTo, 'Nuevo Suscriptor');
			//Set the subject line
			$mail->Subject = 'Bienvenido a Voces de Sanidad';
			$mail->IsHTML(true);
			//Read an HTML message body from an external file, convert referenced images to embedded,
			$mail->MsgHTML($mensajeHTML);
			$mail->AltBody = $mensaje;
			//send the message, check for errors
			if (!$mail->send()) {
			    //echo 'Mailer Error: ' . $mail->ErrorInfo;
			    return 'falta-email';
			} 
			return 'ok';
			
		}
	} else {
		//existe el usuario
		return 'email-usado';
	}

}


function getHtmlTemplateEmail ( $urlLogoVoces, $urlVoces, $url) {
	$emailTemplate = '
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <title>Voces de Sanidad - Email Suscripción</title>
	</head>
	<body>
	<div style="max-width: 600px; width: 100%;padding: 20px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;margin:0 auto;">
	  
	  <div style="text-align: center;width: 50%;margin: 10px auto;">
	    <a href="'.$urlVoces.'" target="_blank">
	    	<img src="'.$urlLogoVoces.'" alt="Voces de Sanidad" style="width: 100%;">
	    </a>
	  </div>
	  <h1 style="text-align: center;color: #33363a;">
	  	Bienvenido a Voces de Sanidad.
	  </h1>
	  <div style="margin: 50px auto">
	  	  <p style="color: #33363a;font-size: 120%;text-align: justify;">
		  	Muchas gracias por suscribirse a nuestra publicación. Todas las voces de nuestro Gremio* se unen en este espacio. Dirigentes, delegad@s, compañer@s, artistas y especialistas narran historias, comparten reflexiones y proponen caminos para enfrentar nuevas realidades con innovación, solidaridad y, sobre todo, unidad.
		  </p>
		  <p style="color: #33363a;font-size: 120%;text-align: justify;">
		  	Para completar su suscripción es necesario que complete sus datos personales* haciendo clic en el botón de abajo. De lo contrario, puede ignorar este email.
		  </p>
	  </div>

	  <div style="text-align: center;width: 50%;margin: 80px auto;text-align: justify;">
	    <a href="'.$url.'" target="_blank" style="background-color: #33363a; border-color: #33363a; padding: 1.3rem 2.5rem; font-size: 1.3rem;color: #fff;text-decoration: none;">
	    	Completar datos
	    </a>
	  </div>

	  <div style="text-align: center;width: 50%;margin: 30px auto;">
	    <p style="font-size: 90%;color: #33363a;text-align: justify;">
	    	Si el botón no funciona puede copiar y pegar esta url:
	    </p>
	    <p style="font-size: 90%;text-decoration: underline;color: #33363a;text-align: justify;">'
	    	.$url.
	    '</p>
	  </div>
	  <hr>
	  <div>
	  	<p style="font-size: 90%;color: #33363a;text-align: justify;">
	  		* Sus datos personales se utilizan <strong style="font-weight: bold;">únicamente</strong> de forma estadística y no son compartidos absolutamente con nadie.
	  	</p>
	  	<p style="font-size: 90%;color: #33363a;text-align: justify;">
	  		*<strong style="font-weight: bold;">ATSA Buenos Aires</strong>: La Asociación de Trabajadores de la Sanidad Argentina fue fundada el 21 de septiembre de 1935 con el objeto de ejercer la defensa gremial, política, mutual y cultural de todos los trabajadores que presten servicios en Sanatorios, Clínicas, Hospitales de Colectividades, Institutos geriátricos, consultorios médicos y odontológicos, laboratorios de especialidades medicinales y/o veterinarias, droguerías, servicios de emergencias médicas, laboratorios de análisis clínicos, atención institutos con y sin internación y cuidados domiciliarios. La zona de actuación de ATSA Filial Buenos Aires es Capital Federal, con domicilio legal en la calle Saavedra 166, Barrio de Balvanera.
	  	</p>
	  </div>
	</div>
	</body>
	</html>
	';
	return $emailTemplate;
}

function getHtmlTemplatePeticion ( $imagen ) {
	$imagenFooter = 'https://atsa.org.ar/uploads/images/' . 'zocalo-email.jpg';
	$emailTemplate = '
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <title>Muchas gracias por tu firma</title>
	</head>
	<body>
	<div style="max-width: 600px; width: 100%;padding:0px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;margin:0 auto;">
	  
	  <div style="text-align: center;width: 100%;margin: 0 auto;">
	    <img src="'.$imagen.'" alt="Muchas gracias por tu firma" style="width: 100%;display:block;margin:0 auto;">
	  </div>

	  <div style="text-align: center;width: 100%;margin: 0 auto;">
	    <img src="'.$imagenFooter.'" alt="Muchas gracias por tu firma" style="width: 100%;display:block;margin:0 auto;">
	  </div>

	</div>
	</body>
	</html>
	';
	return $emailTemplate;
}

?>