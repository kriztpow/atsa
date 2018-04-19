<?php
/*
 * save button
 * @since 1.0
 * guarda todos los botones segun el caso
*/
require_once("connect.php");
//require( 'functions.php' );

$section = $_POST['section'];

switch ($section) {
	//galeria de imagenes
	case 'admin=galeria':
	$galeria = $_POST['galeria'];
	$tabla = 'img_uploads';
	$result = 0;
	$deleted = 0;

	//var_dump($_POST);
	if ( isset($_POST['recicleBin']) ) {
		$recicleBin = $_POST['recicleBin'];
	} else {
		$recicleBin = false;
	}


	//borrar las imagenes de la papelera
	if ( $recicleBin != false) {
		//si hay algo en la papelera, es decir si hay más de 0 se borran
		for ($i=0; $i < count($recicleBin); $i++) { 
			$image_id    = $recicleBin[$i]['image_id'];
			
			$query = "DELETE FROM ".$tabla." WHERE image_id= '".$image_id."'";	
			
			$updateBD = mysqli_query($connection, $query);

			if ($updateBD) {
				$deleted ++;
			} 
		}
	}

	//cambiar el orden
	for ($i=0; $i < count($galeria); $i++) { 
		$image_id    = $galeria[$i]['image_id'];
		$orden       = $galeria[$i]['orden'];
		
		$query = "UPDATE ".$tabla." SET orden= '".$orden."' WHERE image_id= '".$image_id."'";	
		
		$updateBD = mysqli_query($connection, $query);

		if ($updateBD) {
			$result ++;
		} 
	}

	echo $result . 'registros actualizados y ' . $deleted. ' fueron borrados';
	break;//galeria de imagenes


	//caso promociones
	case 'admin=popups':

	$popup = $_POST['popup'];
	$tabla = 'options';
	$popup_name = 'popupValue';

	$query = "UPDATE ".$tabla." SET options_value = '".$popup."' WHERE options_name = 'popupValue'";	
		
		$updateBD = mysqli_query($connection, $query);
	
	break;//promos popups

	//caso otras opciones
	case 'admin=otros':
	$otrosLinks = $_POST['otroslinks'];
	$tabla = 'file_uploads';
	$result = 0;

	for ($i=0; $i < count($otrosLinks); $i++) { 
		$inputValue    = $otrosLinks[$i]['inputValue'];
		$post_type       = $otrosLinks[$i]['inputID'];
		
		$query = "REPLACE INTO ".$tabla." (tipo_imagen,url,orden,post_type) VALUES('link','".$inputValue."',0,'".$post_type."')";	

		$updateBD = mysqli_query($connection, $query);

		if ($updateBD) {
			$result ++;
		} 

	}
	echo 'actualizados: '.$result;

	break;//promos popups
}//fin switch 