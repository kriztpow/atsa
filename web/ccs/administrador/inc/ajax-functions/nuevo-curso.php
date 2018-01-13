<?php
/*
 * delete slider
 * Since 3.0
 * borra el slider seleccionado
*/
require_once('../functions.php');
load_module( 'cursos' );
if ( isAjax() ) {

	$connection = connectDB();
	$tabla      = 'cursos';
	$curso   = isset( $_POST['curso'] ) ? $_POST['curso'] : 'none';
	//borramos el post
	$queryNew = "INSERT INTO ".$tabla." (curso_titulo,curso_texto, curso_horarios) VALUES ('Agregue un título','','')";

	$nuevoCurso = mysqli_query($connection, $queryNew);
	//print_r($connection);

   if ($nuevoCurso) {
		
		$id = mysqli_insert_id($connection);
		
		$query  = "SELECT * FROM " .$tabla. " WHERE curso_id = '".$id."' ";	
		$result = mysqli_query($connection, $query);
		$curso = $result->fetch_array();

		templateCursoAdmin( $curso );

   } else {
   		echo 'error';
   }
	//cierre base de datos
	mysqli_close($connection);


} //if not ajax
else {
	exit;
}