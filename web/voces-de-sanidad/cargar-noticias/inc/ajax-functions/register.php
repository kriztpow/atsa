<?php
require '../functions.php';

if ( isAjax() ) {
	

//como es un pedido por ajax se crea el usuario
	$connection = connectDB();
	$tabla = 'usuarios';
	$username = $_POST['userid'];
	$username  = filter_var($username,FILTER_SANITIZE_EMAIL);
	//busca si hay un usuario con ese nombre
	$query  = "SELECT * FROM " .$tabla. " WHERE user_usuario='".$username."' ";

	$result = mysqli_query($connection, $query);

	if ( $result->num_rows != 0 ) {
		echo 'existe';
	}
	//si no hay ninguno crea el usuario
	else {
	 	$password = $_POST['password'];
		//convierte el password 
		$hash = password_hash($password, PASSWORD_BCRYPT); 
		$nombre = isset($_POST['username']) ? $_POST['username'] : $username;
		$nombre  = filter_var($nombre,FILTER_SANITIZE_STRING);
		$madingUser = "INSERT INTO ".$tabla." (user_usuario, user_password, user_nombre) VALUES ('".$username."', '".$hash."', '".$nombre."')";
	           
	    $newUser = mysqli_query($connection, $madingUser);

        if ( $newUser ) {
        	echo 'exito';
        } else {
        	echo 'error';
        }
    }

isset($connection) ? mysqli_close($connection) : exit;

} else {
	exit;
}//else - fin script