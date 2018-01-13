<?php 
global $userStatus;
if ($userStatus != '0' && $userStatus != '1' ) {
	echo 'No tiene permisos para ver esta sección';
  	
  	exit;
}
require_once("inc/functions.php");
load_module( 'cursos' );

$cursos = listaCurso ();
?>
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		Cursos y Talleres
	</h1>
	<div class="container">
		
		<div id="imagen_destacada_wrapper">
			<button id="new-curso" class="btn btn-primary">Agregar nuevo curso</button>
		</div>

		<ul class="wrapper-cursos">			

	<?php 
	if ( ! $cursos ) {
		echo 'No hay ningún curso cargado';
	} else {
		for ($i=0; $i < count($cursos); $i++) {
			$curso = $cursos[$i];
			templateCursoAdmin( $curso );
	
	}//for
	}//else
	?>
		</ul>

	</div>
</div>
<div id="dialog">
	
</div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>