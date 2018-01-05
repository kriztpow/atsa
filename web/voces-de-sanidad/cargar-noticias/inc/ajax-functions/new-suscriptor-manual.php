<?php
/*
 * Subir varias imagenes o una sola
 * Since 2.0
*/

require_once('../config.php');
require_once('../functions.php');
require_once('../modulos/modulo-contactos.php');

/*
	funcion principal, si es ajax se ejecuta sino se cancela
*/

//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() ) {
	$tabla = 'suscriptores';
	$connection = connectDB();

	$nombre   = isset($_POST['nombre']) ? $_POST['nombre'] : '';
	$email    = isset($_POST['email']) ? $_POST['email'] : '';
	$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
	$dni      = isset($_POST['dni']) ? $_POST['dni'] : '';
	$telefono = isset($_POST['tel']) ? $_POST['tel'] : '';

	
	$queryExiste  = "SELECT * FROM " .$tabla. " WHERE susc_email='".$email."' ";

	$existe = mysqli_query($connection, $queryExiste);

	if ( $existe->num_rows == 0 ) {
		$existe = false;
	}

	//si el email no esta registrado, se registra el usuario sin codigo ya que no es necesario
	if( ! $existe ) {

		$QuerynewSuscriptor  = "INSERT INTO ".$tabla." (susc_nombre, susc_apellido, susc_dni, susc_email, susc_telefono) VALUES ('".$nombre."', '".$apellido."', '".$dni."', '".$email."', '".$telefono."')";

		$newSuscriptor = mysqli_query($connection, $QuerynewSuscriptor);
		
		if ( $newSuscriptor ) {
			echo 'ok';
		} else {
			echo 'No pudo registrarse, pruebe más tarde';
		}

	} else {
		$code = '2';
		//genera el codigo
		for ($i=0; $i < 20; $i++) { 
			$code .= chr(rand(ord('a'), ord('z')));
		}

		$queryUpdateCode = "UPDATE ".$tabla." SET susc_code_registro='".$code."' WHERE susc_email='".$email."' LIMIT 1";
		$updateSuscriptor = mysqli_query($connection, $queryUpdateCode);

		$urlUsuario = MAINURL.'/suscribirse?email='.$email.'&ushash='.$code;

		echo 'Este email ya está registrado.<br>';
		echo 'Puede enviar este link al usuario para que modifique sus datos:<br>';
		echo '<a href="' . $urlUsuario. '" target="_blank">'.$urlUsuario.'</a>';
	}



	isset($connection) ? mysqli_close($connection) : exit;

//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}