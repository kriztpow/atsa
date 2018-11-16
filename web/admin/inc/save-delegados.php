<?php
/*
 * guarda viajes
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'contenidodelegados';
	
	$titulo = isset( $_POST['titulo'] ) ? $_POST['titulo'] : '';
	$url = isset( $_POST['link'] ) ? $_POST['link'] : '';
	$imagen = isset( $_POST['imagen'] ) ? $_POST['imagen'] : '';
	$orden = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';
	$newArticle = isset( $_POST['newArticle'] ) ? $_POST['newArticle'] : 'true';
	$idItem = isset( $_POST['idItem'] ) ? $_POST['idItem'] : '';
	$type = isset( $_POST['type'] ) ? $_POST['type'] : 'menu';
	
	
	//limpieza general
	$url = filter_var($url,FILTER_SANITIZE_URL);
	$orden = filter_var($orden,FILTER_SANITIZE_NUMBER_INT);
	$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);

	if ( $orden == '' ) {
		$orden = '0';
	}

	if ($type == 'video' && $url != '' && strpos($url, '=') === false  ) {

		$urlbasica = 'https://www.youtube.com/watch?v=';

		$url = $urlbasica . explode('/',$url)[3];
		
	}


	//si el post es nuevo se crea
	if ( $newArticle == 'true' ) {

		$queryCreateItem  = "INSERT INTO " .$tabla. " (titulo, url, imagen, type, orden) VALUES ('$titulo','$url','$imagen','$type','$orden')";

		$result = mysqli_query($connection, $queryCreateItem);
		
		echo mysqli_insert_id($connection);

	} //si el post ya existe se actualiza
		else {

		$queryUpdateItem  = "UPDATE ".$tabla." SET titulo='".$titulo."', url='".$url."', imagen='".$imagen."', type='".$type."',  orden='".$orden."' WHERE id='".$idItem."' LIMIT 1";

		$result = mysqli_query($connection, $queryUpdateItem);
		
		echo 'ok';
	}
	
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}
