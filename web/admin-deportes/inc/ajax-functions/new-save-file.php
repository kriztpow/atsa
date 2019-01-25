<?php
/*
 * save file on options table
 * Since 5.0
*/
require_once('../functions.php');
require_once('../modulos/modulo-sliders.php');
if ( isAjax() ) {

	$connection = connectDB();
	$tabla      = 'options';
	$file  = isset( $_POST['file'] ) ? $_POST['file'] : '';
	$new  = isset( $_POST['new'] ) ? $_POST['new'] : 'false';
	$optionsName  = isset( $_POST['optionsName'] ) ? $_POST['optionsName'] : '';
	

	//actualizar slider
	if ($new != 'true') { 
 		
		$query      = "UPDATE ".$tabla." SET options_value='".$file."' WHERE options_name='".$optionsName."' LIMIT 1";
		$result     = mysqli_query($connection, $query);
   
		if ($result) {
			echo 'saved';
	   	} else {
			   echo 'error';
			   print_r($connection);
	   	}
	   
	} else {
		//crear nuevo slider

		$queryCreate  = "INSERT INTO " .$tabla. " (options_name,options_value,options_note) VALUES ('".$optionsName."','".$file."','')";
		$result = mysqli_query($connection, $queryCreate);
		
		//echo mysqli_insert_id($connection);
		$sliderID = mysqli_insert_id($connection);
	}//else
	
   	//cierre base de datos
	mysqli_close($connection);


} //if not ajax
else {
	exit;
}