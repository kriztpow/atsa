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
				sendEmailToAdmin( $_POST, 'equipodeprensa@atsa.org.ar' );
				cargaUsuarioRechazado( $_POST, 'error-2' );
				return;
			}
			
			if ( checkCuilHere($_POST['cuil']) ) {
				echo 'error-4';
				sendEmailToAdmin( $_POST, 'equipodeprensa@atsa.org.ar' );
				cargaUsuarioRechazado( $_POST, 'error-4' );
				//cargaUsuarioRechazado( $_POST );
				return;
			};

			//chequea que el cuil esté en la base de datos externa
			$usuario = checkCuil($_POST['cuil']);
			//si el chequeo no da error continua
			if ( $usuario == 'error-1' || $usuario == 'error-2' ) {
				//devuelve error al script
				echo $usuario;
				sendEmailToAdmin( $_POST, 'equipodeprensa@atsa.org.ar' );
				cargaUsuarioRechazado( $_POST, $usuario );
				return;
			}
			//si la consulta a la base de datos externa trae datos carga el nuevo usuario en la base de datos local
			if ( ! empty($usuario) ) {
				//recupera el id del nuevo usuario
				 
				$id = loadNewUser( $usuario, $_POST );
				//echo 'ok';
			 	
				$userUpdate = getDataAfiliado( $id );
				//variables para el envio del email exitoso al administrador y al afiliado:
				$cuilAfiliado = $userUpdate['member_cuil'];
				$emailAfiliado = $userUpdate['member_email'];
				$nombreAfiliado = $userUpdate['member_nombre'].' '.$userUpdate['member_apellido'];
				$telefonoAfiliado = 'Tel: '.$userUpdate['member_telefono'].' Cel: '.$userUpdate['member_movil'];
				//enviar email al usuario nuevo y al administrador
				sendEmail( $cuilAfiliado, $emailAfiliado, $nombreAfiliado, $telefonoAfiliado );

				//crear la keyuser para que el afiliado pueda continuar completando
				$keyuser = $userUpdate['member_id'] . '-' . $userUpdate['member_cuil'] . '-' .  date( "Y-m-d", strtotime($userUpdate['member_date_registro'])) ;
				$key = password_hash($keyuser, PASSWORD_BCRYPT);
				//actualiza el usuario con el member_link
				createUserLink ($userUpdate['member_id'], $key);
				//finalmente se pasa el template con el link para seguir completando tus datos
				$data = array(
					'cuil' => $userUpdate['member_cuil'],
					'key' => $keyuser,
				);

				getTemplate('completar' , $data);

			} else {
				
				sendEmailToAdmin( $_POST, 'equipodeprensa@atsa.org.ar' );
				cargaUsuarioRechazado( $_POST, 'error-4' );

			}

		break;//try-cuil - primer formulario

		case 'familiares' :
		$data = array( 'array_vacia' );
	
		getTemplate('template-nuevo-familiar', $data);
		break;

		//formulario afiliado
		case 'afiliado_form' :

			$connectionNow = connectDB();
			$tabla = 'afiliados';

			//si el cuil no está hay un error
			if ( !isset($_POST['afiliado_cuil']) || $_POST['afiliado_cuil'] == ''  ) {
				echo 'cuil';
				return;
			}
			
			$member_id  = isset($_POST['member_id']) ? $_POST['member_id'] : '' ;
			if ( $member_id == '' ) {
				$member_id = 'new';
			}
			$member_notas                     = isset($_POST['afiliado_notas']) ? $_POST['afiliado_notas'] : '';
			$member_status                    = isset($_POST['afiliado_status']) ? $_POST['afiliado_status'] : '0';	
			
			$member_cuil                      = $_POST['afiliado_cuil'];

			$member_dni                       = isset($_POST['afiliado_dni']) ? $_POST['afiliado_dni'] : '';
			$member_fecha_afiliacion          = isset($_POST['afiliado_fecha_afiliacion']) ? $_POST['afiliado_fecha_afiliacion'] : '';
			$member_fecha_ingreso_sindicato   = isset($_POST['afiliado_fecha_ingreso_sindicato']) ? $_POST['afiliado_fecha_ingreso_sindicato'] : '';
			$member_apellido                  = isset($_POST['afiliado_apellido']) ? strtolower($_POST['afiliado_apellido']) : '';
			$member_nombre                    = isset($_POST['afiliado_nombre']) ? strtolower($_POST['afiliado_nombre']) : '';
			$member_nacionalidad              = isset($_POST['afiliado_nacionalidad']) ? strtolower($_POST['afiliado_nacionalidad']) : '';
			$member_estado_civil              = isset($_POST['afiliado_estado_civil']) ? strtolower($_POST['afiliado_estado_civil']) : '';
			$member_sexo                      = isset($_POST['afiliado_sexo']) ? strtolower($_POST['afiliado_sexo']) : '';
			$member_fecha_nacimiento          = isset($_POST['afiliado_fecha_nacimiento']) ? $_POST['afiliado_fecha_nacimiento'] : '';
			$member_profesion                 = isset($_POST['afiliado_profesion']) ? strtolower($_POST['afiliado_profesion']) : '';
			$member_estudios                  = isset($_POST['afiliado_estudios']) ? strtolower($_POST['afiliado_estudios']) : '';
			$member_discapacidad              = isset($_POST['afiliado_discapacidad']) ? $_POST['afiliado_discapacidad'] : '0';

			$member_calle                     = isset($_POST['afiliado_calle']) ? strtolower($_POST['afiliado_calle']) : '';
			$member_altura                    = isset($_POST['afiliado_altura']) ? $_POST['afiliado_altura'] : '';
			$member_piso                      = isset($_POST['afiliado_piso']) ? $_POST['afiliado_piso'] : '';
			$member_departamento              = isset($_POST['afiliado_departamento']) ? $_POST['afiliado_departamento'] : '';

			$member_localidad                 = isset($_POST['afiliado_localidad']) ? strtolower($_POST['afiliado_localidad']) : '';
			$member_codigo_postal             = isset($_POST['afiliado_codigo_postal']) ? $_POST['afiliado_codigo_postal'] : '';
			$member_provincia                 = isset($_POST['afiliado_provincia']) ? strtolower($_POST['afiliado_provincia']) : '';
			$member_otros                     = isset($_POST['afiliado_otros']) ? $_POST['afiliado_otros'] : '';

			$member_movil                     = isset($_POST['afiliado_movil']) ? $_POST['afiliado_movil'] : '';
			$member_telefono                  = isset($_POST['afiliado_telefono']) ? $_POST['afiliado_telefono'] : '';
			$member_email                     = isset($_POST['afiliado_email']) ? strtolower($_POST['afiliado_email']) : '';
			$member_via_contacto              = isset($_POST['afiliado_via_contacto']) ? strtolower($_POST['afiliado_via_contacto']) : '';
			$member_facebook                  = isset($_POST['afiliado_redes_sociales_facebook']) ? $_POST['afiliado_redes_sociales_facebook'] : '0';
			$member_twiter                    = isset($_POST['afiliado_redes_sociales_twitter']) ? $_POST['afiliado_redes_sociales_twitter'] : '0';

			$member_cuit                      = isset($_POST['afiliado_cuit']) ? $_POST['afiliado_cuit'] : '';
			$member_razon_social              = isset($_POST['afiliado_razon_social']) ? strtolower($_POST['afiliado_razon_social']) : '';
			$member_establecimiento           = isset($_POST['afiliado_establecimiento']) ? strtolower($_POST['afiliado_establecimiento']) : '';
			$member_direccion                 = isset($_POST['afiliado_empresa_direccion']) ? strtolower($_POST['afiliado_empresa_direccion']) : '';
			$member_fecha_ingreso             = isset($_POST['afiliado_fecha_ingreso']) ? strtolower($_POST['afiliado_fecha_ingreso']) : '';
			$member_registration_id           = isset($_POST['member_registration_id']) ? $_POST['member_registration_id'] : '';

			$parientes                        = isset($_POST['afiliado_parientes']) ? $_POST['afiliado_parientes'] : '';

			//SANITIZE:
			$member_notas           = filter_var($member_notas,FILTER_SANITIZE_STRING);
			$member_notas           = mysqli_real_escape_string($connectionNow, $member_notas);
			$member_cuil             = filter_var($member_cuil,FILTER_SANITIZE_NUMBER_INT);
			$member_cuil             = mysqli_real_escape_string($connectionNow, $member_cuil);
			$member_cuit             = filter_var($member_cuit,FILTER_SANITIZE_NUMBER_INT);
			$member_cuit             = mysqli_real_escape_string($connectionNow, $member_cuit);
			$member_dni             = filter_var($member_dni,FILTER_SANITIZE_NUMBER_INT);
			$member_dni             = mysqli_real_escape_string($connectionNow, $member_dni);
			$member_apellido        = filter_var(ucwords($member_apellido),FILTER_SANITIZE_STRING);
			$member_apellido        = mysqli_real_escape_string($connectionNow, $member_apellido);
			$member_nombre          = filter_var(ucwords($member_nombre),FILTER_SANITIZE_STRING);
			$member_nombre          = mysqli_real_escape_string($connectionNow, $member_nombre);
			$member_nacionalidad    = filter_var($member_nacionalidad,FILTER_SANITIZE_STRING);
			$member_nacionalidad    = mysqli_real_escape_string($connectionNow, $member_nacionalidad);
			$member_estado_civil    = filter_var($member_estado_civil,FILTER_SANITIZE_STRING);
			$member_estado_civil    = mysqli_real_escape_string($connectionNow, $member_estado_civil);
			$member_sexo            = filter_var($member_sexo,FILTER_SANITIZE_STRING);
			$member_sexo            = mysqli_real_escape_string($connectionNow, $member_sexo);
			$member_profesion       = filter_var($member_profesion,FILTER_SANITIZE_STRING);
			$member_profesion       = mysqli_real_escape_string($connectionNow, $member_profesion);
			$member_estudios        = filter_var($member_estudios,FILTER_SANITIZE_STRING);
			$member_estudios        = mysqli_real_escape_string($connectionNow, $member_estudios);

			$member_calle           = filter_var(ucwords($member_calle),FILTER_SANITIZE_STRING);
			$member_calle           = mysqli_real_escape_string($connectionNow, $member_calle);
			$member_altura          = filter_var($member_altura,FILTER_SANITIZE_NUMBER_INT);
			$member_altura          = mysqli_real_escape_string($connectionNow, $member_altura);
			$member_piso            = filter_var($member_piso,FILTER_SANITIZE_STRING);
			$member_piso            = mysqli_real_escape_string($connectionNow, $member_piso);
			$member_departamento    = filter_var($member_departamento,FILTER_SANITIZE_STRING);
			$member_departamento    = mysqli_real_escape_string($connectionNow, $member_departamento);

			$member_localidad       = filter_var($member_localidad,FILTER_SANITIZE_STRING);
			$member_localidad       = mysqli_real_escape_string($connectionNow, $member_localidad);
			$member_codigo_postal   = filter_var($member_codigo_postal,FILTER_SANITIZE_STRING);
			$member_codigo_postal   = mysqli_real_escape_string($connectionNow, $member_codigo_postal);
			$member_provincia       = filter_var($member_provincia,FILTER_SANITIZE_STRING);
			$member_provincia       = mysqli_real_escape_string($connectionNow, $member_provincia);
			$member_otros           = filter_var($member_otros,FILTER_SANITIZE_STRING);
			$member_otros           = mysqli_real_escape_string($connectionNow, $member_otros);

			$member_movil           = filter_var($member_movil,FILTER_SANITIZE_NUMBER_INT);
			$member_movil           = mysqli_real_escape_string($connectionNow, $member_movil);
			$member_telefono        = filter_var($member_telefono,FILTER_SANITIZE_NUMBER_INT);
			$member_telefono        = mysqli_real_escape_string($connectionNow, $member_telefono);
			$member_email           = filter_var($member_email,FILTER_SANITIZE_EMAIL);
			$member_email           = mysqli_real_escape_string($connectionNow, $member_email);
			$member_via_contacto    = filter_var($member_via_contacto,FILTER_SANITIZE_STRING);
			$member_via_contacto    = mysqli_real_escape_string($connectionNow, $member_via_contacto);

			$member_cuit            = filter_var($member_cuit,FILTER_SANITIZE_NUMBER_INT);
			$member_cuit            = mysqli_real_escape_string($connectionNow, $member_cuit);
			$member_razon_social    = filter_var(ucwords($member_razon_social),FILTER_SANITIZE_STRING);
			$member_razon_social    = mysqli_real_escape_string($connectionNow, $member_razon_social);
			$member_establecimiento = filter_var($member_establecimiento,FILTER_SANITIZE_STRING);
			$member_establecimiento = mysqli_real_escape_string($connectionNow, $member_establecimiento);
			$member_direccion       = filter_var($member_direccion,FILTER_SANITIZE_STRING);
			$member_direccion       = mysqli_real_escape_string($connectionNow, $member_direccion);

			//pasamos los on del checbox a 1 para guardar en bd:
			if ( $member_discapacidad == 'on' ) {
				$member_discapacidad = '1';
			}
			if ( $member_facebook == 'on' ) {
				$member_facebook = '1';
			}
			if ( $member_twiter == 'on' ) {
				$member_twiter = '1';
			}

			//recupero vieja data del afiliado para que no se pierda
			//(la parte de la empresa no se puede solo actualizar)
			$oldDataAfiliado = getDataAfiliado($member_id);

			//ahora se arman las variables para cargar la base de datos
			//1. la dirección del afiliado se serializa
			$member_domicilio = array(
				'calle' => $member_calle,
				'altura' => $member_altura,
				'piso' => $member_piso,
				'departamento' => $member_departamento,
				'otros' => $member_otros,
			);
			$member_domicilio = serialize($member_domicilio);
			
			$contactoOtros = array(
				'facebook' => $member_facebook,
				'twitter' => $member_twiter,
				'preferida' => $member_via_contacto,
			);

			$contactoOtros = serialize($contactoOtros);

			//3. los datos de la empresa, primero recupera los que ya están para sumarles los nuevos
			//recuperamos los datos viejos
			$empresa       = unserialize($oldDataAfiliado['member_empresa']);
			
			//agregamos los datos nuevos
			$empresa['empresa_domicilio']       = $member_direccion;
			$empresa['cuit-empresa']            = $member_cuit;
			$empresa['razon-social']            = $member_razon_social;
			$empresa['empresa-establecimiento'] = $member_establecimiento;
			//volvemos a serializar para guardar en bd
			$empresa                            = serialize($empresa);
			
			//4. grupo familiar
			if ( $parientes != '' ) {
				$parientes = json_decode($parientes);

				$grupoFamiliar = array();

				for ($i=0; $i < count($parientes); $i++) { 
					
					$familiar = array(
						'afiliado_pariente_parentesco' => filter_var( $parientes[$i]->afiliado_pariente_parentesco,FILTER_SANITIZE_STRING),
		      			'afiliado_pariente_nombre' => filter_var( $parientes[$i]->afiliado_pariente_nombre,FILTER_SANITIZE_STRING),
		      			'afiliado_pariente_nacionalidad' => filter_var( $parientes[$i]->afiliado_pariente_nacionalidad,FILTER_SANITIZE_STRING),
		      			'afiliado_pariente_nacimiento' => filter_var( $parientes[$i]->afiliado_pariente_nacimiento,FILTER_SANITIZE_STRING),
		      			'afiliado_pariente_dni' => filter_var( $parientes[$i]->afiliado_pariente_dni,FILTER_SANITIZE_STRING),
		      			'afiliado_pariente_sexo' => filter_var( $parientes[$i]->afiliado_pariente_sexo,FILTER_SANITIZE_STRING),
		      			'afiliado_pariente_discapacidad' => $parientes[$i]->afiliado_pariente_discapacidad,
					);

					array_push($grupoFamiliar, $familiar);
				}//for

				$grupoFamiliar = serialize($grupoFamiliar);
			}

			//5. SE GUARDA EL USUARIO

			$query = "UPDATE ".$tabla." SET member_cuil='".$member_cuil."',member_dni='".$member_dni."',member_fecha_afiliacion=";
			//fechas afiliacion:
			if ( $member_fecha_afiliacion == '' || $member_fecha_afiliacion == '0000-00-00' ) {
				$query .= "NULL, ";
			} else {
				$query .= "'".$member_fecha_afiliacion."',";
			}
			$query .= "member_fecha_ingreso_sindicato=";
			//fechas ingreso sindicato:
			if ( $member_fecha_ingreso_sindicato == '' || $member_fecha_ingreso_sindicato == '0000-00-00' ) {
				$query .= "NULL, ";
			} else {
				$query .= "'".$member_fecha_ingreso_sindicato."',";
			}
			$query .= "member_apellido='".$member_apellido."', member_nombre='".$member_nombre."',member_nacionalidad='".$member_nacionalidad."',member_estado_civil='".$member_estado_civil."',member_sexo='".$member_sexo."',member_fecha_nacimiento=";
			//fechas nacimiento:
			if ( $member_fecha_nacimiento == '' || $member_fecha_nacimiento == '0000-00-00' ) {
				$query .= "NULL, ";
			} else {
				$query .= "'".$member_fecha_nacimiento."',";
			}
			$query .= "member_profesion='".$member_profesion."',member_estudios='".$member_estudios."',member_discapacidad='".$member_discapacidad."',member_domicilio='".$member_domicilio."',member_localidad='".$member_localidad."', member_codigo_postal='".$member_codigo_postal."',member_provincia='".$member_provincia."',member_movil='".$member_movil."',member_telefono='".$member_telefono."',member_email='".$member_email."', member_contacto_otros='".$contactoOtros."',member_empresa='".$empresa."',member_fecha_ingreso=";
			//fechas ingreso empresa:
			if ( $member_fecha_ingreso == '' || $member_fecha_ingreso == '0000-00-00' ) {
				$query .= "NULL, ";
			} else {
				$query .= "'".$member_fecha_ingreso."',";
			}
			if ( isset($grupoFamiliar) ) {
				$query .= "member_grupo_familiar='".$grupoFamiliar."',";
			}
			$query .= "member_notas='".$member_notas."',member_status='".$member_status."' WHERE member_id='".$member_id."' LIMIT 1";

			$update = mysqli_query($connectionNow, $query); 
		
			if ($update) {
				echo 'ok';
			} 

		break;
	}//switch

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}







