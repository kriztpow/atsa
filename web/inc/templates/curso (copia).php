<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * CURSOS.PHP
 * Pagina que muestra los cursos
*/
require_once 'inc/config.php';
require_once 'inc/functions.php';
global $curso;
$cursoActual = $curso;

//datos por default;
$imgCurso = 'enfermeria.jpg';
$cursoTitulo = 'Titulo Curso';
$cursoMetodologia = 'No hay data para mostrar';
$cursoObjGeneral = '<p>Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.</p>';
$cursoObjEspecifico = 'No hay data para mostrar';
$cursoRequisitos = '<p>Original y fotocopia de:<br>DNI<br>Último recibo de suelo<br>Carnet sindical<br>Titulo técnico o profesional</p>';
$cursoCertificado = 'Certificado Oficial';
$cursoCursada = 'Cursada 4 meses<br>1 vez por semana';
$cursoLugar = 'Centro y Lugar donde se cursa<br>Alberti 191 - C.A.B.A';
$cursoHorarios = 'Horarios de cursada<br>&nbsp;';
$cursoDestinatarios = 'none';
$noCurso = false;

//depende el curso se modifican las variables por default
switch ( $cursoActual ) {
	//curso 1
	case 'asistencia-respiratoria-mecanica':

		$cursoTitulo = 'Asistencia Respiratoria Mecánica';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual multimedia, prácticas de gabinete, debates y trabajos prácticos.';
		$cursoObjGeneral = '<p>Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.</p>';
		$cursoObjEspecifico = '<p>Que el alumno sea capaz de: Reconocer los  comandos principales comunes a todos los respiradores y realizar programación básica: modalidad, frecuencia, volumen, fio2, peep, alarmas.</p><p>Realizar la técnica de armado del  circuito de respirador aplicando criterios científicos e infectológicos.</p><p>Nombrar  aspectos clínicos, gasométricos y ventilatorios que indiquen ARM, planificar  cuidados de enfermería en el paciente con ARM y desarrollar acciones para las siguientes situaciones problemas: aumento de la presión en la vía aérea, autopeep, alarma de fuga o apnea, hipoventilación.</p>';
		$imgCurso = 'asistencia-respiratoria-mecanica.png';
		break;
	//curso 2
	case 'arritmias-cardiacas':
		$cursoTitulo = 'Arritmias Cardíacas';
		$cursoObjGeneral = 'Que los alumnos adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la detección e identificación de los diferentes ritmos cardiacos.';
		$cursoObjEspecifico = '<p>Que el alumno sea capaz de:</p><ul><li>Mencionar los mecanismos arritmogénicos que originan los diferentes ritmos cardiacos</li><li>Identificar en un monitoreo simulado las arritmias cardiacas más frecuentes que se presentan en el paciente internado en cuidados críticos</li><li>Aplicar el análisis metódico propuesto en el curso a cada ritmo cardiaco.</li><li>Establecer el grado de descompensación de cada arritmia cardiaca y agruparlos en arritmias menores, mayores y mortales.</li><li>Establecer una secuencia de valoración de enfermería en función del tipo de arritmia presente en un paciente</li><li>Mencionar intervenciones de enfermería orientadas al paciente que presenta alteración del ritmo cardiaco.</li><li>Fundamentar la importancia del monitoreo cardíaco en función de la detección precoz de las arritmias cardiacas y el tratamiento inmediato con el objetivo de disminuir la mortalidad.</li></ul>';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual multimedia, prácticas de gabinete, debates y trabajos prácticos.';
		$imgCurso = 'arritmias-cardiacas.png';
		break;
	//curso 3
	case 'educacion-para-enfermeria':
		$cursoTitulo = 'Educación para Enfermería';
		$cursoObjEspecifico = '<p>Que el destinatario sea capaz de:</p><ul></li>Reflexionar acerca de la función educadora cotidiana del técnico-profesional.</li><li>Comprender las características de la Metacomunicación en la tarea educativa</li><li>Apreciar el valor de las diferentes pedagogías utilizadas en función de la enseñanza en servicio.</li><li>Adquirir herramientas que le permitan realizar la selección de contenidos en función del destinatario.</li><li>Diseñar un proyecto educativo aplicable en los usuarios que cuida a diario, utilizando las herramientas adquiridas</li></ul>';
		$cursoMetodologia = 'Clases prácticas con lectura y análisis crítico de textos, debate, estudio de casos, interpretación de roles y taller.';
		$imgCurso = 'educacion-enfermeria.png';
		break;
	//curso 4
	case 'control-de-infecciones':
		$cursoTitulo = 'Control de Infecciones';
		$cursoObjGeneral = 'Que los alumnos adquieran los conocimientos básicos de la especialidad y desarrollen habilidades técnicas y destrezas propias para desempeñarse como (auxiliar/asistente/ técnico) de un Enfermero en Control de Infecciones.';
		$cursoObjEspecifico = '<p>Que el alumno sea capaz de:</p><ul><li>Describir las definiciones de infecciones asociadas al cuidado de la salud (IACS) del Programa de Vigilancia de Infecciones Hospitalarias de Argentina (VIHDA), del Centers for Disease Control and Prevention (CDC) y National Healthcare Safety Network (NHSN).</li><li>Registrar denominadores y episodios infecciosos en forma manual y en Excel (PC)</li><li>Construir tasas de utilización y de infección asociadas a procedimientos invasivos y de sitio quirúrgico.</li><li>Medir la adherencia a las medidas de prevención de: Bacteriemias asociadas a catéter venoso central, Infecciones urinarias asociadas a sonda vesical, Neumonías asociadas a Asistencia Respiratoria Mecánica e Infecciones del Sitio Quirúrgico.</li><li>Conocer los mecanismos de resistencia microbiana e identificar los gérmenes multiresistentes más comunes.</li><li>Realizar relevamientos y actualización de los pacientes en aislamiento.</li><li>Medir la adherencia al uso de los Elementos de Protección Personal (EPP).</li><li>Explicar los distintos procedimientos de la Higiene Hospitalaria.</li><li>Controlar y medir el cumplimiento de la Higiene Hospitalaria.</li><li>Realizar Prevalencias y relevamientos de áreas.</li><li>Identificar los diferentes tipos de Residuos de Establecimientos de Salud (RES).</li><li>Controlar la segregación adecuada de los RES.</li><li>Identificar las medidas de prevención de los accidentes por punción.</li><li>Medir el cumplimiento de la Higiene de Manos en el personal de salud.</li></ul>';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual  y prácticas en una Institución de Salud donde desarrollarán las habilidades y destrezas correspondientes.';
		$imgCurso = 'control-infecciones.png';
		break;
	//curso 5
	case 'cuidados-cardiologicos':
		$cursoTitulo = 'Cuidados cardiológicos';
		$cursoObjEspecifico = '<p>Que el alumno sea capaz de:</p><ul><li>Mencionar los mecanismos que rigen el funcionamiento cardíaco</li><li>Identificar las patologías cardíacas prevalentes</li><li>Aplicar el proceso de atención de enfermería a pacientes con necesidades cardiológicas insatisfechas</li><li>Establecer el grado de gravedad que revisten algunas patologías cardíacas</li><li>Mencionar intervenciones de enfermería orientadas al paciente que presenta alteración cardíaca</li><li>Fundamentar la importancia del monitoreo cardíaco en función de la detección precoz de problemas cardiacos y el tratamiento inmediato con el objetivo de disminuir la mortalidad</li></ul>';
		$cursoMetodologia = 'Clases Expositivas  teóricas y prácticas con participación activa del alumno.';
		$imgCurso = 'cuidados-cardiologicos.png';
		break;
	//curso 6
	case 'coaching-para-enfermeras':
		$cursoTitulo = 'Coaching para enfermeras';
		$cursoMetodologia = '<p>A los efectos de potenciar el proceso de aprendizaje e incorporación de las nuevas formas conversacionales, este entrenamiento cuenta con <strong>tres procesos didácticos</strong> principales: un <strong>juego de simulación</strong> que servirá para practicar las herramientas del curso, una metodología de <strong>coaching individual</strong> en la que se asistirá al participante en su plan de mejora o transformación de algún aspecto por medio de fábulas, en ellas el participante ampliará su auto-conocimiento y por tanto su posibilidad de cambio y las transferencias semanales cada clase le planteará al participante una serie de ejercicios para llevar lo aprendido a su cotidianidad.</p>';
		$cursoObjEspecifico = '<p>Que el aprendiz sea capaz de desarrollar  habilidades que le permitan:</p><ul><li>Tener una observación más amplia de la realidad.</li><li>Lograr resultados que hasta ahora no ha podido lograr.</li><li>Relacionarse con las personas que le rodean de una manera más sana y armoniosa.</li><li>Tener un accionar más efectivo.</li><li>Ser más creativo.</li><li>Incorporar destrezas de Inteligencia Emocional</li><li>Descubrir y destrabar creencias limitantes.</li><li>Manejar de una manera más saludable el stress</li></ul>';
		$imgCurso = 'coaching-enfermeras.png';
		
		break;
	//curso 7
	case 'electrocardiografia':
		$cursoTitulo = 'Electrocardiografia';
		$cursoObjEspecifico = '<p>Que el estudiante logre:</p><ul><li>Mencionar los mecanismos que originan los diferentes ritmos cardiacos</li><li>Identificar en un monitoreo simulado las variaciones en el electrocardiograma normal.</li><li>Aplicar el análisis metódico propuesto en el curso a cada ritmo cardiaco.</li><li>Establecer el grado de descompensación de cada arritmia cardiaca y agruparlos en arritmias menores, mayores y mortales.</li><li>Establecer una secuencia de valoración de enfermería en función del tipo de arritmia presente en un paciente</li><li>Mencionar intervenciones de enfermería orientadas al paciente que presenta alteración del ritmo cardiaco.</li><li>Fundamentar la importancia del monitoreo cardíaco en función de la detección precoz de las arritmias cardiacas y el tratamiento inmediato con el objetivo de disminuir la mortalidad.</li></ul>';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual  y prácticas.';
		$imgCurso = 'electrocardiografia.png';
		break;
	//curso 8
	case 'computacion-para-enfermeria':
		$cursoTitulo = 'Computación para enfermería';
		$cursoObjEspecifico = '<p>Finalizada la cursada del taller, el estudiante será capaz de:</p><ul><li>Organizar programas y archivos en su PC.</li><li>Interactuar en la red de Internet, seleccionando información profesional.</li><li>Confeccionar documentos con el Procesador de Textos cuya apariencia sea profesional</li><li>Diseñar planillas de cálculo inteligentes orientadas a la Estadística</li><li>Confeccionar una presentación audiovisual integrando técnicas multimediales</li></ul>';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual y prácticas en la PC.';
		$imgCurso = 'computacion-enfermeras.png';
		break;
	//curso 9
	case 'uti-basico':
		$cursoTitulo = 'UTI (nivel básico)';
		$cursoObjEspecifico = '<p>Que el alumno sea capaz de:</p><ul><li>Describir la anatomofisiología de las afecciones más frecuentes  que generen interacción en áreas críticas.</li><li>Planificar y fundamentar acciones de enfermería a  en las enfermedades prevalentes en cuidados intensivos</li><li>Describir y realizar la técnica de RCP básica.</li><li>Mencionar signos y síntomas que indiquen alteración aguda respiratoria, cardiológica o neurológica</li><li>Realizar lectura e interpretación de gasometría arterial</li><li>Proporcionar ventilación pulmonar adecuada con bolsa resucitadora (ambu)</li><li>Identificar mediante auscultación los ruidos respiratorios.</li><li>Identificar a través de monitor cardiaco las arritmias mortales.</li><li>Describir un entorno humanizado óptimo en las áreas de cuidados intensivos</li></ul>';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual, prácticas de gabinete, debates y trabajos prácticos.';
		$imgCurso = 'uti-basico.png';
		break;
	//curso 10
	case 'uti-avanzado':
		$cursoTitulo = 'UTI (nivel avanzado)';
		$cursoObjEspecifico = '<p>Que el alumno sea capaz de:</p><ul><li>Describir los procesos anatomofisiológicos que intervienen en la electrofisiología cardiaca, respiratoria normal y regulación hemodinámica y neurológica.</li><li>Exponer los  aspectos fisiológicos que fundamentan el funcionamiento del balón de contrapulsación.</li><li>Nombrar e identificar en un respirador los comandos comunes.</li><li>Describir el seteo inicial de un respirador</li><li>Nombrar los elementos necesarios para la medición de parámetros hemodinámicos a través de  catéter de Swan Ganz.</li><li>Relacionar perfiles hemodinámicos con procesos patológicos.</li><li>Identificar a través de monitor cardiaco las arritmias mortales.</li><li>Establecer diferencias entre cardioversión y desfibrilación.</li><li>Describir la técnica de choque eléctrico.</li><li>Mencionar intervenciones de enfermería en la administración de fármacos de uso frecuente en las Unidades de cuidados intensivos</li></ul>';
		$cursoMetodologia = 'Presencial. Clases teóricas expositivas con material audiovisual, prácticas de gabinete y trabajos prácticos.';
		$imgCurso = 'uti-avanzado.png';
		break;
	//curso 11
	case 'endoscopia-digestiva':
		$cursoTitulo = 'Endoscopía digestiva';
		$cursoObjGeneral = '<p>Formar profesionales capacitados en los conocimientos y responsabilidades para responder a  la exigencia actual de la endoscopia. </p><p>Crear equipos de trabajos interdisciplinarios para llevar a cabo la actividad.</p><p>Fomentar la excelencia de los servicios de Enfermería en endoscopia.</p>';
		$cursoObjEspecifico = '<ul><li>Enseñanza de la anatomía del aparato digestivo (esófago, estómago, intestino delgado, colon, páncreas e hígado)</li><li>Descripción, discusión de las indicaciones, contraindicaciones y consideraciones de enfermería relacionadas con la endoscopia digestiva alta, baja y colangiografia retrograda.</li><li>Enseñanza de la composición de los diversos endoscopios, de las técnicas de reprocesamiento de los equipos y accesorios, control y prevención de las infecciones.</li><li>Enseñanza de la composición de los distintos endoscopios, con sus diversas técnicas de mantenimiento y prevención.</li><li>Generar herramientas para la educación al paciente y familia sobre su proceso de salud y enfermedad.</li><li>Promover la unificación de registros y documentación cumplimentando la legislación actual.</li></ul>';
		$cursoMetodologia = 'Consta de una instancia áulica y prácticas en laboratorio.';
		$imgCurso = 'endoscopia-dijestiva.png';
		break;
	//curso 12
	case 'colangiopancreatografia':
		$cursoTitulo = 'Colangiopancreatografia';
		$cursoObjGeneral = '<p>Formar profesionales capacitados en los conocimientos y responsabilidades para responder a  la exigencia actual de la endoscopia. Crear equipos de trabajos interdisciplinarios para llevar a cabo la actividad. Fomentar la excelencia de los servicios de Enfermería en endoscopia.</p>';
		$cursoObjEspecifico = '<ul><li>Enseñanza de la anatomía del aparato digestivo (esófago, estómago, intestino delgado, colon, páncreas e hígado)</li><li>Descripción, discusión de las indicaciones, contraindicaciones y consideraciones de enfermería relacionadas con la endoscopia digestiva alta, baja y colangiografía retrograda.</li><li>Enseñanza de la composición de los diversos endoscopios, de las técnicas de reprocesamiento de los equipos y accesorios, control y prevención de las infecciones.</li><li>Enseñanza de la composición de los distintos endoscopios, con sus diversas técnicas de mantenimiento y prevención.</li><li>Generar herramientas para la educación al paciente y familia sobre su proceso de salud y enfermedad.Promover la unificación de registros y documentación cumplimentando la legislación actual</li></ul>';
		$cursoMetodologia = 'Consta de una instancia áulica y prácticas en laboratorio.';
		$imgCurso = 'colangiopancreatografia.png';
		break;

	//curso 13
	case 'enfermeria-en-cuidados-cardiologicos-avanzados':
		$cursoTitulo = 'Enfermería en cuidados cardiológicos avanzados';
		$cursoObjGeneral = '<p>Que los alumnos adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente con patología cardiovascular en estado crítico.</p>';
		$cursoObjEspecifico = '<p>Que el alumno sea capaz de:</p><ul><li>Describir la anatomofisiología del aparato cardiovascular y relacionarla con las patologías cardiovasculares</li><li>Mencionar e identificar  signos y síntomas que indiquen alteración cardiológica.</li><li>Mencionar el algoritmo de tratamiento del IAM, insuficiencia cardiaca y EAP</li><li>Aplicar la etapa de valoración del proceso de atención de enfermería (PAE) al paciente con patología cardiovascular</li><li>Describir las manifestaciones anterógradas y retrogradas de la falla cardiaca.</li><li>Interpretar las curvas enzimáticas en los síndromes isquémicos</li><li>Aplicar interpretación metódica en las arritmias mortales.</li><li>Programar el cardiodesfibrilador para realizar un choque eléctrico.</li><li>Interpretar y relacionar con cuadro clínicos diferentes perfiles hemodinámicos.</li><li>Interpretar las curvas del balón de contrapulsación.</li><li>Mencionar acción, preparación, administración y cuidados enfermeros en los principales fármacos usados en unidad coronaria</li><li>Describir un entorno humanizado en el desempeño del personal de enfermería en Unidad coronaria</li></ul>';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual  y prácticas.';
		$imgCurso = 'enfermeria-cuidados-cardiologicos-avanzados.png';
		break;

		//curso 14
	case 'enfermeria-situaciones-criticas':
		$cursoTitulo = 'Enfermeria en situaciones criticas';
		$cursoObjEspecifico = '<ul><li>Describir el algoritmo universal para RCP según normas internacionales 2010</li><li>Permeabilizar la vía aérea mediante dispositivo de cánula de Guedel</li><li>Ventilar con bolsa resucitadora según normas actuales.</li><li>Preparar el equipo para manejo avanzado de la vía aérea.</li><li>Realizar intubación orotraqueal en muñeco de simulación de baja dificultad.</li><li>Verificar la correcta colocación del tubo endotraqueal mediante auscultación pulmonar.</li><li>Sujetar en forma segura el tubo endotraqueal</li><li>Describir la secuencia de pasos para realizar un choque eléctrico.</li><li>Realizar choque eléctrico en muñeco de práctica según secuencia  mostrada.</li><li>Mencionar las drogas de primera línea que se usan en el paro cardiorrespiratorio y en el manejo de la vía aérea.</li><li>Mencionar presentación, efectos, dosis, vía de administración y cuidados de enfermería de los fármacos de primera línea.</li><li>Realizar la colocación de collar de estabilización cervical</li><li>Efectuar valoración inicial en el politraumatizado en fase intrahospitalaria</li><li>Realizar las maniobras de manejo inicial del politraumatizado en fase intrahospitalaria.</li><li>Describir un entorno humanizado en el desempeño del personal de enfermería en las situaciones críticas.</li></ul>';
		$cursoMetodologia = 'Simulaciones clínicas con maniquíes, método de casos y exposición dialogada. En cada encuentro se desarrollaran contenidos teóricos que fundamentarán las simulaciones y técnicas a desarrollar.';
		$imgCurso = 'rol-enfermeria-situaciones-criticas.png';
		break;

	//curso 15
	case 'densitometria-osea':
		$cursoTitulo = 'Densitometria osea';
		$cursoObjGeneral = '<p>Que los alumnos adquieran los conocimientos técnicos teórico-prácticos para poder   llevar adelante un Servicio de Densitometría Ósea realizando estudios de calidad.</p>';
		$cursoObjEspecifico = '<ul><li>Que los alumnos conozcan conceptos clínicos de calidad ósea.</li><li>Que conozcan la evolución de los equipos, sus fundamentos físicos, los funcionamientos básicos y las diferencias entre las diferentes marcas de Densitómetros.</li><li>Ofrecerles la capacitación teórico-técnica para operar equipos de Densitometría Ósea brindando los conocimientos apropiados para que el profesional obtenga imágenes correctas para un diagnóstico certero.</li><li>Que el alumno sea capaz de realizar, analizar, comparar y entender la interpretación clínica un estudio de Densitometría Ósea.</li><li>Ofrecerle al alumno conocimientos para un correcto control de calidad de equipos y técnicos de Densitometría Ósea.</li><li>Que el alumno adquiera las habilidades para el cuidado de los pacientes de un Servicio de Densitometría Ósea.</li></ul>';
		$cursoMetodologia = 'Clases teóricas expositivas con material audiovisual  y prácticas en instituciones de salud.';
		$cursoDestinatarios = 'Únicamente Técnicos Radiólogos y Licenciados en Producción de Bioimágenes con título habilitante';
		$imgCurso = 'densitometria-osea.png';
		break;

	default:
		die('<script>window.location.href="index.php?page=404";</script>');
		break;
}

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