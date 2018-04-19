<?php
/*
 * guarda viajes
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'hoteles';
	$textoSuperior = isset( $_POST['textoSuperior'] ) ? $_POST['textoSuperior'] : '';
	$textoContacto = isset( $_POST['textoContacto'] ) ? $_POST['textoContacto'] : '';
	$tituloPromo = isset( $_POST['tituloPromo'] ) ? $_POST['tituloPromo'] : '';
	$textoPromo = isset( $_POST['textoPromo'] ) ? $_POST['textoPromo'] : '';
	$textoSuperior = filter_var($textoSuperior,FILTER_SANITIZE_STRING);
	$textoContacto = filter_var($textoContacto,FILTER_SANITIZE_STRING);
	$tituloPromo = filter_var($tituloPromo,FILTER_SANITIZE_STRING);
	//siempre se actualiza
	$queryUpdateItem  = "UPDATE ".$tabla." SET hotel_contingente='".$textoSuperior."',hotel_servicios='".$textoContacto."', hotel_titulo='".$tituloPromo."', hotel_descripcion='".$textoPromo."' WHERE hotel_dataextra='viajes' LIMIT 1";

		$result = mysqli_query($connection, $queryUpdateItem);
		echo 'exit';
	
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}