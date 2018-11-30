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
$paraPeticion    = 'equipodeprensa@atsa.org.ar';

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
$SanidadSolidaria = 'sanidadsolidaria@atsa.org.ar';

$form_type      = recogeDato('form_type'); 
$cabeceras      = 'MIME-Version: 1.0' . "\r\n";
$cabeceras     .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras     .= 'From: ATSA Bs As <web@atsa.org.ar>' . "\r\n";
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

			case 'sanidad_solidaria':
				$paraContacto = $SanidadSolidaria;
				
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
		$info          = recogeDato('info');
		$asunto        = $nombre . ' desea recibir información';
		$asuntoUsuario = 'Muchas gracias por tu firma';
		$cabeceras .= 'Reply-To: ' . $email . "\r\n";

		//mensaje usuario
		$imagen = 'https://atsa.org.ar/uploads/images/' . 'email-varon.jpg';
		
		if ($genero == 'mujer') {
			$imagen = 'https://atsa.org.ar/uploads/images/' . 'email-mujer.jpg';
		}

		//email para el usuario de respuesta
		$mensajeUsuario = getHtmlTemplatePeticion ( $imagen, $genero );
		mail($email, $asuntoUsuario, $mensajeUsuario, $cabeceras);
		$exito = 1;
		echo $exito;
		
		$registro = registroPeticion($email, $nombre, $dni, $genero, $info, '#NoAlasPulserasEnEfermería');
		
		//email para administrador
		if ( $info == 'on' ) {

			//sino esta en la lista le envia un email
			if ( $registro != 'existe' ) {
				
				//mensaje administrador
				$mensaje  = 'Nombre: ' . $nombre . '<br>';
				$mensaje .= 'Email: ' . $email . '<br>';
				$mensaje .= 'DNI: ' . $dni . '<br>';
				$mensaje .= 'Género: ' . $genero . '<br>';
				$mensaje .= 'Deseo recibir información';

				mail($paraPeticion, $asunto, $mensaje, $cabeceras);
			}
		}
		

	break;

	case 'acceso-delegados':
	
		$user = recogeDato('userid');
		$pass = recogeDato('password');
		if ( (isset($user) && $user != '') || (isset($pass) && $pass != '') ) {
			echo autorizarAcceso($user, $pass);
		} else {
			echo 'Faltan datos';
		}
			
	break;


	case 'activar':
		global $cabeceras;
		global $paraContacto;
		global $exito;
		global $Mujer;

		$nombre       = recogeDato('nombre');
		$apellido     = recogeDato('apellido');
		$dni          = recogeDato('dni');
		$email        = recogeDato('email');
		$telefono     = recogeDato('telefono');
		$texto        = recogeDato('mensaje');
		$asunto       = 'Mensaje nuevo desde el sitio web';

		$cabeceras .= 'Reply-To: ' . $email . "\r\n";

		$mensaje  = 'Nombre: ' . $nombre . ' '. $apellido . '<br>';
		$mensaje .= 'DNI: ' . $dni . '<br>';
		$mensaje .= 'Email: ' . $email . '<br>';
		$mensaje .= 'Teléfono: ' . $telefono . '<br>';
		$mensaje .= $texto;
		$paraContacto = $Mujer;
		
		mail($paraContacto, $asunto, $mensaje, $cabeceras);
		$exito = 1;
		echo $exito;

	break;

}//switch

function autorizarAcceso($user, $pass) {

	$user  = filter_var($user,FILTER_SANITIZE_EMAIL);

	$connection = conectToAfiliate(DB_SERVER, DB_USER, DB_PASS, 'afiliate');
	$tabla = 'usuarios';
	$query  = "SELECT * FROM " .$tabla. " WHERE user_usuario='".$user."' ";

	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		$respuesta = '<div class="alert alert-success" role="alert">Datos incorrectos</div>';
	} else {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		if ( password_verify($pass, $row['user_password']) ) {
			if ( session_status() != PHP_SESSION_ACTIVE ) {
				session_start();	
			} else {
				session_destroy();
				session_start();
			}

			
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $user;
			$_SESSION['nombre'] = $row['user_nombre'];
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_status'] = $row['user_status'];
			$_SESSION['user_dni'] = $row['user_dni'];
			$_SESSION['user_image'] = $row['user_image'];
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (60 * 60 * 24); //60 minutos 

			$respuesta = 1;
		} else { 
			$respuesta = 0;
		}
		
	}//else result

	isset($connection) ? mysqli_close($connection) : exit;

	return $respuesta;
}

