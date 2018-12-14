<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de equipos
*/
//var_dump($data);

$submenu = array(
	array('slug'=> 'futbol-11', 'name'=> 'Fútbol 11'),
	array('slug'=> 'futbol-5-libre-liguilla', 'name'=> 'Fútbol 5 Libre y Liguilla'),
	array('slug'=> 'futbol-5-veteranos', 'name'=> 'Fútbol 5 Veterano'),
	array('slug'=> 'futbol-5-femenino', 'name'=> 'Fútbol 5 Femenino'),
	array('slug'=> 'voley-femenino', 'name'=> 'Voley Femenino'),
);

?>
<div class="deportes-inner-wrapper">
    <div class="header-contenido">
        <h1 class="title-content">
            Equipos
        </h1>

        <select id="submenudeportesajax" name="submenudeportesajax" data-contenido="equipos" class="selector-zona">
            <?php 
            foreach ($submenu as $item) {
                echo '<option value="'.$item['slug'].'">'.$item['name'].'</option>';
            } ?>
        </select>
    </div>

    <div class="wrapper-contenido">
        
        <?php 
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
        ?>
    </div>
</div>