<?php
/*
 * Archivo de imagenes / inserta imagen nueva
 * versión reducida para el editor TinyMCE
 * Since 3.0
 * 
*/
require_once("../../functions.php");
$carpeta_pdfs = UPLOADS . '/pdfs';
$directorio = opendir( $carpeta_pdfs ); // Abre la carpeta

?>
<ul style="columns:3;">

<?php
while ($pdf = readdir( $directorio )) { // Lee cada uno de los ficheros
	if (!is_dir($pdf)){ // Omite las carpetas
		echo '<li style="margin:10px; cursor:pointer" class="pdf" data-src="'.$pdf.'">'.$pdf.'</li>';
	}
}
?>

</ul>
<input type="hidden" class="previewAtachment" name="previewAtachment" value="">