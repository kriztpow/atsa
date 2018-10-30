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
function getAfiliados ( $status = 'all', $registeredBy = 'all', $orderBy = 'member_date_registro', $orden = 'desc', $cantPost = CANTPOST, $offset = -1 ) {
	$connection = connectDB();
	$tabla      = 'afiliados';
	$query      = "SELECT * FROM " .$tabla;
	if ( $status != 'all' || $registeredBy != 'all' ) {
		$query .= " WHERE";
	}
	if ( $status != 'all' ) {
		$query .= " member_status='".$status."'";
	}
	if ( $status != 'all' && $registeredBy != 'all' ) {
		$query .= " and";
	}
	if ( $registeredBy != 'all' ) {
		if ( $registeredBy == 'delegados') {
			$query .= " member_registration_id!=''";
		} else {
			$query .= " member_registration_id='".$registeredBy."'";	
		}
		
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


//busca afiliados por medio del cuil, dni o nombre
function searchAfiliados( $dataBusqueda ) {
	$connection = connectDB();
	$tabla = 'afiliados';

	$dataBusqueda = trim($dataBusqueda);

	//busca en cuil y dni
	$queryNumeros  = "SELECT * FROM ".$tabla." WHERE member_cuil LIKE '%" .$dataBusqueda. "%' or member_dni LIKE '%" .$dataBusqueda."%'";
	$resultNumeros = mysqli_query($connection, $queryNumeros);

	//busca en nombres
	$queryLetras = "SELECT * FROM ".$tabla." WHERE member_apellido LIKE '%" .$dataBusqueda. "%' or member_nombre LIKE '%" .$dataBusqueda."%'";
	
	$resultLetras = mysqli_query($connection, $queryLetras);

	closeDataBase($connection);

	if ( $resultNumeros->num_rows == 0 && $resultLetras->num_rows == 0 ) {
		return null;

	} else {
		if ( $resultNumeros->num_rows != 0 ) {
			while ($row = $resultNumeros->fetch_array()) {
				$contacts[] = $row;
			}	
		}
		if ( $resultLetras->num_rows != 0 ) {
			while ($row = $resultLetras->fetch_array()) {
				$contacts[] = $row;
			}	
		}
		
	}

	return $contacts;
}


//numero de afiliados totales segun busqueda
function searchAfiliadosNumber( $dataBusqueda ) {
	$connection = connectDB();
	$tabla      = 'afiliados';
	$dataBusqueda = trim($dataBusqueda);

	//busca en cuil y dni
	$queryNumeros  = "SELECT * FROM ".$tabla." WHERE member_cuil LIKE '%" .$dataBusqueda. "%' or member_dni LIKE '%" .$dataBusqueda."%'";
	$resultNumeros = mysqli_query($connection, $queryNumeros);

	//busca en nombres
	$queryLetras = "SELECT * FROM ".$tabla." WHERE member_apellido LIKE '%" .$dataBusqueda. "%' or member_nombre LIKE '%" .$dataBusqueda."%'";
	
	$resultLetras = mysqli_query($connection, $queryLetras);

	closeDataBase($connection);

	return $resultLetras->num_rows+$resultNumeros->num_rows;
}


//busca afiliado de acuerdo al cuil
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

function getRechazados( $limit = -1, $orden = 'desc') {
	$connection = connectDB();
	$tabla      = 'rechazados';
	$query      = "SELECT * FROM " .$tabla . " ORDER by member_date_registro " .$orden;
	if ( $limit != -1 ) {
		$query .= " LIMIT ". $limit;
	}
	

	$result     = mysqli_query($connection, $query);

	closeDataBase($connection);

	if ( $result->num_rows == 0 ) {
		return null;

	} else {
		while ($row = $result->fetch_array()) {
			$rechazados[] = $row;
		}
	}

	return $rechazados;
}

//numero de afiliados totales conectados segun status
function getRechazadosNumber() {
	$connection = connectDB();
	$tabla      = 'rechazados';
	$query      = "SELECT * FROM " .$tabla;	

	$result     = mysqli_query($connection, $query);

	closeDataBase($connection);

	return $result->num_rows;

}

function getPeticiones ( $peticion = 'all', $orderBy = 'fecha', $orden = 'desc', $cantPost = CANTPOST, $offset = -1 ) {
	$connection = connectDB();
	$tabla      = 'peticiones';
	$query      = "SELECT * FROM " .$tabla;
	if ( $peticion != 'all' ) {
		$query .= " WHERE";
	}
	if ( $peticion != 'all' ) {
		$query .= " peticion='".$peticion."'";
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

function getPeticionesNumber($peticion = 'all') {
	$connection = connectDB();
	$tabla      = 'peticiones';
	$query      = "SELECT * FROM " .$tabla;
	if ( $peticion != 'all' ) {
		$query .= " WHERE peticion='".$peticion."'";
	}

	$result     = mysqli_query($connection, $query);

	closeDataBase($connection);

	return $result->num_rows;
	
}

function getEstadoAfiliado($dni) {
	$estado = '';
	$connection = connectDB();
	$tabla = 'afiliados';
	
	$query  = "SELECT * FROM " .$tabla. " WHERE member_dni='".$dni."'";

	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );
	if ( $result->num_rows == 0 ) {
		$estado = 'No Registrado';
	} else {
		$afiliado = mysqli_fetch_array($result);

		switch ( $afiliado['member_status'] ) {
			case '2' :
				$estado = 'anulado';
			break;

			case '3' :
				$estado = 'firmado';
			break;

			case '1' :
				$estado = 'contactado';
			break;

			default :
				$estado = 'nocontactado';
			break;
		}

	}

	return $estado;
}	