<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * viajes template
 * Template que muestra los viajes
*/
searchViajesData();
global $dataViajes;

?>

<article id="viajes" class="wrapper-home">
	<header class="header-hoteles">
        <?php
            getSliders( 'viajes' );
        ?>
    </header>
    <section class="viajes">
		<div class="container">
			<div class="title-deco-guion">
			    <h1 class="text-uppercase">
			    	Viajes
			    </h1>
		    </div>
		    <p class="p-text-center font-size-14">
		    	<?php echo $dataViajes['texto_superior']; ?>
		    </p>

		    <div class="alert-viaje-norte">
		    	<h2><?php echo $dataViajes['titulo_promocion']; ?></h2>

		    	<?php echo $dataViajes['texto_principal']; ?>
		    </div>

		    <div class="alert-info-viajes">
		    	<h2>¿Querés saber más?</h2>
		    	<p><?php echo $dataViajes['texto_contacto']; ?></p>
		    </div>
		</div>
	</section>
</article>