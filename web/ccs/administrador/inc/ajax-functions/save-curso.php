<?php
/*
 * guarda la página
 * Since 6.0
 * Maneja el backend del editor de la página de inicio
*/
require_once('../functions.php');
if ( isAjax() ) {

	//se toman los datos para variables
	$connection      = connectDB();
	$tabla           = 'cursos';
	$cursoId         = isset( $_POST['curso_id'] ) ? $_POST['curso_id'] : 'new';
	$curso_titulo    = isset($_POST['curso_titulo']) ? $_POST['curso_titulo'] : '';
	$curso_subtitulo = isset($_POST['curso_subtitulo']) ? $_POST['curso_subtitulo'] : '';
  $curso_texto     = isset($_POST['curso_texto']) ? $_POST['curso_texto'] : '';
  $curso_horarios  = isset($_POST['curso_horarios']) ? $_POST['curso_horarios'] : '';
  $curso_orden     = isset($_POST['curso_orden']) ? $_POST['curso_orden'] : '0';
  $curso_imagen    = isset($_POST['curso_imagen']) ? $_POST['curso_imagen'] : '';
  
	//saneamiento
  $curso_titulo    =filter_var($curso_titulo,FILTER_SANITIZE_STRING);
  $curso_subtitulo =filter_var($curso_subtitulo,FILTER_SANITIZE_STRING);
  $curso_orden     =filter_var($curso_orden,FILTER_SANITIZE_NUMBER_INT);

  //ACTUALIZAR CURSO
  $query = "UPDATE ".$tabla." SET curso_titulo='".$curso_titulo."', curso_subtitulo='".$curso_subtitulo."', curso_texto='".$curso_texto."', curso_horarios='".$curso_horarios."', curso_imagen='".$curso_imagen."', curso_orden='".$curso_orden."' WHERE curso_id='".$cursoId."' LIMIT 1";

    $updateCurso = mysqli_query($connection, $query); 
    
    if ($updateCurso) {
      echo 'Curso actualizado';
    } else {
      echo 'Hubo un error, intente maś tarde';
    }
  

	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}