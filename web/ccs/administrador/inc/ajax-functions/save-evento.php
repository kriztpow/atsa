<?php
/*
 * guarda la página
 * Since 6.0
 * Maneja el backend del editor de la página de inicio
*/
require_once('../functions.php');
if ( isAjax() ) {

	//se toman los datos para variables
	$connection  = connectDB();
	$tabla       = 'agenda';
	$id          = isset( $_POST['id'] ) ? $_POST['id'] : '';
	$titulo      = isset($_POST['titulo']) ? $_POST['titulo'] : '';
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
  $url         = isset($_POST['url']) ? $_POST['url'] : '';
  $fechaIn     = isset($_POST['fechaIn']) ? $_POST['fechaIn'] : '';
  $fechaOut    = isset($_POST['fechaOut']) ? $_POST['fechaOut'] : '0';
  $horaIn      = isset($_POST['horaInicio']) ? $_POST['horaInicio'] : '';
  $horaOut     = isset($_POST['horaFinal']) ? $_POST['horaFinal'] : '';
  $categoria   = isset($_POST['categoria']) ? $_POST['categoria'] : 'muestras';

	//saneamiento
  $titulo    =filter_var($titulo,FILTER_SANITIZE_STRING);
  $descripcion =filter_var($descripcion,FILTER_SANITIZE_STRING);
  $url     =filter_var($url,FILTER_SANITIZE_STRING);

  //dar formato a fecha y hora

  if ( $fechaOut == '' ) {
    $fechaOut = $fechaIn;
  }

  if ( $horaOut == '' ) {
    $horaOut = $horaIn;
  }

  $fecha_in = $fechaIn . ' ' . $horaIn;
  $fecha_out = $fechaOut . ' ' . $horaOut;

  if ( $id != 'new' ) {


  //ACTUALIZAR CURSO
  $query = "UPDATE ".$tabla." SET agenda_titulo='".$titulo."', agenda_descripcion='".$descripcion."', agenda_url='".$url."', agenda_fecha_in='".$fecha_in."', agenda_fecha_out='".$fecha_out."', agenda_categoria='".$categoria."' WHERE agenda_id='".$id."' LIMIT 1";

    $updateEnveto = mysqli_query($connection, $query); 
    
    //print_r($connection);
    if ($updateEnveto) {
      echo 'ok';
    } else {
      echo 'error';
    }
  
  } else {

    $query = "INSERT INTO ".$tabla." (agenda_titulo, agenda_descripcion, agenda_url, agenda_categoria, agenda_fecha_in, agenda_fecha_out) VALUES ('$titulo', '$descripcion', '$url', '$categoria', '$fecha_in', '$fecha_out')";

    $nuevoEvento = mysqli_query($connection, $query); 
    //print_r($connection);
    if ($nuevoEvento) {
      echo 'nuevo';
    } else {
      echo 'error';
    }

  }

	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}