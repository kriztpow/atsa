<article id="trabajadores" class="class="wrapper-home">
<header class="header-home">
        <?php
            getSliders( 'trabajadores' );
        ?>
    </header>
    <section class="mini-padding-section">
		<div class="container">
			<h1 class="sr-only">Trabajadores</h1>

		    <p class="p-text-center font-size-14 weight-medium">
		    	Este espacio está dirigido a todos nuestros compañeros y compañeras con el objetivo de reflexionar sobre los roles de género en nuestra sociedad, desnaturalizar las características culturales que los determinan y los papeles que se le atribuyen a cada uno, especialmente dentro del ámbito laboral.<br>
		    	A tal fin, nos proponemos introducir la Perspectiva de Género e incorporar la igualdad de trato y de oportunidades entre hombres y mujeres en la discusión de condiciones de trabajo.
		    </p>
		</div>
	</section>
	<section class="background-gris mini-padding-section">
		<div class="container">
			<div class="title-sin-guion">
			    <h2 class="font-size-18">
					La Secretaría de la Mujer de ATSA Bs As centraliza las inquietudes de nuestr@s trabajador@s
				</h2>
		    </div>

			<ul>
				<li class="inquietudes-sec-mujer">
					Desarrollo y promoción de tareas preventivas mediante campañas de sensibilización, talleres, charlas-debate y difusión de los derechos de l@s trabajador@s a través de materiales gráficos.
				</li>
				<li class="inquietudes-sec-mujer">
					Recopilación y sistematización de bibliografía referida a temas relacionados con problemáticas de género para el uso libre y gratuito de nuestros compañer@s.
				</li>
				<li class="inquietudes-sec-mujer">
					Coordinación y desarrollo de charlas informativas en establecimientos con el objetivo de reflexionar sobre cómo la perspectiva de género atraviesa y re significa nuestro accionar cotidiano.
				</li>
				<li class="inquietudes-sec-mujer">
					Atención de consultas y/o recepción de denuncias sobre violencia laboral.
				</li>
				<li class="inquietudes-sec-mujer">
					Asesoramiento sobre cómo actuar ante situaciones de violencia laboral, brindando apoyo y contención a los compañer@s y actuando directamente con la empresa para mediar dicha problemática.
				</li>
				<li class="inquietudes-sec-mujer">
					Trabajo en red y en alianza con otras instituciones y organizaciones gremiales en función de fortalecer los vínculos de cooperación y asistencia con áreas del Ministerio de Trabajo y otros organismos públicos y privados, nacionales e internacionales.
				</li>
			</ul>
		</div>
	</section>

    <div class="container">
		<div class="title-sin-guion">
		    <h2 class="font-size-18 margin-top-min">
		    	Participación gremial en cuestiones de Género nuestr@s trabajador@s
		    </h2>
	    </div>

		<div id="trabajadores-tabs">
			<ul class="tabs-20">
				<li>
					<a class="urltochange" href="#2014">
						2014
					</a>
				</li>
			    <li>
			    	<a class="urltochange" href="#2015">
			    		2015
			    	</a>
			    </li>
			    <li>
			    	<a class="urltochange" href="#2016">
			    		2016
			    	</a>
			    </li>
			    <li>
			    	<a class="urltochange" href="#docs-interes">
			    		Documentos de interes
			    	</a>
			    </li>
			</ul>
			<div id="2014" class="tabs-content-trabajadores tabs-70">
				<ul>
					<li>- Encuentro de Mujeres ATSA. 
						<a href="uploads/pdfs/encuentro-mujeres-atsa-2014.pdf" target="_blank">Click aquí</a>
					</li>
					<li>- Ley voto femenino: película” Las Muchachas”. 
						<a href="uploads/pdfs/las-muchachas-2014.pdf" target="_blank">Click aquí</a>
					</li>
					<li>- Marcha del orgullo gay “Compromiso Intersindical por la diversidad sexual”.
					</li>
					<li>- 1er seminario Intersindical por la diversidad sexual en Suterh.
					</li>
				</ul>
		  	</div>
		  	<div id="2015" class="tabs-content-trabajadores tabs-70">
		    	<ul>
					<li>
						- Casa de Bernarda Alba
					</li>
					<li>
						- Día Internacional de la Mujer: película Norma Rae
					</li>
					<li>
						- 1era Marcha Ni una Menos 
					</li>
					<li>
						- Encuentro Nacional Mujeres, Mar del Plata
					</li>
				</ul>
		  	</div>
		  	<div id="2016" class="tabs-content-trabajadores tabs-70">
		    	<ul>
					<li>
						- Día Internacional de la Mujer: película “Tierra Fría”
					</li>
					<li>
						- Fulgor Argentino
					</li>
					<li>
						- Violencia laboral: “Por un trato digno en el ámbito laboral” folletos
					</li>
					<li>
						- 2da marcha Ni una Menos
					</li>
					<li>
						- Derechos vs. Violencia: Secretaria de Igualdad de oportunidades y Genero. C.G.T.
					</li>
				</ul>
		  	</div>
		  	<div id="docs-interes" class="tabs-content-trabajadores tabs-70">
		  		<ul>
					<li>- Direcciones y Teléfonos de las Comisaría de la Mujer en la Provincia de Buenos Aires <a href="uploads/pdfs/dir-y-tel-de-las-comisarias-de-la-mujer-bsas.pdf" target="_blank">Click aquí</a>
					</li>
					<li>- Campaña de sensibilización contra la violencia hacia la mujer
					</li>
					<li>- Campaña de concientización sobre Violencia Laboral <a href="uploads/pdfs/triptico-campana-violencia-laboral.pdf" target="_blank">Click aquí</a>
					</li>
					<li>- Información sobre Violencia de género <a href="uploads/pdfs/70-violencia.pdf" target="_blank">Click aquí</a>
					</li>
				</ul>
		  	</div>
		</div>
	</div>
</article>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	//arregla los url para que funcionen las tabs
        var base = window.location.href
        $('.urltochange').each( function (){
            var baseurl = this.href;
            var url = this.href.split("#")[1];
            var newURL = base + '#' + url;
            $(this).attr('href',newURL);
        });
    	$( "#trabajadores-tabs" ).tabs({active : 0}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
    	$( "#trabajadores-tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    });//ready
	
</script>