<?php
/*
 * Archivo de imagenes / inserta imagen nueva
 * versión reducida para el editor TinyMCE
 * Since 3.0
 * 
*/
require_once("../inc/functions.php");
load_module( 'deportes' );
$zona = isset($_POST['zona']) ? $_POST['zona'] : '';
$equipos = getPostsFromDeportes( 'equipos', null, 'zona_id='. $zona  );
$equipo1 = $_POST['equipos'][0];
$equipo2 = $_POST['equipos'][1];
?>

<article id="browser-dialog">
	<div class="container">
        <div class="wrapper-equipos-browser">
            
            <ul class="equipos equipo1">
                <input type="hidden" name="data_equipo1" value="">
                <h4>
                    Equipo 1
                </h4>
            
            <?php

            foreach ( $equipos as $equipo ) {
                $imagen = URLADMINISTRADOR . '/assets/images/logo.png';
                $destacado = '';

                if (  $equipo['id'] == $equipo1 ) {
                    $destacado = ' equipo-elegido';
                }

                if ( $equipo['logo'] != '' ) {
                    $imagen = UPLOADSURLIMAGES . '/' . $equipo['logo'];
                }
                ?>
                <li class="equipo<?php echo $destacado?>" data-id="<?php echo $equipo['id']; ?>">
                    <img src="<?php echo $imagen; ?>" alt="logo equipo">
                    <span><?php echo $equipo['nombre']; ?></span>
                </li>
            <?php }
            ?>

            </ul>

            
            <ul class="equipos equipo2">
                <input type="hidden" name="data_equipo2" value="">
                <h4>
                    Equipo 2
                </h4>
            <?php

            foreach ( $equipos as $equipo ) {
                $imagen = URLADMINISTRADOR . '/assets/images/logo.png';
                $destacado = '';

                if (  $equipo['id'] == $equipo2 ) {
                    $destacado = ' equipo-elegido';
                }

                if ( $equipo['logo'] != '' ) {
                    $imagen = UPLOADSURLIMAGES . '/' . $equipo['logo'];
                }
                ?>
                <li class="equipo<?php echo $destacado?>" data-id="<?php echo $equipo['id']; ?>">
                    <img src="<?php echo $imagen; ?>" alt="logo equipo">
                    <span><?php echo $equipo['nombre']; ?></span>
                </li>
            <?php }
            ?>

            </ul>
        </div>
	</div><!-- //.container-fluid -->
</article>

<script type="text/javascript" language="javascript">

$(document).ready( function(){
    
    //al hacer clic en los medios la url se inserta en el input
    $(document).on('click','li',function(){
        
        //borra los destacados
        var ul = $(this).closest('ul');

        //le quita las clases
        $(ul).find('.equipo-elegido').removeClass('equipo-elegido');
        $(this).addClass('equipo-elegido');

        var id = $(this).attr('data-id')

        var input = $(ul).find( 'input' );
        $(input).val(id);
        
    });
});//onready
</script>