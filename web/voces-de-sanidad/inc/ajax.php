<?php 
/*
 * Sitio web: MVL
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/
use PHPMailer\PHPMailer\PHPMailer;

require_once 'config.php';
require_once 'functions.php';

//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() ) {
	$function = isset($_POST['function']) ? $_POST['function'] : '';
	
	switch ( $function ) {
		/*
		 * carga más noticias
		*/
		case 'load-more':
			$cantPost = isset($_POST['cantPost']) ? $_POST['cantPost'] : CANTPOST;
			$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : 'none';
			$pageNumber = isset($_POST['page']) ? $_POST['page'] : '1';
			$offset = $cantPost * $pageNumber;
			
			$newPosts = getPosts( $categoria, $cantPost, 'none', 'publicado', $offset );

			getTemplate( 'posts-loop', $newPosts );

		break;

		/*
		 * Maneja el formulario de contacto
		*/
		case 'contact-form':
			$mensajeExito = 'Recibimos su consulta, responderemos a la brevedad';
			$mensajeSuscripcion = '';
			$emailFrom         = EMAIL;
			$emailNotificacion = 'info@lacueva.tv';
			$emailTo           = 'info@lacueva.tv';;
			$nombre            = isset($_POST['fname']) ? $_POST['fname'] : '';
			$apellido          = isset($_POST['lname']) ? $_POST['lname'] : '';
			$email             = isset($_POST['email']) ? $_POST['email'] : '';
			$telefono          = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$suscription       = isset($_POST['suscription']) ? $_POST['suscription'] : 'off';
			$asunto            = isset($_POST['subject']) ? $_POST['subject'] : 'Formulario de Contacto Voces de Sanidad';
			$mensaje           = isset($_POST['message']) ? $_POST['message'] : '';
			
			$bodyEmail         = 'Nombre: ' . $nombre . ' ' . $apellido . '<br>';
			$bodyEmail        .= 'email: ' . $email . ' <br>';
			$bodyEmail        .= 'telefono: ' . $telefono . ' <br>';
			$bodyEmail        .= 'Mensaje: ' . $mensaje . ' <br>';			


			if ( $suscription == 'on') {

				if ( $email != '' && empty( isUser($email) ) ) {

					//crea una nueva entrada con el email y genera un codigo
					$newCode = newSuscriptor( $email, $nombre, $apellido, $telefono );
					if ( $newCode == 'error' ) {
						$mensajeSuscripcion .= 'El usuario se quiso suscribir pero no pudo, hay que suscribirlo manualmente<br>';
					} else {
						
						//envia un email al usuario para que cree el registro
						$sendEmail = sendEmailToSuscriber ( $email, $newCode);

						if ($sendEmail == 'link-enviado') {

							$mensajeSuscripcion .= 'El usuario se suscribió y se le ha enviado un email para que complete los datos que faltan.';
						} else {
							$mensajeSuscripcion .= 'El usuario se suscribió, pero no se pudo enviar un email para que termine el proceso, hacerlo manualmente';
						}
					}
				} else {
					$mensajeSuscripcion .= 'El usuario se quiso suscribir, pero ya está registrado';
				}

				$bodyEmail .= $mensajeSuscripcion;
			}

			//envia email
			require_once('PHPMailer/src/PHPMailer.php');
			require_once('PHPMailer/src/SMTP.php');
			require_once('PHPMailer/src/Exception.php');

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
			//Set an alternative reply-to address
			$mail->addReplyTo($email, $nombre);
			//Set who the message is to be sent to
			$mail->addAddress($emailTo, $nombre);
			//Set the subject line
			$mail->Subject = $asunto;
			$mail->IsHTML(true);
			//Read an HTML message body from an external file, convert referenced images to embedded,
			$mail->MsgHTML($bodyEmail);
			$mail->AltBody = $bodyEmail;
			//send the message, check for errors
			if (!$mail->send()) {
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo $mensajeExito;
			}

		break;		

		/*
		 * Maneja el formulario de suscripcion para completar los datos
		*/

		case 'suscribe-form' :
			$mensajeExito = 'Todos los datos han sido guardados';
			$email        = isset($_POST['email']) ? $_POST['email'] : '';
			$nombre       = isset($_POST['fname']) ? $_POST['fname'] : '';
			$apellido     = isset($_POST['lname']) ? $_POST['lname'] : '';
			$telefono     = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$dni          = isset($_POST['dni']) ? $_POST['dni'] : '';
			$mensaje      = isset($_POST['message']) ? $_POST['message'] : '';
			
			$bodyEmail         = 'Nombre: ' . $nombre . ' ' . $apellido . '<br>';
			$bodyEmail        .= 'email: ' . $email . ' <br>';
			$bodyEmail        .= 'telefono: ' . $telefono . ' <br>';
			$bodyEmail        .= 'DNI: ' . $dni . ' <br>';
			$bodyEmail        .= 'Mensaje: ' . $mensaje . ' <br>';

			//chequea si el email ya existe
			if ( $email != '' && empty( isUser($email) ) ) {
				//si el email no existe crea un nuevo registro con todo los datos sin enviar email al usuario pero envia una NOTIFICACION al administrador
				
				$newCode = newSuscriptor( $email, $nombre, $apellido, $telefono, $dni );
				if ( $newCode == 'error' ) {
					echo 'Hubo un error, intente registrarse más tarde';
					return;
				} else {
					echo $mensajeExito;
				}
				
				sendNotificationSuscrition ( $email, $bodyEmail );

			} else {
				//si el email ya existe actualiza el usuario y si hay mensaje se envia al administrador

				if ( updateSuscriptor( $email, $nombre, $apellido, $telefono, $dni ) ) {
					echo $mensajeExito;
				} else {
					echo 'Hubo un error, puede escribir a ' . EMAIL;
				}

				if ($mensaje != '') {
					sendNotificationSuscrition ( $email, $bodyEmail );
				}

			}

		break;

		/*
		 * suscripción solo del email, link del footer
		*/
		case 'suscribe-footer' :
			$mensajeExito = 'Su email ha sido registrado, chequee su bandeja de entrada';
			$mensajeyaExiste = 'Este email ya ha sido registrado con anterioridad, ante cualquier duda puede escribir a '. EMAIL;
			$mensajeParcial = 'No pudimos escribirle un email, pero el usuario ya ha sido registrado, muchas gracias.';
			$email  = isset($_POST['email']) ? $_POST['email'] : '';

			//si hay un email y no devuelve ningun usuario se continua
			if ( $email != '' && empty( isUser($email) ) ) {

				//crea una nueva entrada con el email y genera un codigo
				$newCode = newSuscriptor( $email );
				if ( $newCode == 'error' ) {
					echo 'Hubo un error, intente registrarse más tarde';
					return;
				} else {
					//si el usario se creeo se envia una notificación al administrador que se registro un nuevo usuario
					sendNotificationSuscrition ( $email );
					//envia un email al usuario para que cree el registro
					$sendEmail = sendEmailToSuscriber ( $email, $newCode);

					if ($sendEmail == 'link-enviado') {

						echo $mensajeExito;
					} else {
						echo 'No pudimos escribirle un email, pero el usuario ya ha sido registrado, muchas gracias.';
					}
				}
			} else {
				echo $mensajeyaExiste;
			}

		break;
		

	}//switch

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}


