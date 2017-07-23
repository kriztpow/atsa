<article id="torneos-y-eventos" class="wrapper-home">
	<header class="header-hoteles">
        <?php
            getTemplate( 'slider-deportes' );
        ?>
    </header>
	<section class="torneos-y-eventos">
	<div class="container-fluid">
	    <h1 class="tittle-deportes">Torneos 2017</h1>

	    <p class="paragraph-deportes">
	    	Desde ATSA Bs As llevamos adelante torneos de fútbol y vóley donde participan nuestros compañeros y compañeras. Tenemos Torneo de fútbol 5 y 11 1ºA y B masculino, fútbol 5 vitalicios, fútbol 11 y vóley femenino. Además, contamos con nuestras propias Selecciones de fútbol y vóley, quienes nos representan en los Encuentros entre Filiales.<br>
	    	¡Conocé a nuestros equipos ATSA Bs As!
	    </p>
	    <div id="accordion-deportes">

	   	<!-- item tab -->
	   		<h3>
		  		<span class="text-title-accordion">
			  		Calendario con fechas de torneos/amistosos/eventos
			  	</span>
			  <span class="icon-suma"></span>
			</h3>
		  	<div class="contenido-accordion-deportes">
		  		<ul>
		  			<li>
		  				<a href="uploads/pdfs/resultados-1era-fecha-2da-categoria-voley.pdf" target="_blank">
		  					1º Fecha Voley 2da categoria
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/resultados-1era-fecha-1era-categoria-voley.pdf" target="_blank">
		  					1º Fecha Voley 1era categoria
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/6ta-fecha-futbol-11-a.pdf" target="_blank">
		  					6º Fecha Fútbol 11 (A)
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/5ta-fecha-futbol-11-a.pdf" target="_blank">
		  					5º Fecha Fútbol 11 (A)
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/4ta-fecha-futbol-11-b.pdf" target="_blank">
		  					4º Fecha Fútbol 11 (B)
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/5-fechaliguilla-clasificatoria-futbol-5.pdf" target="_blank">
		  					5º Fecha liguilla Fútbol 5
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/4ta-fecha-futbol-11.pdf" target="_blank">
		  					4º Fecha Fútbol 11 (A)
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/3-fecha-futbol-a.pdf" target="_blank">
		  					3º Fecha Fútbol 11 (A)
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/2-fecha-futbol-11-b.pdf" target="_blank">
		  					2º Fecha Fútbol 11 (B)
		  				</a>
		  			</li>
		  		</ul>
		  	</div>

		  	<!-- item tab -->
	   		<h3>
		  		<span class="text-title-accordion">
			  		Tablas de posiciones de torneo liguilla fútbol masculino 5, fútbol masculino 11 (A y B) y voley fem (A)
			  	</span>
			  <span class="icon-suma"></span>
			</h3>
		  	<div class="contenido-accordion-deportes">
		  		<ul>
		  			<li>
		  				<a href="uploads/pdfs/tabla-posiciones-futbol-5.pdf" target="_blank">
		  					Tabla de posiciones Fútbol 5
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/posiciones-futbol-a.pdf" target="_blank">
		  					Tabla de posiciones Fútbol 11 (A)
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/posiciones-futbol-b.pdf" target="_blank">
		  					Tabla de posiciones Fútbol 11 (B)
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/posiciones-voley.pdf" target="_blank">
		  					Tabla de posiciones Voley
		  				</a>
		  			</li>
		  			
		  		</ul>
		  	</div>

		  	<!-- item tab -->
	   		<h3>
		  		<span class="text-title-accordion">
			  		Tabla de goleadores de torneos
			  	</span>
			  <span class="icon-suma"></span>
			</h3>
		  	<div class="contenido-accordion-deportes">
		  		<ul>
		  			<li>
		  				<a href="uploads/pdfs/goleadores.pdf" target="_blank">
		  					Goleadores de Futbol 11 A
		  				</a>
		  			</li>
		  		</ul>
		  	</div>

		  	<!-- item tab -->
	   		<h3>
		  		<span class="text-title-accordion">
			  		Reglamento
			  	</span>
			  <span class="icon-suma"></span>
			</h3>
		  	<div class="contenido-accordion-deportes">
		  		<ul>
		  			<li>
		  				<a href="uploads/pdfs/reglamento-futbol-5.pdf" target="_blank">
		  					Reglamento Fútbol 5
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/reglamento-futbol-11.pdf" target="_blank">
		  					Reglamento Fútbol 11
		  				</a>
		  			</li>
		  			<li>
		  				<a href="uploads/pdfs/reglamento-voley-femenino.pdf" target="_blank">
		  					Reglamento Voley femenino
		  				</a>
		  			</li>
		  		</ul>
		  	</div>
		</div><!-- //#acorddion -->

    </div>
</article>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-deportes" ).accordion({
    		collapsible: true,
    		active : false,
    		heightStyle: "content"
    	}
    	);
    });//ready
	
</script>