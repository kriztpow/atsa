<?php
/*
MANEJA LOS SUSCRIPTORES
*/

//toma los contactos de la base de datos y devuelve el array con todos los contactos
function getAfiliados ( $status = 'all', $orderBy = 'member_date_registro', $orden = 'desc', $cantPost = CANTPOST ) {
	$connection = connectDB();
	$tabla      = 'afiliados';
	$query      = "SELECT * FROM " .$tabla;
	if ( $status != 'all' ) {
		$query .= " WHERE member_status='".$status."'";
	}
	$query     .= " ORDER by ".$orderBy." ".$orden." LIMIT " .$cantPost;
	$result     = mysqli_query($connection, $query);
	closeDataBase($connection);

	if ( $result->num_rows == 0 ) {
		return null;

	} else {
		while ($row = $result->fetch_array()) {
			$contacts[] = $row;
		}
	}

	return $contacts;
}

function getDataAfiliado( $cuil ) {
	$connection = connectDB();
	$tabla = 'afiliados';
	
	$query  = "SELECT * FROM " .$tabla. " WHERE member_cuil='".$cuil."'";

	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );
	if ( $result->num_rows == 0 ) {
		return null;
	} else {
		$afiliado = mysqli_fetch_array($result);
	}
	return $afiliado;
}