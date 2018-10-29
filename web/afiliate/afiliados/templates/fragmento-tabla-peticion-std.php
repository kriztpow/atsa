<?php
/*
 * fragmento de la tabla de afiliados, luego de la numeración que no está en bd
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

		<button title="Borrar Afiliado" class="del-user-peticiones" data-id="<?php echo $data['id']; ?>">
			<img src="<?php echo URLADMINISTRADOR; ?>/assets/images/delbtn.png" alt="Borrar Afiliado">
		</button>
	</div>
</td>
