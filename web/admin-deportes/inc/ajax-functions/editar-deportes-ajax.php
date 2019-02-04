<?php
/*
 * editor
 * Since 3.0
 * Maneja el backend del editor de noticias, ya sea para una nueva noticia o editar alguna
*/

require_once('../functions.php');
load_module('deportes');
if ( isAjax() ) {
    
    $action = isset( $_POST['action'] ) ? $_POST['action'] : false;
    
    //var_dump($_POST);

    switch ($action) {
        /*
         * Guarda el formulario de editar liga con todos los cambios
        */
        case 'editar-liga':
        
            echo editarLiga($_POST);

        break;

        /*
         * guarda la zona
        */
        case 'escribir-zona':
        
            $ligaId = isset($_POST['liga_id']) ? $_POST['liga_id'] : '';
            echo editZona( $ligaId, $_POST );

        break;

        /*
         * Agrega una zona a la liga
        */
        case 'nueva-zona':
        
            $ligaId = isset( $_POST['ligaId'] ) ? $_POST['ligaId'] : null;
            if ( $ligaId !=  null ) {
                $dataZona = null;
                $zonaId = editZona( $ligaId, $dataZona);
                $respuesta = array(
                    'msj' => '',
                    'error' => '',
                    'html' => '',
                );

                //una vez creada la zona, hay que editar la liga para que se guarde la zona
                if ( $zonaId > 0 ) {
                    $zonaGuardada = saveZonaOnLiga( $ligaId, $zonaId );

                    //si se guardó, se muestra el template
                    if ($zonaGuardada == 'updated') {

                        //agrega la zona al template
                        $dataZona =  getPostsFromDeportesById( $zonaId, 'zonas' );
                        ob_start();
                        getTemplate('loop-zona', $dataZona);
                        $respuesta['html'] = ob_get_contents();
                        ob_end_clean();
                        $respuesta['msj'] = $zonaId;
                    } else {
                        //como la zona no se pudo grabar en la liga, entonces se borra la zona para no provocar errores
                        $zonas = array( $zonaId );
                        deleteZona( $zonas );
                    }
                    

                } else {
                    $respuesta['error'] = 'hubo un error, no se pudo crear la zona';
                }
            } else {
                $respuesta['error'] = 'hubo un error, falta liga id';
            }

            echo json_encode($respuesta);
            

        break;


        /*
         * guardar equipo
        */
        case 'editar-equipo':
        
            echo editarEquipo($_POST);

        break;
        
        
    }//switch ajax
    
} //if not ajax
else {
	exit;
}