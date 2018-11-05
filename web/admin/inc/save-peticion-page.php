<?php
/*
 * update section
 * Since 4.0
 * convenios
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'peticiones';
	
    $id                = isset($_POST['id']) ? $_POST['id'] : '';
    $tituloGeneral     = isset($_POST['titulo_general']) ? $_POST['titulo_general'] : '';
    $urlPrivacidad     = isset($_POST['url_privacidad']) ? $_POST['url_privacidad'] : '';
    $headerImagen      = isset($_POST['header_imagen']) ? $_POST['header_imagen'] : '';
    $compartirImagen   = isset($_POST['compartir_imagen']) ? $_POST['compartir_imagen'] : '';
    $video             = isset($_POST['video']) ? $_POST['video'] : '';
    $tituloFormulario  = isset($_POST['titulo_formulario']) ? $_POST['titulo_formulario'] : '';
    $tituloInferior    = isset($_POST['titulo_inferior']) ? $_POST['titulo_inferior'] : '';
    $hashtag           = isset($_POST['hashtag']) ? $_POST['hashtag'] : '';
    $texto             = isset($_POST['texto']) ? $_POST['texto'] : '';
    $resumen           = isset($_POST['resumen']) ? $_POST['resumen'] : '';
    $graciasImagen     = isset($_POST['gracias_imagen']) ? $_POST['gracias_imagen'] : '';
    $textoGracias      = isset($_POST['texto_gracias']) ? $_POST['texto_gracias'] : '';
    $fecha             = strtotime(date("d-m-Y H:i:00"));

    //texto
    $tituloGeneral = filter_var($tituloGeneral,FILTER_SANITIZE_STRING);
    $tituloFormulario = filter_var($tituloFormulario,FILTER_SANITIZE_STRING);
    $tituloInferior = filter_var($tituloInferior,FILTER_SANITIZE_STRING);
	$hashtag = filter_var($hashtag,FILTER_SANITIZE_STRING);
    $resumen = filter_var($resumen,FILTER_SANITIZE_STRING);

    //imagenes
    $headerImagen = filter_var($headerImagen,FILTER_SANITIZE_STRING);
    $compartirImagen = filter_var($compartirImagen,FILTER_SANITIZE_STRING);
    $graciasImagen = filter_var($graciasImagen,FILTER_SANITIZE_STRING);

	//urls
    $video = filter_var($video,FILTER_SANITIZE_URL);
    $urlPrivacidad = filter_var($urlPrivacidad,FILTER_SANITIZE_URL);
    
    $urlbasica = 'https://www.youtube.com/watch?v=';

	if ( $video != '' && strpos($video, '=') === false ) {
		$video = $urlbasica . explode('/',$video)[3];
	}

	$queryUpdateSection = "UPDATE ".$tabla." SET titulo_general='".$tituloGeneral."', url_privacidad='".$urlPrivacidad."', header_imagen='".$headerImagen."', compartir_imagen='".$compartirImagen."', video='".$video."', titulo_formulario='".$tituloFormulario."', titulo_inferior='".$tituloInferior."', hashtag='".$hashtag."', texto='".$texto."', resumen='".$resumen."', gracias_imagen='".$graciasImagen."', texto_gracias='".$textoGracias."', fecha_modificacion='".$fecha."'  WHERE id='".$id."' LIMIT 1";

        
    $result = mysqli_query($connection, $queryUpdateSection);
    
	if ($result) {
		echo 'Cambios Guardados';
	} else {
		echo 'Hubo un error';
	}
    
    
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}