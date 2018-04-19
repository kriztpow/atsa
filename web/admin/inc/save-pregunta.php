<?php
/*
 * guarda viajes
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'preguntas';
	
	$titulo = isset( $_POST['titulo'] ) ? $_POST['titulo'] : '';
	$imagen = isset( $_POST['imagen'] ) ? $_POST['imagen'] : '';
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

		$queryCreateItem  = "INSERT INTO " .$tabla. " (pregunta_titulo, pregunta_texto, pregunta_imagen, pregunta_orden) VALUES ('$titulo','$texto','$imagen','$orden')";

		$result = mysqli_query($connection, $queryCreateItem);
		
		echo mysqli_insert_id($connection);

	} //si el post ya existe se actualiza
		else {

		$queryUpdateItem  = "UPDATE ".$tabla." SET pregunta_titulo='".$titulo."', pregunta_texto='".$texto."', pregunta_imagen='".$imagen."', pregunta_orden='".$orden."' WHERE pregunta_ID='".$idItem."' LIMIT 1";

		$result = mysqli_query($connection, $queryUpdateItem);
		
		echo 'ok';
	}
	
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}
