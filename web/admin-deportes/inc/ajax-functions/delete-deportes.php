<?php
/*
 * delete liga
 * borra el post seleccionado de acuerdo a su id
*/
require_once('../functions.php');
load_module('deportes');
if ( isAjax() ) {

   $action = isset( $_POST['action'] ) ? $_POST['action'] : '';

   switch ($action) {
      case 'delete-liga':
         $id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';
         echo deleteLiga($id);
         
      break;

      case 'delete-zona':

         $ZonaId = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';

         echo borrarZonaFromLiga($ZonaId);
         
      break;

      case 'delete-jugador':

         $id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';

         echo deleteJugador($id);
         
      break;

      case 'delete-equipo':

         $id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';

         echo deleteEquipo($id);
         
      break;

      case 'delete-partido':

         $id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';

         echo deletePartido($id);
         
      break;

      case 'delete-gol':

         $id = isset( $_POST['id'] ) ? $_POST['id'] : '';
         $partido = isset( $_POST['partido'] ) ? $_POST['partido'] : '';
         
         echo deleteExtraPartido( 'gol', $id, $partido );
         
      break;

      case 'delete-amonestacion':

         $id = isset( $_POST['id'] ) ? $_POST['id'] : '';
         $partido = isset( $_POST['partido'] ) ? $_POST['partido'] : '';

         echo deleteExtraPartido( 'amonestacion', $id, $partido );
         
      break;

      case 'delete-contenido':

         $id = isset( $_POST['id'] ) ? $_POST['id'] : '';
         $partido = isset( $_POST['partido'] ) ? $_POST['partido'] : '';

         echo deleteExtraPartido( 'contenido', $id, $partido );
         
      break;
   }

} //if not ajax
else {
	exit;
}