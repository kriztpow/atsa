<?php 
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/

require_once 'config.php';
require_once 'functions.php';
require_once 'lib/mobile-detect/Mobile_Detect.php';
require("class.phpmailer.php");
require("class.smtp.php");

//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() ) {
	$function = isset($_POST['function']) ? $_POST['function'] : '';

	switch ( $function ) {
		case 'try-cuil':

			$cuil = isset( $_POST['cuil'] ) ? $_POST['cuil'] : '';
			//mira a ver si el cuil está en base de datos local
			if ( $_POST['cuil'] == '' ) {
				echo 'error-2';
				return;
			}
			
			if ( checkCuilHere($_POST['cuil']) ) {
				echo 'error-4';
				return;
			};

			//chequea que el cuil esté en la base de datos externa
			$usuario = checkCuil($_POST['cuil']);
			//si el chequeo no da error continua
			if ( $usuario == 'error-1' || $usuario == 'error-2' ) {
				//devuelve error al script
				echo $usuario;
				return;
			}
			//si la consulta a la base de datos externa trae datos carga el nuevo usuario en la base de datos local
			if ( ! empty($usuario) ) {
				//recupera el id del nuevo usuario
				$id = loadNewUser( $usuario, $_POST );

				//carga el template con id del usuario nuevo
				getTemplate( 'formulario2', $id );

			}

		break;//try-cuil - primer formulario

		case 'save-member':

			$update = updateUser( $_POST );

			echo $update;

		break;//save-member segundo formulario

	}//switch

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}







