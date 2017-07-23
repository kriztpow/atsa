<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * CURSOS.PHP
 * Pagina que muestra los cursos
*/
//require_once 'inc/config.php';
//require_once 'inc/functions.php';

//recupera el slug
global $curso;

//como no hay base de datos va a buscar los datos del curso entre todas las variables y la va a mostrar
global $cursosFormacionTecnicaProfesional;

for ($i=0; $i < count($cursosFormacionTecnicaProfesional); $i++) {
	//recoore el array y solo muestra el que coincide con el url
	//(esto es porque todavia no hay base de datos y no podemos buscar el slug en cuestion)
	$cursoURL = $cursosFormacionTecnicaProfesional[$i]['slug'];

	//si es de categoria atsa la muestra
	if ( $cursoURL == $curso ) {
		$cursoTitulo = $cursosFormacionTecnicaProfesional[$i]['cursoTitulo'];
		$cursoMetodologia = $cursosFormacionTecnicaProfesional[$i]['cursoMetodologia'];
		$cursoObjGeneral = $cursosFormacionTecnicaProfesional[$i]['cursoObjGeneral'];
		$cursoObjEspecifico = $cursosFormacionTecnicaProfesional[$i]['cursoObjEspecifico'];
		$cursoRequisitos = $cursosFormacionTecnicaProfesional[$i]['cursoRequisitos'];
		$imgCurso = $cursosFormacionTecnicaProfesional[$i]['imgCurso'];
		$cursoCertificado = $cursosFormacionTecnicaProfesional[$i]['cursoCertificado'];
		$cursoCursada = $cursosFormacionTecnicaProfesional[$i]['cursoCursada'];
		$cursoLugar = $cursosFormacionTecnicaProfesional[$i]['cursoLugar'];
		$cursoHorarios = $cursosFormacionTecnicaProfesional[$i]['cursoHorarios'];
		$cursoDestinatarios = $cursosFormacionTecnicaProfesional[$i]['cursoDestinatarios'];
		$cursoDestacado = $cursosFormacionTecnicaProfesional[$i]['cursoDestacado'];
		$noCurso = false;

		?>
		<article id="cursos" class="wrapper-page less-padding">
		    <div class="container">
		    	<div class="title-deco-guion">
				    <h2 class="title-cursos">
				    	Instituto de Formación Técnico Profesional
				    </h2>
			    </div>

		    	<div class="row">
			    	<div class="col-md-8">
				    	<h1 class="download-estudios">
				    		<?php echo $cursoTitulo; ?>
				    	</h1>
				    	<div class="contenido-accordion-cursos">
				    		<strong>Metodología:</strong>
				    		<?php echo $cursoMetodologia; ?>
				    	</div>

			    		<div id="accordion-cursos">
			    		<?php
			    			if ( $cursoDestinatarios != 'none' ) {
			    				?>
			    				<!-- item tab -->
							   		<!-- item tab -->
						   		<h3>
							  		<span class="text-title-accordion background-color">
								  		Destinatarios
								  	</span>
								  <span class="icon-suma"></span>
								</h3>
							  	<div class="contenido-accordion-cursos">
							  		<?php echo $cursoDestinatarios; ?>
							  	</div><!-- //item tab -->
			    				<?php
			    			}
			    		?>
						   	<!-- item tab -->
					   		<h3>
						  		<span class="text-title-accordion background-color">
							  		Objetivos Generales
							  	</span>
							  <span class="icon-suma"></span>
							</h3>
						  	<div class="contenido-accordion-cursos">
						  		<?php echo $cursoObjGeneral; ?>
						  	</div><!-- //item tab -->

						  	<!-- item tab -->
					   		<h3>
						  		<span class="text-title-accordion">
							  		Objetivos Específicos
							  	</span>
							  <span class="icon-suma"></span>
							</h3>
						  	<div class="contenido-accordion-cursos">
						  		<?php echo $cursoObjEspecifico; ?>
						  	</div><!-- //item tab -->

						  	<!-- item tab -->
					   		<h3>
						  		<span class="text-title-accordion">
							  		Requisitos
							  	</span>
							  <span class="icon-suma"></span>
							</h3>
						  	<div class="contenido-accordion-cursos">
						  		<?php echo $cursoRequisitos; ?>
						  	</div><!-- //item tab -->
					  	</div><!-- //#accordion-cursos -->
					</div><!-- //.col-md-8 -->


					<div class="col-md-4">
			    		<img class="img-responsive" src="uploads/images/cursos/<?php echo $imgCurso; ?>">
			    		<div>
			    			<h2 class="info-enfermeria"><span class="icon-info icon-info-1"></span>
			    				<?php echo $cursoCertificado; ?>
			    			</h2>

			    			<ul>
			    				<li class="info-enfermeria"><span class="icon-info icon-info-3"></span>
			    					<?php echo $cursoCursada; ?>
			    				</li>
			    				<li class="info-enfermeria"><span class="icon-info icon-info-5"></span>
			    					<?php echo $cursoLugar; ?>
			    				</li>
			    				<li class="info-enfermeria"><span class="icon-info icon-info-6"></span>
			    					<?php echo $cursoHorarios; ?>
			    				</li>
			    			</ul>
			    		</div>
			    	</div><!-- //.col-md-4 -->

				</div><!-- //.row -->
		    </div><!-- //.container -->
		</article>

		<?php
		break;
	} else {
		echo 'No se encuentra curso a mostrar';
	}
}//for
?>

<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-cursos" ).accordion({
    		heightStyle: "content"
    	});
		iconSumaOpener();
		
    	$('.ui-accordion-header').click(iconSumaOpener);//click
    	
    });//ready

function iconSumaOpener () {
	$('.ui-accordion-header').each(function(){
    		
		if ($(this).hasClass('ui-accordion-header-active')) {
			$('.icon-suma', this).addClass('icon-suma-open');
		} else {
			$('.icon-suma', this).removeClass('icon-suma-open');
		}
	});
}
	
</script>