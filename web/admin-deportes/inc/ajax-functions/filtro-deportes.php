<?php 
/*
 * FILTRAR POR DEPORTE AJAX
 * @LaCueva.tv
 * Since 1.1
 * Carga más post
*/
require_once('../functions.php');
load_module( 'deportes' );
if ( isAjax() ) {

    $categoria = isset( $_POST['categoria'] ) ? $_POST['categoria'] : '';
    $flitro = null;
    $tabla = 'liga';
    if ($categoria != '') {
        $flitro = 'deporte_id="'.$categoria.'"';
    }
    
    $ligas = getLigas($flitro);
        
    if ( $ligas != null ) {
        for ($i=0; $i < count($ligas); $i++) { 
            getTemplate( 'loop-liga', $ligas[$i] );     
        }
    } 

//cierre base de datos
mysqli_close($connection);


} //if not ajax
else {
	exit;
}