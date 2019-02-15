<?php
/*
 * Archivo de imagenes / inserta imagen nueva
 * versión reducida para el editor TinyMCE
 * Since 3.0
 * 
*/
require_once("../inc/functions.php");
load_module( 'deportes' );
$deporte = isset($_POST['deporte']) ? $_POST['deporte'] : '';
$equipos = isset($_POST['equipos']) ? $_POST['equipos'] : '';
$amonestacion = isset($_POST['faltas']) ? $_POST['faltas'] : 0;
$instrucciones = 'Para agregar un gol, seleccionar el jugador o los jugadores si fueron muchos goles y hacer clic en agregar.';

if ( $amonestacion == true ) {
    $instrucciones = '';
}


$equipo1 = $equipos[0];
$equipo2 = $equipos[1];

$condition1 = null;
$condition2 = null;
if ( $equipo1 != null ) {
    $condition1 =  'equipo_id='. $equipo1;
}
if ( $equipo2 != null ) {
    $condition2 =  'equipo_id='. $equipo2;
}

$jugadores1 = getPostsFromDeportes( 'jugadores', null, $condition1 );
$jugadores2 = getPostsFromDeportes( 'jugadores', null, $condition2 );

?>

<article id="browser-dialog">
	<div class="container">
        <p style="margin-top:20px; text-align:center;font-size:90%;">
            <?php echo $instrucciones; ?>
        </p>
        <div class="wrapper-equipos-browser">
            
            <ul class="equipos equipo1">
                <input type="hidden" name="data_jugador1" value="">
                <h4>
                    Jugadores
                </h4>
            
            <?php
            if ( $jugadores1 != null ) : 
            foreach ( $jugadores1 as $jugador ) {
                $imagen = URLADMINISTRADOR . '/assets/images/default-staff-image.png';

                if ( $jugador['imagen'] != '' ) {
                    $imagen = UPLOADSURLIMAGES . '/' . $jugador['imagen'];
                }
                
                //template para amonestaciones
                if ($amonestacion == true) : ?>
                
                    <li class="equipo jugador">
                        <img src="<?php echo $imagen; ?>" alt="logo equipo">
                        <span><?php echo $jugador['nombre']; ?></span>
                        <div class="selec-falta">
                            <span class="amarilla"></span><input data-id="<?php echo $jugador['id']; ?>" name="amarilla" class="falta-input" type="checkbox">
                            <span class="roja"></span><input data-id="<?php echo $jugador['id']; ?>" name="roja" class="falta-input" type="checkbox">
                        </div>
                    </li>  
                
                <?php else :
                //template para goles
                ?>

                    <li class="equipo jugador" data-id="<?php echo $jugador['id']; ?>">
                        <img src="<?php echo $imagen; ?>" alt="logo equipo">
                        <span><?php echo $jugador['nombre']; ?></span>
                    </li>
                
                <?php 
                endif;
            }
            endif;
            ?>

            </ul>

            <ul class="equipos equipo1">
                <input type="hidden" name="data_jugador2" value="">
                <h4>
                    Jugadores
                </h4>
            
            <?php
            if ( $jugadores2 != null ) : 
            foreach ( $jugadores2 as $jugador ) {
                $imagen = URLADMINISTRADOR . '/assets/images/default-staff-image.png';

                if ( $jugador['imagen'] != '' ) {
                    $imagen = UPLOADSURLIMAGES . '/' . $jugador['imagen'];
                }
                //template para amonestaciones
                if ($amonestacion == true) : ?>
                
                    <li class="equipo jugador">
                        <img src="<?php echo $imagen; ?>" alt="logo equipo">
                        <span><?php echo $jugador['nombre']; ?></span>
                        <div class="selec-falta">
                            <span class="amarilla"></span><input data-id="<?php echo $jugador['id']; ?>" name="amarilla" class="falta-input" type="checkbox">
                            <span class="roja"></span><input data-id="<?php echo $jugador['id']; ?>" name="roja" class="falta-input" type="checkbox">
                        </div>
                    </li>  
                
                <?php else :
                //template para goles
                ?>

                    <li class="equipo jugador" data-id="<?php echo $jugador['id']; ?>">
                        <img src="<?php echo $imagen; ?>" alt="logo equipo">
                        <span><?php echo $jugador['nombre']; ?></span>
                    </li>
                
                <?php 
                endif;
                }
            endif;
            ?>

            </ul>

        </div>
	</div><!-- //.container-fluid -->
</article>

<script type="text/javascript" language="javascript">

var amonestaciones = <?php echo $amonestacion; ?>;
$(document).ready( function(){
    
    //al hacer clic en los medios la url se inserta en el input
    $(document).on('click','li',function(){

        if(amonestaciones) {
            return true;
        }
        
        var ul = $(this).closest('ul');
        var input = $(ul).find( 'input' );

        var id = $(this).attr('data-id')
        var inputData = $(input).val();
        inputData = inputData.split(',');

        //ver si esta seleccionado se borra
        if ( $(this).hasClass('equipo-elegido') ) {

            $(this).removeClass('equipo-elegido');

            if ( inputData.indexOf(id) > -1 ) {
                inputData.splice(inputData.indexOf(id) ,1);

                inputData = inputData.toString();

                $(input).val(inputData);
            }

        } else {
            // sino esta seleccionado se agrega
            $(this).addClass('equipo-elegido');

            if ( inputData == '' ) {

                $(input).val(id);

            } else {

                inputData.push(id)
            
                inputData = inputData.toString();

                $(input).val(inputData);

            }
        }
    });


    //al hacer clic en los radios de las amonestaciones
    $(document).on('click','.falta-input',function(){

        var ul = $(this).closest('ul');
        var input = $(ul).find( 'input' );
        var inputData = $(input).val();

        var amonestacion = this.name;
        var id = $(this).attr('data-id');
        
        var checked = $( this ).prop( "checked" )

        var nuevoValor = id+'_'+amonestacion;
        
        if ( checked ) {
            //hay que agrarlo
            if ( inputData == '' ) {
            //si esta vacio, simplemente se agrega
            $(input).val(nuevoValor);
            } else {
                //sino esta vacío, entonces primero hay que ver si esta y hay que borrarlo

                inputData += ','+nuevoValor;
                
                $(input).val(inputData);
            }

        } else {
            //hay que borrarlo

            inputData = inputData.split(',');

            if ( inputData.indexOf(nuevoValor) > -1 ) {
                inputData.splice(inputData.indexOf(nuevoValor) ,1);
            }
            
            inputData = inputData.toString();

            $(input).val(inputData);

        }

    });

});//onready
</script>
