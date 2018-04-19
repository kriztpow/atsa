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
	$titulo = isset( $_POST['titulo'] ) ? $_POST['titulo'] : '';
	$caption = isset( $_POST['caption'] ) ? $_POST['caption'] : '';
	$imagen = isset( $_POST['imagen'] ) ? $_POST['imagen'] : '';
	$iconhotel = isset( $_POST['iconhotel'] ) ? $_POST['iconhotel'] : '';
	$iconserv = isset( $_POST['iconserv'] ) ? $_POST['iconserv'] : '';
	$descripcion = isset( $_POST['descripcion'] ) ? $_POST['descripcion'] : 'none';
	$servicios = isset( $_POST['servicios'] ) ? $_POST['servicios'] : 'none';
	$contingente = isset( $_POST['contingente'] ) ? $_POST['contingente'] : 'none';
	$newArticle = isset( $_POST['newArticle'] ) ? $_POST['newArticle'] : 'true';
	$idItem = isset( $_POST['idItem'] ) ? $_POST['idItem'] : '';

	$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);
	$caption = filter_var($caption,FILTER_SANITIZE_STRING);

	if ( $descripcion == '' ) {
		$descripcion = 'none';
	}
	if ( $servicios == '' ) {
		$servicios = 'none';
	}
	if ( $contingente == '' ) {
		$contingente = 'none';
	}


	//si es nuevo se crea
	if ( $newArticle == 'true' ) {
			$queryCreateItem  = "INSERT INTO " .$tabla. " (hotel_location, hotel_titulo, hotel_descripcion, hotel_servicios, hotel_dataextra, hotel_contingente, hotel_icontipo, hotel_iconservicios, hotel_thumnail) VALUES ('$caption','$titulo','$descripcion', '$servicios','hotel','$contingente','$iconhotel','$iconserv','$imagen')";
				
		$result = mysqli_query($connection, $queryCreateItem);
			//print_r($connection);
		echo mysqli_insert_id($connection);

		//sino es nuevo se actualiza
	} else {
		//si es viejo se actualiza
		$queryUpdateItem  = "UPDATE ".$tabla." SET hotel_location='".$caption."', hotel_titulo='".$titulo."', hotel_descripcion='".$descripcion."', hotel_servicios='".$servicios."', hotel_contingente='".$contingente."', hotel_icontipo='".$iconhotel."', hotel_iconservicios='".$iconserv."', hotel_thumnail='".$imagen."' WHERE hotel_ID='".$idItem."' LIMIT 1";

		$result = mysqli_query($connection, $queryUpdateItem);

		echo 'ok';
	}
	
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}