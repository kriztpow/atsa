<article id="torneos-y-eventos" class="wrapper-home">
	<header class="header-hoteles">
        <?php
            getSliders( 'deportes' );
        ?>
    </header>
	<section class="torneos-y-eventos">
	<div class="container-fluid">
	    <h1 class="tittle-deportes">Torneos 2018</h1>

	    <p class="paragraph-deportes">
	    	Desde ATSA Bs As llevamos adelante torneos de fútbol y vóley donde participan nuestros compañeros y compañeras. Tenemos Torneo de fútbol 5 y 11 1ºA y B masculino, fútbol 5 vitalicios, fútbol 11 y vóley femenino. Además, contamos con nuestras propias Selecciones de fútbol y vóley, quienes nos representan en los Encuentros entre Filiales.<br>
	    	¡Conocé a nuestros equipos ATSA Bs As!
	    </p>
	    <div id="accordion-deportes">
	    <?php showLinksDeportes(); ?>
	   	
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