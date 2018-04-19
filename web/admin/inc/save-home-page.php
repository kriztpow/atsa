<?php
/*
 * update section
 * Since 4.0
 * convenios
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'homepage';
	
	$conectados_texto= $_POST['conectados_texto'];
	$audiovisual_titulo = mysqli_real_escape_string($connection, $_POST['audiovisual_titulo']);
	$audiovisual_parrafo = mysqli_real_escape_string($connection, $_POST['audiovisual_parrafo']);
	$voces_titulo = mysqli_real_escape_string($connection, $_POST['voces_titulo']);
	$voces_parrafo= mysqli_real_escape_string($connection, $_POST['voces_parrafo']);
	$afiliate_titulo = mysqli_real_escape_string($connection, $_POST['afiliate_titulo']);
	$afiliate_parrafo = mysqli_real_escape_string($connection, $_POST['afiliate_parrafo']);
	$frase= mysqli_real_escape_string($connection, $_POST['frase']);

	$audiovisual_titulo = filter_var($audiovisual_titulo,FILTER_SANITIZE_STRING);
	$audiovisual_parrafo = filter_var($audiovisual_parrafo,FILTER_SANITIZE_STRING);
	$voces_titulo = filter_var($voces_titulo,FILTER_SANITIZE_STRING);
	$voces_parrafo = filter_var($voces_parrafo,FILTER_SANITIZE_STRING);
	$afiliate_titulo = filter_var($afiliate_titulo,FILTER_SANITIZE_STRING);
	$afiliate_parrafo = filter_var($afiliate_parrafo,FILTER_SANITIZE_STRING);
	$frase = filter_var($frase,FILTER_SANITIZE_STRING);

	//urls
	$audiovisual_video = filter_var($_POST['audiovisual_video'],FILTER_SANITIZE_URL);
	$voces_url = filter_var($_POST['voces_url'],FILTER_SANITIZE_URL);
	$afiliate_url = filter_var($_POST['afiliate_url'],FILTER_SANITIZE_URL);
	$conectados_video= filter_var($_POST['conectados_video'],FILTER_SANITIZE_URL);
	$conectados_url = filter_var($_POST['conectados_url'],FILTER_SANITIZE_URL);

	//imagenes
	$voces_imagen= $_POST['voces_imagen'];
	$afiliate_imagen = $_POST['afiliate_imagen'];
	$banners = array(
		$_POST['banner_imagen1'],
		$_POST['banner_imagen2'],
		$_POST['banner_imagen3'],
		$_POST['banner_imagen4']
	);

	$banners = serialize($banners);

	$queryUpdateSection = "UPDATE ".$tabla." SET audiovisual_titulo='".$audiovisual_titulo."', audiovisual_video='".$audiovisual_video."', audiovisual_parrafo='".$audiovisual_parrafo."', voces_titulo='".$voces_titulo."', voces_imagen='".$voces_imagen."', voces_parrafo='".$voces_parrafo."', voces_url='".$voces_url."', afiliate_titulo='".$afiliate_titulo."', afiliate_imagen='".$afiliate_imagen."', afiliate_parrafo='".$afiliate_parrafo."', afiliate_url='".$afiliate_url."', banners='".$banners."', conectados_texto='".$conectados_texto."', conectados_video='".$conectados_video."', conectados_url='".$conectados_url."', frase='".$frase."'  WHERE id_home=1 LIMIT 1";


	$result = mysqli_query($connection, $queryUpdateSection);
	if ($result) {
		echo 'Cambios Guardados';
	} else {
		echo 'Hubo un error';
	}
	print_r($connection);
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}