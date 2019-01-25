<?php
/*
 * create new section
 * Since 4.0
 * 
*/
require_once('../functions.php');

if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'archivos';
	
	$section_id = isset( $_POST['seccion'] ) ? $_POST['seccion'] : '';
	$texto = isset( $_POST['texto'] ) ? $_POST['texto'] : '';
	$orden = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';

		$queryUpdateSection = "UPDATE ".$tabla." SET deportes_texto='".$texto."', deportes_orden='".$orden."' WHERE deportes_seccion='".$section_id."' LIMIT 1";
		$result = mysqli_query($connection, $queryUpdateSection);
		print_r($_POST);
//	echo 'ok';

	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}