/*
 * BUSCA SI EXISTE EL USUARIO DEVUELVE EL USUARIO
*/
function isUser ($email) {
	$connection = connectDB();
	$tabla = 'suscriptores';
	$query  = "SELECT * FROM " .$tabla. " WHERE susc_email='".$email."' ";

	$result = mysqli_query($connection, $query);

	isset($connection) ? mysqli_close($connection) : exit;

	if ( $result->num_rows == 0 ) {
		return false;
	} else {
		$user = $result->fetch_array(MYSQLI_ASSOC);
		return $user;
	}
}

/*
 * ACTUALIZA USUARIO
 * guarda los nuevos datos con el $email
 * devuelve true si tuvo exito
*/
function updateSuscriptor( $email, $nombre = '', $apellido = '', $telefono = '', $dni = '' ) {
	$connection = connectDB();
	$tabla = 'suscriptores';

	$query = "UPDATE ".$tabla." SET susc_nombre='".$nombre."', susc_apellido='".$apellido."',susc_dni='".$dni."',susc_telefono='".$telefono."' WHERE susc_email='".$email."' LIMIT 1";
	$update = mysqli_query($connection, $query);

	isset($connection) ? mysqli_close($connection) : exit;
	
	if ($update) {
		return true;
	}
}

/*
 * NUEVO USUARIO
 * crea usuario con nuevo email 
 * devuelve codigo para enviar al usuario y que actualize sus datos
*/
function newSuscriptor( $email, $nombre = '', $apellido = '', $telefono = '', $dni = '' ) {
	$code = '1';
	$connection = connectDB();
	$tabla = 'suscriptores';
	
	//genera el codigo
	for ($i=0; $i < 20; $i++) { 
		$code .= chr(rand(ord('a'), ord('z')));
	}

	$newSuscriptor  = "INSERT INTO ".$tabla." (susc_nombre, susc_apellido, susc_dni, susc_email, susc_telefono, susc_code_registro) VALUES ('".$nombre."', '".$apellido."', '".$dni."', '".$email."', '".$telefono."', '".$code."')";

	$new = mysqli_query($connection, $newSuscriptor);

	isset($connection) ? mysqli_close($connection) : exit;

	if ( $new ) {
        	return $code;
        } else {
        	return 'error';
        }
}

