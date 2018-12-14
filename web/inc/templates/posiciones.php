<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de posiciones
*/
$submenu = array(
	array('slug'=> 'futbol-11', 'name'=> 'Fútbol 11'),
	array('slug'=> 'futbol-5-libre-liguilla', 'name'=> 'Fútbol 5 Libre y Liguilla'),
	array('slug'=> 'futbol-5-veteranos', 'name'=> 'Fútbol 5 Veterano'),
	array('slug'=> 'futbol-5-femenino', 'name'=> 'Fútbol 5 Femenino'),
	array('slug'=> 'voley-femenino', 'name'=> 'Voley Femenino'),
);

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
                echo '<option value="'.$item['slug'].'">'.$item['name'].'</option>';
            } ?>
        </select>
    </div>

    <div class="wrapper-zona">
        <?php 
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
                            <td class="head-td td-center td-no-movil">
                                E
                            </td>
                            <td class="head-td td-center td-no-movil">
                                P
                            </td>
                            <td class="head-td td-center td-no-movil">
                                GF
                            </td>
                            <td class="head-td td-center td-no-movil">
                                GC
                            </td>
                            <td class="head-td td-center td-no-movil">
                                DG
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
                                <?php echo $equipo['equipo']; ?>
                            </td>
                            <td class="td-center head-td td-no-movil">
                                0
                            </td>
                            <td class="td-center head-td td-no-movil">
                                0
                            </td>
                            <td class="td-center head-td td-no-movil">
                                0
                            </td>
                            <td class="td-center head-td td-no-movil">
                                0
                            </td>
                            <td class="td-center head-td td-no-movil">
                                0
                            </td>
                            <td class="td-center head-td td-no-movil">
                                0
                            </td>
                            <td class="td-center head-td td-no-movil">
                                0
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
        ?>
    </div>
</div>
