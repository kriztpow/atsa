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
			$emailFrom         = EMAIL;
			$emailNotificacion = EMAIL;
			$nombre            = isset($_POST['fname']) ? $_POST['fname'] : '';
			$apellido          = isset($_POST['lname']) ? $_POST['lname'] : '';
			$email             = isset($_POST['email']) ? $_POST['email'] : '';
			$telefono          = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$suscription       = isset($_POST['suscription']) ? $_POST['suscription'] : 'off';
			$asunto            = isset($_POST['subject']) ? $_POST['subject'] : 'Formulario de Contacto';
			$mensaje           = isset($_POST['message']) ? $_POST['message'] : '';
			$bodyEmail         = 'Nombre: ' . $nombre . ' ' . $apellido . '<br>';
			$bodyEmail        .= 'email: ' . $email . ' <br>';
			$bodyEmail        .= 'telefono: ' . $telefono . ' <br>';
			$bodyEmail        .= 'Mensaje: ' . $mensaje . ' <br>';

			$emailTo    = EMAIL;
			
			
			require_once('lib/PHPMailer/src/PHPMailer.php');
			require_once('lib/PHPMailer/src/SMTP.php');
			require_once('lib/PHPMailer/src/Exception.php');

			$mail = new PHPMailer;
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			//Set who the message is to be sent from
			$mail->setFrom($emailFrom, 'Voces de Sanidad');
			//Set an alternative reply-to address
			$mail->addReplyTo($email, $nombre);
			//Set who the message is to be sent to
			$mail->addAddress($emailTo, $nombre);
			//Set the subject line
			$mail->Subject = $asunto;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			
			$mail->MsgHTML($bodyEmail);
			//send the message, check for errors
			if (!$mail->send()) {
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo $mensajeExito;
			}
			

			if ( $suscription == 'on') {
				//NO OLVIDARSE DE REGISTRAR EL USUARIO -> SUSCRIBE FOOTER
			}
		break;		

		/*
		 * Maneja el formulario de suscripcion para completar los datos
		*/

		case 'suscribe-form' :
			$mensajeExito = 'Todos los datos han sido guardados';

			//toma los datos del formulario
			//chequea si el email ya existe
			//si el email ya existe actualiza el usuario y si hay mensaje se envia al administrador
			//si el email no existe crea un nuevo registro con todo los datos sin enviar email al usuario pero envia una NOTIFICACION al administrador

		break;

		/*
		 * suscripción solo del email, link del footer
		*/
		case 'suscribe-footer' :
			$mensajeExito = 'Su email ha sido registrado, chequee su bandeja de entrada';
			
			//toma el email del usuario u otra data (nombre, apellido, etc)
			//crea una nueva entrada con el email y genera un codigo
			//envia un email al usuario para que cree el registro
			//envia una notificación al administrador que se registro un nuevo usuario y el mensaje que este puso

		break;
		



	}//switch

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}

function suscription() {
	$email;
	$nombre;
	$apellido;
	$telefono;
	$dni;

}