/*
 * MANDA NOTIFICACION AL ADMINISTRADOR
*/

function sendNotificationSuscrition ( $email, $mensaje = '' ) {
	$emailFrom         = EMAIL;
	$emailNotificacion = EMAIL;
	$emailTo           = EMAIL;
	require_once('PHPMailer/src/PHPMailer.php');
	require_once('PHPMailer/src/SMTP.php');
	require_once('PHPMailer/src/Exception.php');

	if ( $mensaje == '' ) {
		$mensaje = 'Email Nuevo: ' . $email . ' <br>';
		$mensaje .= 'Puede ver el nuevo suscriptor aquí: <a href="'.MAINSURL.'/cargar-noticias/" target="_blank">Click aquí</a>';
	} else {
		$mensaje .= '<br><br>';
		$mensaje .= 'Puede ver el nuevo suscriptor aquí: <a href="'.MAINSURL.'/cargar-noticias/" target="_blank">Click aquí</a>';
	}
	 
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
	//Set an alternative reply-to address
	$mail->addReplyTo($email, 'Suscriptor');
	//Set who the message is to be sent to
	$mail->addAddress($emailTo, 'Voces De Sanidad');
	//Set the subject line
	$mail->Subject = 'Nuevo Suscriptor registrado';
	$mail->IsHTML(true);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	$mail->MsgHTML($mensaje);
	$mail->AltBody = $mensaje;
	//send the message, check for errors
	if (!$mail->send()) {
	    //echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'notificado';
	}
}


function sendEmailToSuscriber ( $email, $code ) {
	$emailFrom         = EMAIL;
	$emailNotificacion = EMAIL;
	$emailTo           = $email;
	require_once('PHPMailer/src/PHPMailer.php');
	require_once('PHPMailer/src/SMTP.php');
	require_once('PHPMailer/src/Exception.php');

	$urlUsuario = MAINSURL.'/suscribirse?email='.$email.'&ushash='.$code;


	$mensaje = 'Bienvenido a Voces De sanidad, Tiene que copiar y pegar este link para terminar el registro: <br>';
	$mensaje .= $urlUsuario;
	$urlLogoEmail = MAINSURL . '/images/logo-dark.png';
	$mensajeHTML = getHtmlTemplateEmail ( $urlLogoEmail, MAINSURL, $urlUsuario);
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
	} else {
	    echo 'link-enviado';
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