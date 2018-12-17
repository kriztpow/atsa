<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de liga
*/
$submenu = array(
	array('slug'=> 'futbol-11', 'name'=> 'Fútbol 11'),
	array('slug'=> 'futbol-5-libre-liguilla', 'name'=> 'Fútbol 5 Libre y Liguilla'),
	array('slug'=> 'futbol-5-veteranos', 'name'=> 'Fútbol 5 Veterano'),
	array('slug'=> 'futbol-5-femenino', 'name'=> 'Fútbol 5 Femenino'),
	array('slug'=> 'voley-femenino', 'name'=> 'Voley Femenino'),
);
$zonas = array(
    array('slug'=> 'zona-a', 'name'=> 'Zona A'),
    array('slug'=> 'zona-b', 'name'=> 'Zona B'),
);
?>
<div class="deportes-inner-wrapper">
    <div class="header-contenido header-flex">
        <h1 class="title-content">
            Liga<span id="nameZona"></span>
        </h1>

        <select id="fechaajax" name="fechaajax" data-contenido="liga" data-deporte="<?php echo $submenu[0]['slug']; ?>" class="selector-zona">
            <option value="ultimos">Última Fecha</option>
            <option value="mes">Últimas 4 fechas</option>
            <option value="trimestre">Últimas trimestre</option>
            <option value="semestre">Últimas semestre</option>
            <option value="todos">Todos los resultados</option>
        </select>

        <select id="zonadeportesajax" name="zonadeportesajax" data-contenido="liga" data-deporte="<?php echo $submenu[0]['slug']; ?>" class="selector-zona">
            <option>Todas las zonas</option>
            <?php 
            foreach ($zonas as $zona) {
                echo '<option value="'.$zona['slug'].'">'.$zona['name'].'</option>';
            } ?>
        </select>

        <select id="submenudeportesajax" name="submenudeportesajax" data-contenido="liga" class="selector-zona">
            <?php 
            foreach ($submenu as $item) {
                echo '<option value="'.$item['slug'].'">'.$item['name'].'</option>';
            } ?>
        </select>

    </div><!--//.header-contenido-->

    <div id="minicontenedorAjax" class="wrapper-contenido">
        
        <?php 
        foreach ($data as $zona ) { ?>

            <div class="wrapper-zona">
                <h3 class="titulo-zona">
                    <?php echo $zona['name']; ?>
                </h3>
                <div class="wrapper-externo-partido">
                    <ul class="lista-partidos">
                            <?php 
                            foreach ($zona['partidos'] as $partido) {
                                echo '<li>';
                                getTemplate('partido', $partido );
                                echo '</li>';
                            }
                            ?>
                    </ul>
                </div>
            </div>
        
        <?php
        }//foreach zonas
        ?>
    </div>

</div><!--//.deportes-inner-wrapper-->