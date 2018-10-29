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
            echo getEstadoAfiliado($data['dni']);
            ?>
        </p>
	</div>
</td>
