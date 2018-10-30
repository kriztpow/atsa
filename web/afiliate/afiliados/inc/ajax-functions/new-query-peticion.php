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

	$cantPost = $_POST['cantPost'];
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$orden = $_POST['orden'];
    $user = isset($_POST['user']) ? $_POST['user'] : 0;
    $peticion = '';
    if ($user == '') {
        $user = 0;
    }
	if ( $peticion == '' ) {
		$peticion = 'all';
	}

	if ( $cantPost == '' ) {
		$cantPost = CANTPOST;
	}

	$peticiones = getPeticiones ( $peticion, 'fecha', $orden, $cantPost, $page );
    
    if ( $peticiones != null ) : 
        ob_start();
		for ($i=0; $i < count($peticiones); $i++) { ?>
		<tr>

            <?php 
            echo $user;
			if ( $user == '0' ) {
				getTemplate('fragmento-tabla-peticion-std',$peticiones[$i]);
			} else {
				getTemplate( 'fragmento-tabla-peticion-std-reduce',$peticiones[$i] ); 
			}
			?>

		</tr>
			<?php 
        }//for
        $html = ob_get_contents();
        ob_end_clean();
	endif;

    echo $html;

	//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}