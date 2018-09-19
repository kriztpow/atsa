<?php
/*
 * vivo section
*/
require_once("functions.php");
if ( isAjax() ) {
	
	$connection = connectDB();
	$tabla = 'options';
	
	$link = isset($_POST['video_link']) ? $_POST['video_link'] : '';
	$text = isset($_POST['video_text']) ? $_POST['video_text'] : '';;

	$link = filter_var($link,FILTER_SANITIZE_URL);
	$text = filter_var($text,FILTER_SANITIZE_STRING);

	$urlbasica = 'https://www.youtube.com/watch?v=';

	if ( $link != '' && strpos($link, '=') === false ) {
		$link = $urlbasica . explode('/',$link)[3];
	}

	$query  = "UPDATE ".$tabla." SET option_value='".$link."' WHERE option_name='video_vivo_link' LIMIT 1";

	$result = mysqli_query($connection, $query);
	
	$query2  = "UPDATE ".$tabla." SET option_value='".$text."' WHERE option_name='video_vivo_text' LIMIT 1";

	$result2 = mysqli_query($connection, $query2);

	//cierre base de datos
	mysqli_close($connection);

	if ( $result && $result2 ) {
		echo 'Cambios guardados';
	} else {
		echo 'Hubo un error';
	}

} //if not ajax
else {
	exit;
}