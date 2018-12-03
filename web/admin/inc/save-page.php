<?php
/*
 * guarda item seleccionado staff
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();

	$item_id = isset( $_POST['idItem'] ) ? $_POST['idItem'] : '';
	$imagen = isset( $_POST['imagen'] ) ? $_POST['imagen'] : '';
	$titulo = isset( $_POST['titulo'] ) ? $_POST['titulo'] : '';
	$contenido = isset( $_POST['contenido'] ) ? $_POST['contenido'] : '';
	$extra = isset( $_POST['extra'] ) ? $_POST['extra'] : '';

	//limpieza
	$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);
	$extra = filter_var($extra,FILTER_SANITIZE_STRING);
		
	//si es viejo se actualiza
	$queryUpdateItem  = "UPDATE pages SET page_titulo='".$titulo."', page_text='".$contenido."', page_imagen='".$imagen."', page_extra='".$extra."' WHERE page_ID='".$item_id."' LIMIT 1";

	$result = mysqli_query($connection, $queryUpdateItem);
		
	echo 'ok';
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}