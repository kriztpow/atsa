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

   }

} //if not ajax
else {
	exit;
}