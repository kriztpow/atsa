<?php 
/*
 * Sitio web: atsa - afiliate
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/
use PHPMailer\PHPMailer\PHPMailer;
require_once 'config.php';
require_once 'functions.php';
require_once 'lib/mobile-detect/Mobile_Detect.php';

//chequea si es peticion de ajax y ejecuta la funcion
if(  isAjax() ) {
	$function = isset($_POST['function']) ? $_POST['function'] : '';

	switch ( $function ) {
		case 'try-cuil':
			
			$cuil  = isset( $_POST['cuil'] ) ? $_POST['cuil'] : '';
			$cuit  = isset( $_POST['cuit'] ) ? $_POST['cuit'] : '';
			$email = isset( $_POST['member_email'] ) ? $_POST['member_email'] : '';
			$tel   = isset( $_POST['member_tel'] ) ? $_POST['member_tel'] : '';
			$movil = isset( $_POST['member_cellphone'] ) ? $_POST['member_cellphone'] : '';
			$apellido = isset( $_POST['lastname'] ) ? $_POST['lastname'] : '';
			$nombre = isset( $_POST['name'] ) ? $_POST['name'] : '';
			$nombreAfiliado = $nombre . ' ' . $apellido;

			//mira a ver si el cuil está en base de datos local
			if ( $_POST['cuil'] == '' ) {
				echo 'error-2';
				sendEmailToAdmin( $cuil, $cuit, $email, $nombreAfiliado, $tel, $movil, 'equipodeprensa@atsa.org.ar' );
				return;
			}
			
			if ( checkCuilHere($_POST['cuil']) ) {
				echo 'error-4';
				sendEmailToAdmin( $cuil, $cuit, $email, $nombreAfiliado, $tel, $movil, 'equipodeprensa@atsa.org.ar' );
				return;
			};

			//chequea que el cuil esté en la base de datos externa
			$usuario = checkCuil($_POST['cuil']);
			//si el chequeo no da error continua
			if ( $usuario == 'error-1' || $usuario == 'error-2' ) {
				//devuelve error al script
				echo $usuario;
				sendEmailToAdmin( $cuil, $cuit, $email, $nombreAfiliado, $tel, $movil, 'equipodeprensa@atsa.org.ar' );
				return;
			}
			//si la consulta a la base de datos externa trae datos carga el nuevo usuario en la base de datos local
			if ( ! empty($usuario) ) {
				//recupera el id del nuevo usuario
				 
				$id = loadNewUser( $usuario, $_POST );
				echo 'ok';
			 
				$userUpdate = getDataAfiliado( $id );
				$cuilAfiliado = $userUpdate['member_cuil'];
				$emailAfiliado = $userUpdate['member_email'];
				$nombreAfiliado = $userUpdate['member_nombre'].' '.$userUpdate['member_apellido'];
				$telefonoAfiliado = 'Tel: '.$userUpdate['member_telefono'].' Cel: '.$userUpdate['member_movil'];
				//enviar email al usuario nuevo y al administrador
				sendEmail( $cuilAfiliado, $emailAfiliado, $nombreAfiliado, $telefonoAfiliado );
				
			} else {
				
				sendEmailToAdmin( $cuil, $cuit, $email, $nombreAfiliado, $tel, $movil, 'equipodeprensa@atsa.org.ar' );
			}

		break;//try-cuil - primer formulario

	}//switch

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}







