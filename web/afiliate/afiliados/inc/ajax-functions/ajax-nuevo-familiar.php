<?php
/*
 * Carga el template de los familiares y lo devuelve por javascript
 * Since 2.0
*/

require_once('../functions.php');

/*
	funcion principal, si es ajax se ejecuta sino se cancela
*/


//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() ) { 

	$data = array( 'array_vacia' );
	
	getTemplate('template-nuevo-familiar', $data);
	

	//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}