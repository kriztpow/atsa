<?php
/*
 * fragmento de la tabla de afiliados sin boton para borrar usuario
 * 
*/
?>
<td>
	<span class="numeracion-rows"></span>
</td>
<td>
	
    <strong>
		<?php echo $data['nombre']; ?>
    </strong>
	
</td>
<td>
    <?php echo $data['dni']; ?>
</td>
<td>
    <?php echo $data['email']; ?>
</td>
<td>
    <?php echo $data['genero']; ?>
</td>
<td>
    <?php echo $data['info']; ?>
</td>
<td>
    <?php
        if ( $data['fecha'] != '' ) {
            echo date('d.m.Y' ,strtotime($data['fecha']) );	
        }
    ?>
</td>
<td>
	<div class="buttons-wrapper">
        <p class="estado-afiliado">
            <?php 
            if ( $data['estado'] == '2' ) {
                echo 'anulado';
            } else if( $data['estado'] == '3' ) {
                echo 'firmado';
            } else if( $data['estado'] == '1' ) {
                echo 'contactado';
            }
            else {
                echo 'nocontactado';
            }
            ?>
        </p>
	</div>
</td>
