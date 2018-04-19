<?php
/*
 * guarda viajes
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'prevencion';
	
	$titulo = isset( $_POST['titulo'] ) ? $_POST['titulo'] : '';
	$texto = isset( $_POST['texto'] ) ? $_POST['texto'] : '';
	$orden = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';
	$newArticle = isset( $_POST['newArticle'] ) ? $_POST['newArticle'] : 'true';
	$idItem = isset( $_POST['idItem'] ) ? $_POST['idItem'] : '';
	
	//limpieza general
	$orden = filter_var($orden,FILTER_SANITIZE_NUMBER_INT);
	$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);

	if ( $orden == '' ) {
		$orden = '0';
	}

	//si el post es nuevo se crea
	if ( $newArticle == 'true' ) {

		$queryCreateItem  = "INSERT INTO " .$tabla. " (prevencion_titulo, prevencion_texto, prevencion_orden) VALUES ('$titulo','$texto','$orden')";

		$result = mysqli_query($connection, $queryCreateItem);
		
		echo mysqli_insert_id($connection);

	} //si el post ya existe se actualiza
		else {

		$queryUpdateItem  = "UPDATE ".$tabla." SET prevencion_titulo='".$titulo."', prevencion_texto='".$texto."', prevencion_orden='".$orden."' WHERE prevencion_ID='".$idItem."' LIMIT 1";

		$result = mysqli_query($connection, $queryUpdateItem);
		
		echo 'ok';
	}
	
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}
