<?php
/*
 * guarda item seleccionado staff
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'staff';
	$newItem = isset( $_POST['newItem'] ) ? $_POST['newItem'] : 'true';
	$post_Type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : '';
	$imgItem = isset( $_POST['img'] ) ? $_POST['img'] : '';
	$nombreItem = isset( $_POST['nombre'] ) ? $_POST['nombre'] : '';
	$cargoItem = isset( $_POST['cargo'] ) ? $_POST['cargo'] : '';
	$trabajoItem = isset( $_POST['trabajo'] ) ? $_POST['trabajo'] : '';
	$redSocialItem = isset( $_POST['redSocial'] ) ? $_POST['redSocial'] : '';
	$ordenItem = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';
	//limpieza
	$nombreItem = filter_var($nombreItem,FILTER_SANITIZE_STRING);
	$cargoItem = filter_var($cargoItem,FILTER_SANITIZE_STRING);
	$trabajoItem = filter_var($trabajoItem,FILTER_SANITIZE_STRING);
	$redSocialItem = filter_var($redSocialItem,FILTER_SANITIZE_STRING);
	$ordenItem = filter_var($ordenItem,FILTER_SANITIZE_NUMBER_INT);
	
	//si es nuevo se crea
	if ( $newItem == 'true' ) {
	$queryCreateItem  = "INSERT INTO " .$tabla. " (staff_orden, staff_nombre, staff_cargo, staff_trabajo, staff_image, staff_redsocial, staff_post_type) VALUES ('$ordenItem','$nombreItem','$cargoItem','$trabajoItem','$imgItem','$redSocialItem', '$post_Type')";
	
	$result = mysqli_query($connection, $queryCreateItem);
		
	echo mysqli_insert_id($connection);
	
	} else {
		$item_id = isset( $_POST['idItem'] ) ? $_POST['idItem'] : '';
		//si es viejo se actualiza
		$queryUpdateItem  = "UPDATE ".$tabla." SET staff_orden='".$ordenItem."',staff_nombre='".$nombreItem."', staff_cargo='".$cargoItem."', staff_trabajo='".$trabajoItem."', staff_image='".$imgItem."', staff_redsocial='".$redSocialItem."' WHERE staff_id='".$item_id."' LIMIT 1";

		$result = mysqli_query($connection, $queryUpdateItem);
		
	}
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}