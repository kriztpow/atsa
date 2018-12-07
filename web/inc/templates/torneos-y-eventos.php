<?php 
$pagina = getPageData(7);
$titulo = $pagina['page_titulo'];
$texto = $pagina['page_text'];

$menuDeportes = array(
	array('href'=> 'liga', 'name' => 'Liga/resultados'),
	array('href'=> 'liga', 'name' => 'Próxima fecha'),
	array('href'=> 'liga', 'name' => 'Posiciones'),
	array('href'=> 'liga', 'name' => 'Equipos'),
);

$submenu = array(
	array('slug'=> 'futbol-11', 'name'=> 'Fútbol 11'),
	array('slug'=> 'futbol-5-libre-liguilla', 'name'=> 'Fútbol 5 Libre y Liguilla'),
	array('slug'=> 'futbol-5-veteranos', 'name'=> 'Fútbol 5 Veterano'),
	array('slug'=> 'futbol-5-femenino', 'name'=> 'Fútbol 5 Femenino'),
	array('slug'=> 'voley-femenino', 'name'=> 'Voley Femenino'),
);

?>
<article id="torneos-y-eventos" class="wrapper-home">
	<header class="header-hoteles">

        <?php
			$sliders = getSlidersData( 'deportes' );
			
			if ($sliders != null) {
				getTemplate( 'sliders', $sliders);
			} else {
				if ( $pagina['page_imagen'] != '') {
					echo '<img src="' . urlBase() . '/uploads/images/' . $pagina['page_imagen'] . '" class="img-responsive">'; 
				}
			}
        ?>
			
		<nav class="header-menu-deportes">
			<div class="container-fluid">
				<ul class="menu-items-deportes">
					<?php foreach ($menuDeportes as $menu) { ?>
						<li class="menu-item">
							<?php echo $menu['name']; ?>
							<ul class="submenu">
								<?php foreach ($submenu as $submenuItem ) { ?>
									<li class="submenu-item">
										<a href="<?php echo urlBase() . '/deportes/' . $menu['href'] . '/' . $submenuItem['slug']; ?>" title="<?php echo $menu['name'] . ' - ' . $submenuItem['name']; ?>">
											<?php echo $submenuItem['name']; ?>
										</a>
									</li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</div>
		</nav>
    </header>
	<section class="torneos-y-eventos">
	<div class="container-fluid">
	    <h1 class="tittle-deportes tittle-new-deportes">
			<?php echo $titulo; ?>
		</h1>

	    <div class="paragraph-deportes">
			<?php echo $texto; ?>
	    </div>
	    <div id="accordion-deportes">
	    <?php showLinksDeportes(); ?>
	   	
		</div><!-- //#acorddion -->
									
		
		<nav id="footer-menu-deportes" class="footer-menu-deportes">
			
			
			<?php foreach ($menuDeportes as $menu) { ?>
				<h3 class="menu-item">
					<?php echo $menu['name']; ?>
				</h3>
				<div class="submenu-acordion">
					<?php foreach ($submenu as $submenuItem ) { ?>
						<a href="<?php echo urlBase() . '/deportes/' . $menu['href'] . '/' . $submenuItem['slug']; ?>" title="<?php echo $menu['name'] . ' - ' . $submenuItem['name']; ?>">
							<?php echo $submenuItem['name']; ?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
			
			
		</nav>
		
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
		
		$( "#footer-menu-deportes" ).accordion({
    		collapsible: true,
    		active : false,
    		heightStyle: "content"
    	}
    	);
    });//ready
</script>