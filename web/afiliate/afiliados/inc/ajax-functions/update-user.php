<?php
require '../functions.php';

if ( isAjax() ) {
	

//como es un pedido por ajax se crea el usuario
	$newPassword = '';
	$connection = connectDB();
	$tabla = 'usuarios';
	$userId = $_POST['userid'];
	$nombre = isset($_POST['user_nombre']) ? $_POST['user_nombre'] : 'usuario';
	$nombre  = filter_var($nombre,FILTER_SANITIZE_STRING);
	$status = isset($_POST['user_status']) ? $_POST['user_status'] : 'a';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$dni = isset($_POST['user_dni']) ? $_POST['user_dni'] : '';
	$dni  = filter_var($dni,FILTER_SANITIZE_STRING);
	$image = isset($_POST['user_image']) ? $_POST['user_image'] : '';

	//convierte el password
	if ($password != '') {
		$newPassword = password_hash($password, PASSWORD_BCRYPT);	
	}

	$query = "UPDATE ".$tabla." SET user_nombre = '".$nombre."',";

	if ( $newPassword != '' ) {
		$query .= " user_password='".$newPassword."',";
	}

	$query .=  " user_status='".$status."', user_dni='".$dni."', user_image='".$image."' WHERE user_id = '".$userId."'";

	$updateUser = mysqli_query($connection, $query);
	if ( $updateUser ) {
		echo 'ok';
	}

isset($connection) ? mysqli_close($connection) : exit;

} else {
	exit;
}//else - fin script