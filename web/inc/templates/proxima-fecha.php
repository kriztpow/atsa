<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de proxima fecha
*/
//var_dump($data);
$submenu = getLigas();
//$zonas = getZonas("liga_id='".$data[0]['liga']."'");
?>
<div class="deportes-inner-wrapper">
    <div class="header-contenido header-flex">
        <h1 class="title-content">
            Próxima fecha <span id="fecha"><?php //echo isset($data[0]) ? $data[0]['fecha'] : ''; ?></span>
        </h1>

        <select id="submenudeportesajax" name="submenudeportesajax" data-contenido="proxima-fecha" class="selector-zona">
            <?php 
            foreach ($submenu as $item) {
                echo '<option value="'.$item['slug'].'"';
                if ( isset( $data[0]['liga']) && $data[0]['liga'] ==  $item['id'] ) {
                    echo 'selected';
                }
                echo '>'.$item['nombre'].'</option>';
            } ?>
        </select>

    </div><!--//.header-contenido-->

    <div id="minicontenedorAjax" class="wrapper-contenido">
        
        <?php 
        if ($data == null) : 
            echo '<p>No hay próxima fecha</p>';
        else :
            foreach ($data as $zona ) {

                getTemplate('loop-zona-en-proxima-fecha', $zona);
            
            }//foreach zonas
        endif;
        ?>
    </div>
    
    <?php if ($data != null) : ?>
        <div class="wrapper-nav-fechas">
            <input type="hidden" name="pagination" value="0">
            <button data-direccion="prev" class="nav-fechas-btn">Fecha anterior</button>
            <button data-direccion="next" class="nav-fechas-btn">Fecha siguiente</button>
        </div>
    <?php endif; ?>

</div><!--//.deportes-inner-wrapper-->
<script src="<?php echo urlBase() . '/js/owl.carousel.min.js'; ?>"></script>