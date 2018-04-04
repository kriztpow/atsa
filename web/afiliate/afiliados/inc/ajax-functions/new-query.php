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

	$status = $_POST['status'];
	$cantPost = $_POST['cantPost'];
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$orden = $_POST['orden'];
	
	if ( $status == '' ) {
		$status = 'all';
	}

	if ( $cantPost == '' ) {
		$cantPost = CANTPOST;
	}

	$afiliados = getAfiliados ( $status, 'member_date_registro', $orden, $cantPost, $page );

	if ( $afiliados != null ) : 

		for ($i=0; $i < count($afiliados); $i++) { ?>
		<tr>

			<?php 
			if ( $status == 'all' ) {
				getTemplate('fragmento-tabla-afiliado-std',$afiliados[$i]);
			} else {
				getTemplate('fragmento-tabla-afiliado-0',$afiliados[$i]);
			}
			?>

		</tr>
			<?php 
		}//for
	endif;



	//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}