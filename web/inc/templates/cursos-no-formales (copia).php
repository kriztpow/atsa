<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * CURSOS-FORMALES-NO-FORMALES.PHP
 * Pagina que muestra los cursos no formales
*/
require_once 'inc/config.php';
require_once 'inc/functions.php';

//array o lista de cursos, luego será remplazada por la data de la base de datos
$dataCursosNoFormales = array(
	array(
		'tituloCurso' => 'Curso de masajes terapéuticos | Nivel Básico',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Curso de masajes terapéuticos - Nivel avanzado',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Curso de cosmetología - Nivel básico',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Curso de cosmetología - Nivel avanzado',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Curso de manicuría',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Inglés Nivel inicial',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Inglés Nivel avanzado',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Facturación',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Liquidación de sueldos y jornales',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),
	array(
		'tituloCurso' => 'Computación Curso Junior',
		'duracionCurso' => 'Duración: 4 meses - 1 vez por semana',
		'horasCurso' => '2.30 horas reloj',
	),
	array(
		'tituloCurso' => 'Computación Curso Senior',
		'duracionCurso' => 'Duración: 3 meses - 1 vez por semana',
		'horasCurso' => '2.30 horas reloj',
	),
	array(
		'tituloCurso' => 'Power Point e internet',
		'duracionCurso' => 'Duración: 3 meses - 1 vez por semana',
		'horasCurso' => '2 horas reloj',
	),

);//fin array data cursos

//función que hace loop en la data mostrando los cursos
function htmlCursosNoFormales ($data) {
	
	for ($i=0; $i < count($data); $i++) { 
		$tituloCurso = $data[$i]['tituloCurso'];
		$duracionCurso = $data[$i]['duracionCurso'];
		$horasCurso = $data[$i]['horasCurso'];

		$htmlToPrint = '';

		//$htmlToPrint .= '<!-- item tab -->';
		$htmlToPrint .= '<h3>';
		$htmlToPrint .= '<span class="text-title-accordion">';
		$htmlToPrint .= $tituloCurso;
		$htmlToPrint .= '</span>';
		$htmlToPrint .= '<span class="icon-suma"></span>';
		$htmlToPrint .= '</h3>';
		$htmlToPrint .= '<div class="contenido-accordion-cursos-no-formales">';
		$htmlToPrint .= '<ul>';
		$htmlToPrint .= '<li class="info-enfermeria"><span class="icon-info icon-info-3"></span>';
		$htmlToPrint .= $duracionCurso;
		$htmlToPrint .= '</li>';
		$htmlToPrint .= '<li class="info-enfermeria"><span class="icon-info icon-info-6"></span>';
		$htmlToPrint .= $horasCurso;
		$htmlToPrint .= '</li>';
		$htmlToPrint .= '</ul>';
		$htmlToPrint .= '</div>';
		
		echo $htmlToPrint;
	
	}//bucle for

	

}//htmlCursosNoFormales()


?>
<article id="formales-no-formales" class="wrapper-page less-padding">
	<div class="container">
	    <h1>Cursos no formales</h1>
	    <div class="row">
	    	<div class="col-md-8">
	    		<p>
	    			En nuestra Sede Central brindamos Cursos no Formales, los cuales incluyen material.
	    		</p>
	    		
	    		
	    <!----------lista de cursos -------->
	    		<div id="accordion-cursos-no-formales">

			   		<?php htmlCursosNoFormales($dataCursosNoFormales); ?>

			   	</div><!-- //#accordion -->
	    	</div><!-- //.col-md-6 -->
	    	
	    	<div class="col-md-4">
	    		<img class="img-responsive" src="uploads/images/enfermeria.jpg">
	    		<div>
	    			<h2 class="info-enfermeria"><span class="icon-info icon-info-1"></span>
	    				Información General
	    			</h2>

	    			<ul>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-2"></span>
	    					<strong>Requisitos de inscripción:</strong><br>
	    					DNI Original y copia<br>
	    					Recibo de sueldo<br>
	    					Carnet sindical
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-6"></span>
	    					Horarios de Atencion:<br>
	    					10 a 18hs.
	    				</li>
	    			</ul>
	    		</div>
				<div class="info-inscripciones">
	    			<h2>
	    				Inscripciones
	    			</h2>

	    			<p>
	    				Saavedra 166. ATSA,<br> Secretaría de Cultura, PB.<br>
	    				Horario de Atención: 10 a 18 horas
	    			</p>
	    		</div>
	    	</div><!-- //.col-md-6 -->
	    </div><!-- //.row -->
	</div><!-- //.container -->
</article>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-cursos-no-formales" ).accordion();
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