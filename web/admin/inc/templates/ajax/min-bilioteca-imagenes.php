<?php
/*
 * Archivo de imagenes / inserta imagen nueva
 * versión reducida para el editor TinyMCE
 * Since 3.0
 * 
*/
require_once("../../functions.php");
$carpeta_imagenes = UPLOADSIMAGES;
$directorio = opendir( $carpeta_imagenes ); // Abre la carpeta

?>
<ul id="libreria" style="columns:3;">

<?php
while ($imagen = readdir( $directorio )) { // Lee cada uno de los ficheros
	if (!is_dir($imagen)){ // Omite las carpetas
		echo '<li style="margin:5px;border:1px solid #333;cursor:pointer;" class="imagen" data-src="'.$imagen.'"><img class="img-responsive" src="'.UPLOADSURLIMAGES.'/'.$imagen.'"></li>';
	}
}
?>

</ul>