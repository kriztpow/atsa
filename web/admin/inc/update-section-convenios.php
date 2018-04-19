<?php
/*
 * update section
 * Since 4.0
 * convenios
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'convenios';
	
	$section_id = isset( $_POST['seccion'] ) ? $_POST['seccion'] : '';
	$texto = isset( $_POST['texto'] ) ? $_POST['texto'] : '';
	$orden = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';

	$queryUpdateSection = "UPDATE ".$tabla." SET convenios_texto='".$texto."', convenios_orden='".$orden."' WHERE convenios_seccion='".$section_id."' LIMIT 1";
	
	if ( $texto == '') {
		$queryUpdateSection = "UPDATE ".$tabla." SET convenios_orden='".$orden."' WHERE convenios_seccion='".$section_id."' LIMIT 1";	
	}

	$result = mysqli_query($connection, $queryUpdateSection);
	
	echo 'ok';

	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}