function conectToAfiliate($server, $user, $pass, $dbName){
	global $connection;
	$connection = mysqli_connect($server, $user, $pass, $dbName);
	// Test if connection succeeded
	if( mysqli_connect_errno() ) {
		die("Database connection failed: " . mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ")"
		);
	}
	if (!mysqli_set_charset($connection, "utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($connection));
		exit();
		} else {
			mysqli_character_set_name($connection);
		}
	return $connection;
}

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

function getHtmlTemplatePeticion ( $imagen, $genero ) {
	if ($genero == 'mujer' ) {
		$texto = 'compañera';
	} else {
		$texto = 'compañero';
	}
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
	  	<p style="text-align:center;">¡Muchas gracias por firmar, '.$texto.'!</p>

	  	<p style="text-align:center;">Tu firma nos da fuerzas para evitar que se implementen las pulseras en enfermería.</p>
	  
	  	<p style="text-align:center;">¡No te olvides de compartirlo en tus redes sociales para que más compañeros enfermeros se sumen a esta iniciativa!</p>
	  
	  	<p style="text-align:center;">Defendamos juntos nuestra profesión.</p>
	  </div>
	  <div style="width: 100%;margin: 0 auto;display: flex;align-items: center;justify-content: space-between;">
		  <a style="padding: 10px 20px;text-transform:uppercase; text-align: left;" href="https://www.facebook.com/sharer/sharer.php?u=https://atsa.org.ar/nosomospresos" target="_blank">
		  	Compartir en Facebook
		  </a>
		  <a style="padding: 10px 20px;text-transform:uppercase; text-align: right;" href="https://twitter.com/intent/tweet?url=https://atsa.org.ar/nosomospresos&text=%23NoAlasPulserasEnEnfermeria" target="_blank">
		  	Compartir en Twitter
		  </a>
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

function registroPeticion($email, $nombre, $dni, $genero, $info, $peticion) {
	$respuesta = '';
	$connection = connectDBAfiliate ('localhost', 'derechoc_coco', 'd6m=fD1=ZqKt', 'derechoc_afiliados');
	$tabla = 'peticiones';

	if ( ! checkifthereisit($dni) ) {

		$nombre       = filter_var(ucwords($nombre),FILTER_SANITIZE_STRING);
		$nombre       = mysqli_real_escape_string($connection, $nombre);
		$email  = filter_var($email,FILTER_SANITIZE_EMAIL);
		$email  = mysqli_real_escape_string($connection, $email);
		$dni          = filter_var($dni,FILTER_SANITIZE_NUMBER_INT);
		$dni          = mysqli_real_escape_string($connection, $dni);

		if ($info == 'on' || $info == true ) {
			$info = 'si';
		} else {
			$info = 'no';
		}

		$query = "INSERT INTO $tabla (nombre,dni,email,genero,info,peticion) VALUES ('$nombre', '$dni', '$email', '$genero', '$info', '$peticion')";

		$result = mysqli_query($connection, $query); 
		$memberID = mysqli_insert_id($connection);

		if ($memberID != '' || $memberID == null ) {
			$respuesta = 'Ok';
		}
		
		mysqli_close( $connection );
	} else {
		$respuesta = 'existe';
	}
	return $respuesta;
}

function connectDBAfiliate ($server, $user, $pass, $dbname) {
	global $connection;
  $connection = mysqli_connect($server, $user, $pass, $dbname);
  // Test if connection succeeded
  if( mysqli_connect_errno() ) {
    die("Database connection failed: " . mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }

  if (!mysqli_set_charset($connection, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($connection));
    exit();
	} else {
		mysqli_character_set_name($connection);
	}
  return $connection;
}

function checkifthereisit($dni) {
	$respuesta = '';
	$connection = connectDBAfiliate ('localhost', 'derechoc_coco', 'd6m=fD1=ZqKt', 'derechoc_afiliados');
	$tabla = 'peticiones';

	if ( $dni == '' ) {
		return 'vacio';//falta ingresar dni
	}

	$query  = "SELECT * FROM " .$tabla. " WHERE dni='".$dni."'";

	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );
	if ( $result->num_rows == 0 ) {
		return false;
	} else {
		return true;
	}
}

?>