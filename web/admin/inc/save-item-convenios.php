<?php
/*
 * guarda item seleccionado convenios
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'convenios';
	$newItem = isset( $_POST['newItem'] ) ? $_POST['newItem'] : 'true';
	$post_Type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : '';
	$seccion = isset( $_POST['seccion'] ) ? $_POST['seccion'] : '';
	$url = isset( $_POST['url'] ) ? $_POST['url'] : '';
	$texto = isset( $_POST['texto'] ) ? $_POST['texto'] : '';
	$orden = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';
	$esFile = isset( $_POST['eslink'] ) ? $_POST['eslink'] : '0';
	$texto = filter_var($texto,FILTER_SANITIZE_STRING); 
	$orden = filter_var($orden,FILTER_SANITIZE_NUMBER_INT);
	print_r($_POST);
	//si es nuevo se crea
	if ( $newItem == 'true' ) {
	$queryCreateItem  = "INSERT INTO " .$tabla. " (convenios_texto,convenios_url,convenios_orden,convenios_seccion,convenios_post_type) VALUES ('$texto','$url','$orden','$seccion','$post_Type')";
	if ( $esFile == '1' ) {
		$queryCreateItem  = "INSERT INTO " .$tabla. " (convenios_texto,convenios_url,convenios_orden,convenios_seccion,convenios_post_type, convenios_link) VALUES ('$texto','$url','$orden','$seccion','$post_Type', 1)";
	}
	$result = mysqli_query($connection, $queryCreateItem);
		
	//echo mysqli_insert_id($connection);
	} else {
		$item_id = isset( $_POST['idItem'] ) ? $_POST['idItem'] : '';
		//si es viejo se actualiza
		$queryUpdateItem  = "UPDATE ".$tabla." SET convenios_texto='".$texto."',convenios_url='".$url."', convenios_orden='".$orden."' WHERE convenios_id='".$item_id."' LIMIT 1";

		$result = mysqli_query($connection, $queryUpdateItem);
		echo $item_id;
	}
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}