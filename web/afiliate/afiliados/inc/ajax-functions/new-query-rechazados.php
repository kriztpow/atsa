<?php
/*
 * New query para reordenar, para cargar mas y para mostrar un número mayor
 * Since 2.0
*/
require_once('../config.php');
require_once('../functions.php');
require_once('../modulos/modulo-contactos.php');

/*
	funcion principal, si es ajax se ejecuta sino se cancela
*/
//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() ) {

	$cantPost = isset($_POST['cantPost']) ? $_POST['cantPost'] : '';
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$orden = isset($_POST['orden']) ? $_POST['orden'] : 'desc';
	
	if ( $cantPost == '' ) {
		$cantPost = CANTPOST;
	}
	$limit = ( ($page-1)*$cantPost).", ".$cantPost;
	$rechazados = getRechazados ( $limit, $orden );

	if ( $rechazados != null ) : 

		for ($i=0; $i < count($rechazados); $i++) { ?>
		<tr>

			<?php 
			
				getTemplate('fragmento-tabla-rechazados',$rechazados[$i]);
			
			?>

		</tr>
			<?php 
		}//for
	endif;



	//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}