<?php
/*
 * create new section
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'deportes';
	
	$post_Type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : '';
	$seccion = isset( $_POST['seccion'] ) ? $_POST['seccion'] : '';
	$url = isset( $_POST['url'] ) ? $_POST['url'] : '';
	$texto = isset( $_POST['texto'] ) ? $_POST['texto'] : '';
	$orden = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';

	$queryCreateSecction  = "INSERT INTO " .$tabla. " (deportes_texto,deportes_url,deportes_orden,deportes_seccion,deportes_post_type) VALUES ('$texto','$url','$orden','$seccion','$post_Type')";
	$result = mysqli_query($connection, $queryCreateSecction);
		
	echo mysqli_insert_id($connection);

	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}