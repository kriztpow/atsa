<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de posiciones
*/
$submenu = getLigas();

//var_dump($data);
?>
<div class="deportes-inner-wrapper">
    <div class="header-contenido">
        <h1 class="title-content">
            Posiciones
        </h1>

        <select id="submenudeportesajax" name="submenudeportesajax" data-contenido="posiciones" class="selector-zona">
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

    <div class="wrapper-zona">
        <?php 
        if ($data == null ) {
            echo 'Todavía no hay nada cargado';
        } else {
            foreach ($data as $zona ) { ?>

                <h3 class="titulo-zona">
                    <?php echo $zona['name']; ?>
                </h3>
                <div class="wrapper-equipos">
                    <table class="tabla-datos tabla-posiciones">
                        <thead>
                            <tr>
                                <td class="head-td">
                                    Equipos
                                </td>
                                <td class="head-td td-center td-no-movil">
                                    PJ
                                </td>
                                <td class="head-td td-center td-no-movil">
                                    G
                                </td>
                                <?php if ( $zona['deporte'] != '3' ) : ?>
                                    <td class="head-td td-center td-no-movil">
                                        E
                                    </td>
                                <?php endif; ?>
                                <td class="head-td td-center td-no-movil">
                                    P
                                </td>
                                <td class="head-td td-center td-no-movil">
                                    <?php if ( $zona['deporte'] != '3' ) : ?>
                                    GF
                                    <?php else :  ?>
                                    TF
                                    <?php endif; ?>
                                </td>
                                <td class="head-td td-center td-no-movil">
                                    <?php if ( $zona['deporte'] != '3' ) : ?>
                                    GC
                                    <?php else :  ?>
                                    TC
                                    <?php endif; ?>
                                </td>
                                <td class="head-td td-center td-no-movil">
                                    <?php if ( $zona['deporte'] != '3' ) : ?>
                                    DG
                                    <?php else :  ?>
                                    DT
                                    <?php endif; ?>
                                </td>
                                <td class="head-td td-center">
                                    Puntos
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php 
                        foreach ($zona['content'] as $equipo) { ?>
                            
                            <tr>
                                <td class="td-main">
                                    <?php echo $equipo['nombre']; ?>
                                </td>
                                <td class="td-center head-td td-no-movil">
                                    <?php echo $equipo['pj']; ?>
                                </td>
                                <td class="td-center head-td td-no-movil">
                                    <?php echo $equipo['g']; ?>
                                </td>
                                <?php if ( $zona['deporte'] != '3' ) : ?>
                                    <td class="td-center head-td td-no-movil">
                                        <?php echo $equipo['e']; ?>
                                    </td>
                                <?php endif; ?>
                                <td class="td-center head-td td-no-movil">
                                    <?php echo $equipo['p']; ?>
                                </td>
                                <td class="td-center head-td td-no-movil">
                                    <?php echo $equipo['gf']; ?>
                                </td>
                                <td class="td-center head-td td-no-movil">
                                    <?php echo $equipo['gc']; ?>
                                </td>
                                <td class="td-center head-td td-no-movil">
                                    <?php 
                                    //echo $equipo['dg'];
                                        echo (int)$equipo['gf'] - (int)$equipo['gc'];
                                    ?>
                                </td>
                                <td class="td-center head-td">
                                    <?php echo $equipo['puntos']; ?>
                                </td>
                            </tr>
                    <?php }//foreach equipos
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            }//foreach zonas
        }//else
        ?>
    </div>
</div>
