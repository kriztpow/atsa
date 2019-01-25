<?php
/*
 * Since 3.0
 * borra el slider seleccionado
*/
require_once('../functions.php');
require_once('../modulos/modulo-sliders.php');
if ( isAjax() ) {

	$connection = connectDB();
	$tabla      = 'sliders';
	$sliderIMG  = isset( $_POST['sliderImagen'] ) ? $_POST['sliderImagen'] : '';
	$newSlider  = isset( $_POST['new'] ) ? $_POST['new'] : 'false';
	$ubicacion  = isset( $_POST['ubicacion'] ) ? $_POST['ubicacion'] : '';
	

	//actualizar slider
	if ($newSlider != 'true') {
		$sliderID   = isset( $_POST['sliderId'] ) ? $_POST['sliderId'] : '';
		$titulo     = isset( $_POST['titulo'] ) ? $_POST['titulo'] : '';
		$url        = isset( $_POST['url'] ) ? $_POST['url'] : '';
		$texto      = isset( $_POST['texto'] ) ? $_POST['texto'] : '';
		$textoBTN   = isset( $_POST['textoBtn'] ) ? $_POST['textoBtn'] : '';
		$orden      = isset( $_POST['orden'] ) ? intval($_POST['orden']) : 0;
		$titulo     = filter_var($titulo,FILTER_SANITIZE_STRING); 
		$texto      = filter_var($texto,FILTER_SANITIZE_STRING); 
		$textoBTN   = filter_var($textoBTN,FILTER_SANITIZE_STRING); 
		$orden      = filter_var($orden,FILTER_SANITIZE_NUMBER_INT); 
 		$url        = filter_var($url,FILTER_SANITIZE_URL); 
 		
		$query      = "UPDATE ".$tabla." SET slider_imagen='".$sliderIMG."', slider_titulo='".$titulo."', slider_link='".$url."', slider_textoLink='".$textoBTN."', slider_texto='".$texto."', slider_orden='".$orden."' WHERE slider_id='".$sliderID."' LIMIT 1";
		$result     = mysqli_query($connection, $query);
   
		if ($result) {
			echo 'saved';
	   	} else {
	   		echo 'error';
	   	}
	   
	} //crear nuevo slider

	else {
		$queryCreateSlider  = "INSERT INTO " .$tabla. " (slider_imagen,slider_ubicacion) VALUES ('".$sliderIMG."','".$ubicacion."')";
		$result = mysqli_query($connection, $queryCreateSlider);
		//var_dump($connection);
		//echo mysqli_insert_id($connection);
		$sliderID = mysqli_insert_id($connection);
		$data = getSliderId($sliderID);
		getTemplate( 'loop-slider', $data );
		?>
		
	<?php
	}//else


} //if not ajax
else {
	exit;
}