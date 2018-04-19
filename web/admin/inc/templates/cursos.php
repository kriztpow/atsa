<?php
/*
 * Editar sección cursos:
 * Instituto de formacion profesional y cursos no formales
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			
			<div id="cursosacordion">
				<h3>Formación Técnico profesional</h3>
				<div>
					<button class="btn btn-warning btn-sm btn-new-curso" data-tipo="formacion-tecnica">Crear nuevo Curso</button>
					<ul class="lista-cursos" id="contenedor-formacion-tecnica">
						<?php listCursosAdmin ( 'formacion_tecnica' ); ?>
					</ul>
				</div><!-- // accordion item -->
				<h3>Cursos no formales</h3>
				<div>
					<div class="container-fluid">
						<button class="btn btn-warning btn-sm btn-new-curso" data-tipo="no-formal">Crear nuevo Curso</button>
						<ul class="lista-cursos" id="contenedor-no-formal">
							<?php listCursosAdmin ( 'no_formal' ); ?>
						</ul>
					</div>
				</div><!-- // accordion item -->
				<h3>Convenios Universitarios</h3>
				<div>
					<div class="container-fluid">
						<button class="btn btn-warning btn-sm btn-new-curso" data-tipo="universitarios">Crear nuevo Convenio</button>
						<ul class="lista-cursos" id="contenedor-universitarios">
							<?php listCursosAdmin ( 'universitarios' ); ?>
						</ul>
					</div>
				</div><!-- // accordion item -->

				<h3>Instituto Amado olmos</h3>
				<div>
					<div class="container-fluid">
						<ul class="lista-cursos" id="contenedor-instituto">
							<?php showInstitutoAdmin ( 'instituto' ); ?>
						</ul>
					</div>
				</div><!-- // accordion item -->
			</div><!-- // accordion -->
		</div><!-- // container -->
		<div id="dialog">
			
		</div>
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->