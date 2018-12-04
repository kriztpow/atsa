<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * Modificado 8.4
 * viajes template
 * Template que muestra los viajes
*/


$pagina = getPageData(5);
$titulo = $pagina['page_titulo'];
$texto = $pagina['page_text'];
$extra = $pagina['page_extra'];

if ( $pagina['page_extra'] == '') {
    $extra = 'Comunicate con la Secretaría de Deporte y Turismo';
}
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
			    	<?php echo $titulo; ?>
			    </h1>
		    </div>
		    <p class="p-text-center font-size-14">
				<?php echo $texto; ?>
		    </p>

			<div class="wrapper-viajes">
			<?php 
			$viajes = showViajesCargados();

			if ($viajes != null ) : 

				foreach ($viajes as $viaje) { ?>
					
					<div class="alert-viaje-norte">
						<h2>
							<?php echo $viaje['titulo']; ?>
						</h2>

						<?php echo $viaje['texto']; ?>

						<img class="img-responsive" src="<?php echo urlBase() . '/uploads/images/' . $viaje['imagen']; ?>">
					</div>
				<?php }
			endif;
			?>

			</div>

		</div>

		<div class="wrapper-info-viajes">
			<div class="container">
				<div class="alert-info-viajes">
					<h2>¿Querés saber más?</h2>
					<p>
						<?php echo $extra; ?>
					</p>
				</div>
			</div>
		</div>
		
	</section>
</article>
