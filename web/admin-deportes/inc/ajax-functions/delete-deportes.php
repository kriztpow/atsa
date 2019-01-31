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

   }

} //if not ajax
else {
	exit;
}

function deleteLiga($ligaId){
   $connection = connectDB();
   
   //para borrar la liga hay que borrar todas las zonas y partidos:
   //primero recuperamos los datos de la liga
   $liga = getPostsFromDeportesById( $ligaId, 'liga' );
   
   $zonas = $liga['zonas_id'];
   $zonas = explode(',', $zonas);

   $borrarZonas = deleteZona($zonas);

   if ($borrarZonas == 'ok') {
      //finalmente borramos la liga
      $query      = "DELETE FROM liga WHERE id= '".$ligaId."'";
      $result     = mysqli_query($connection, $query);
         
      if ($result) {
         $respuesta = 'deleted';
      } else {
            $respuesta = 'error-deleted-post';
      }
   }

   //cierre base de datos
   mysqli_close($connection);

   return $respuesta;
}//deleteLiga()

function deleteZona($zonas = array() ) {
   $connection = connectDB();

   //para guardar los partidos de cada zona
   $partidos = array();
   $Zonasborradas = 0;

   foreach ($zonas as $zona ) {
      //se recuperan los datos de la zona
      $dataZona = getPostsFromDeportesById( $zona, 'zonas' );
      $partidosIds = $dataZona['partidos_ids'];
      $partidosIds = explode(',', $partidosIds);

      //$partidosBorrados = deletePartidos($partidosIds);
      for ($i=0; $i < count($partidosIds); $i++) { 
         if ( ! in_array($partidosIds[$i], $partidos) ) {
            array_push($partidos, $partidosIds[$i]);
         }
      }
      
      $query      = "DELETE FROM zonas WHERE id= '".$zona."'";
      $result     = mysqli_query($connection, $query);
         
      if ($result) {
         $Zonasborradas = $Zonasborradas+1;
      } 
      
   }

   if ( count($zonas) != $Zonasborradas) {
      
      $respuesta = 'error-borrado-zonas';

   } else {
      $respuesta = 'ok';
   }

   //ahora se borran los partidos
   if (! empty($partidos) ) {
      $respuesta = deletePartidos($partidos);
   } 
   
   //cierre base de datos
   mysqli_close($connection);
   return $respuesta;

}//deleteZona()

function deletePartidos($partidos = array() ) {
   $connection = connectDB();
   $conteo = 0;

   foreach ($partidos as $partido ) {
      
      $query      = "DELETE FROM partidos WHERE id= '".$partido."'";
      $result     = mysqli_query($connection, $query);
         
      if ($result) {
         $conteo++;
      } 
      
   }

   if ( count($partidos) != $conteo) {
      $respuesta = 'error-borrado-partidos';
   } else {
      $respuesta = 'ok';
   }

   //cierre base de datos
   mysqli_close($connection);
   return $respuesta;
}