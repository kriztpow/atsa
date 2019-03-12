<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de liga
*/
$submenu = getLigas();
$zonas = getZonas("liga_id='".$data[0]['liga']."'");

//var_dump($data);
?>
<div class="deportes-inner-wrapper">
    <div class="header-contenido header-flex">
        <h1 class="title-content">
            Liga<span id="nameZona"></span>
        </h1>

        <!--<select id="fechaajax" name="fechaajax" data-contenido="liga" data-deporte="<?php echo $data[0]['deporte']; ?>" data-liga="<?php echo $data[0]['liga']; ?>" class="selector-zona">
            <option value="todos">Todos los resultados</option>
            <option value="ultimos">Última Fecha</option>
            <option value="mes">Últimas 4 fechas</option>
            <option value="trimestre">Últimas trimestre</option>
            <option value="semestre">Últimas semestre</option>
        </select>-->

        <select id="submenudeportesajax" name="submenudeportesajax" data-contenido="liga" class="selector-zona">
            <?php 
            foreach ($submenu as $item) {
                echo '<option value="'.$item['slug'].'"';
                if ( isset( $data[0]['liga']) && $data[0]['liga'] ==  $item['id'] ) {
                    echo 'selected';
                }
                echo '>'.$item['nombre'].'</option>';
            } ?>
        </select>

        <select id="zonadeportesajax" name="zonadeportesajax" data-contenido="liga" class="selector-zona">
            <option>Todas las zonas</option>
            <?php 
            foreach ($zonas as $zona) {
                echo '<option value="'.$zona['nombre_interno'].'">'.$zona['nombre'].'</option>';
            } ?>
        </select>
        
    </div><!--//.header-contenido-->

    <div id="minicontenedorAjax" class="wrapper-contenido">
        
        <?php
       
        if ($data == null ) :
            echo 'Todavía no hay nada cargado.';
        else :
            foreach ($data as $zona ) { 
                getTemplate('loop-zona-en-liga' , $zona);

            }//foreach zonas
        endif;
        ?>
    </div>

</div><!--//.deportes-inner-wrapper-->