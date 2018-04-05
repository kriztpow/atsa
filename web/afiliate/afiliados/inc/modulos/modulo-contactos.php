<?php
/*
MANEJA LOS SUSCRIPTORES
*/

//numero de afiliados totales conectados segun status
function getAfiliadosNumber($status = 'all') {
	$connection = connectDB();
	$tabla      = 'afiliados';
	$query      = "SELECT * FROM " .$tabla;
	if ( $status != 'all' ) {
		$query .= " WHERE member_status='".$status."'";
	}

	$result     = mysqli_query($connection, $query);

	closeDataBase($connection);

	return $result->num_rows;
	/*if ( $result->num_rows == 0 ) {
		return null;

	} else {
		return $result->num_rows;
	}*/	
}
//toma los contactos de la base de datos y devuelve el array con todos los contactos
function getAfiliados ( $status = 'all', $orderBy = 'member_date_registro', $orden = 'desc', $cantPost = CANTPOST, $offset = -1 ) {
	$connection = connectDB();
	$tabla      = 'afiliados';
	$query      = "SELECT * FROM " .$tabla;
	if ( $status != 'all' ) {
		$query .= " WHERE member_status='".$status."'";
	}
	$query     .= " ORDER by ".$orderBy." ".$orden;
	if ( $offset != -1 ) {
		$query .= " LIMIT " .($offset-1)*$cantPost.", ".$cantPost;
	} else {
		$query     .= " LIMIT " .$cantPost;
	}

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

function getDataAfiliadoAdmin( $cuil ) {
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