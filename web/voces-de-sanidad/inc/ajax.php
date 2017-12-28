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
		 * Maneja el formulario de contacto
		*/
		case 'contact-form':
		
			$nombre     = isset($_POST['nombre']) ? $_POST['nombre'] : '';
			$email      = isset($_POST['email']) ? $_POST['email'] : '';
			$asunto     = isset($_POST['subject']) ? $_POST['subject'] : 'Formulario de Contacto';
			$mensaje    = isset($_POST['msj']) ? $_POST['msj'] : '';
			$bodyEmail  = 'Nombre: ' . $nombre . '<br>';
			$bodyEmail .= 'email: ' . $email . ' <br>';
			$bodyEmail .= 'Mensaje: ' . $mensaje . ' <br>';

			$emailTo    = LINK_EMAIL;
			
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
			//Set the hostname of the mail server
			$mail->Host = 'mail.colegiobuenosaires.edu.ar';
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = 587;
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			$mail->CharSet = "utf-8";
			//Username to use for SMTP authentication
			$mail->Username = 'info@colegiobuenosaires.edu.ar';
			//Password to use for SMTP authentication
			$mail->Password = 'OtGOoX6X2rn7';
			//Set who the message is to be sent from
			$mail->setFrom('info@colegiobuenosaires.edu.ar', utf8_decode($nombre));
			//Set an alternative reply-to address
			$mail->addReplyTo($email, $nombre);
			//Set who the message is to be sent to
			$mail->addAddress($emailTo, 'Colegio Buenos Aires');
			//Set the subject line
			$mail->Subject = $asunto;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			
			$mail->MsgHTML($bodyEmail);
			//send the message, check for errors
			if (!$mail->send()) {
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'ok';
			}
		
		break;		

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



	}//switch

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}