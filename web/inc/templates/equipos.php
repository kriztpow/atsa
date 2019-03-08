<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de equipos
*/
//var_dump($data);

$submenu = getLigas();

?>
<div class="deportes-inner-wrapper">
    <div class="header-contenido">
        <h1 class="title-content">
            Equipos
        </h1>

        <select id="submenudeportesajax" name="submenudeportesajax" data-contenido="equipos" class="selector-zona">
            <?php 
            foreach ($submenu as $item) {
                echo '<option value="'.$item['slug'].'"';
                if ( isset( $data[0]['liga']) && $data[0]['liga'] ==  $item['slug'] ) {
                    echo 'selected';
                }
                echo '>'.$item['nombre'].'</option>';
            } ?>
        </select>
    </div>

    <div class="wrapper-contenido">
        
        <?php 
        if ($data == null ) {
            echo 'Todavía no hay nada cargado';
        } else {
            foreach ($data as $zona ) { ?>

                <div class="wrapper-zona">
                    <h3 class="titulo-zona">
                        <?php echo $zona['name']; ?>
                    </h3>
                    <div class="wrapper-equipos">

                        <?php 
                        foreach ($zona['content'] as $equipo) {
                            getTemplate('equipo', $equipo );
                        }//foreach equipos
                        ?>
                        
                    </div>
                </div>
            
            <?php
            }//foreach zonas
        }
        ?>
    </div>
</div>