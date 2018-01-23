<?php
/*
 * MODULO AGENDA
*/


/*
MUESTRA LA LISTA DE EVENTOS CREADOS
*/

function listaEventos () {
	$connection = connectDB();
	$tabla = 'agenda';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ORDER by agenda_fecha_in desc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		return false;
	} else {

		while ($row = $result->fetch_array()) {
				$eventos[] = $row;
		}//while

		return $eventos;
		
	}//else 
	
	closeDataBase($connection);

} //listaEventos()

