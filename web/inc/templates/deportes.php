<?php 
//1. busca las variables basado en el url: (la pageactual es deportes, las variables son contenido y deporte, el contenido sería liga, proxima fecha, etc)
$variablesPaginaDeportes = getVariablesDeportes();
$deporte = $variablesPaginaDeportes['deporte'];
$contenido = $variablesPaginaDeportes['contenido'];

$menuDeportes = array(
	array('href'=> 'liga', 'name' => 'Liga/resultados'),
	array('href'=> 'proxima-fecha', 'name' => 'Próxima fecha'),
	array('href'=> 'posiciones', 'name' => 'Posiciones'),
	array('href'=> 'equipos', 'name' => 'Equipos'),
);

$submenu = array(
	array('slug'=> 'futbol-11', 'name'=> 'Fútbol 11'),
	array('slug'=> 'futbol-5-libre-liguilla', 'name'=> 'Fútbol 5 Libre y Liguilla'),
	array('slug'=> 'futbol-5-veteranos', 'name'=> 'Fútbol 5 Veterano'),
	array('slug'=> 'futbol-5-femenino', 'name'=> 'Fútbol 5 Femenino'),
	array('slug'=> 'voley-femenino', 'name'=> 'Voley Femenino'),
);

?>
<article id="deportes" class="wrapper-page wrapper-page-deportes">
    <header class="header-deportes">
        <nav class="header-menu-deportes">
            
            <?php 
            foreach ($submenu as $item) {
                if ( $item['slug'] == $variablesPaginaDeportes['deporte'] ) {
                    echo '<span data-slug="'.$item['slug'].'" class="nav-title">'.$item['name'].'</span>';
                    break;
                }
            } ?>
            <a class="nav-volver" href="<?php echo urlBase(); ?>/torneos-y-eventos">
                volver
            </a>

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
    <section class="deportes-main-wrapper">
        <div class="container-fluid">
            <div class="loader-ajax">
                <img src="assets/images/loader.gif">
            </div>
            <div id="contenedorAjax"></div>
        </div>
    </section>

    <footer class="footer-deportes">
        <div class="container-fluid">
            <div class="otros-nav-footer">
                <h2>
                    Otros:
                </h2>

                <a href="<?php echo urlBase(); ?>/torneos-y-eventos">
                    volver
                </a>
            </div>
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
    </footer>
</article>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(window).on('load', function () {		
		$( "#footer-menu-deportes" ).accordion({
    		collapsible: true,
    		active : false,
    		heightStyle: "content"
    	});
        
        getContent(<?php echo '"' .$contenido .'", "'. $deporte . '"'; ?>);
    	
    });//ready
</script>