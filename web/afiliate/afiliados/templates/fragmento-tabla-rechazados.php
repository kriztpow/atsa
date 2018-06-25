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
	
	<?php echo $data['member_cuil']; ?>
	
</td>

<td>
	
	<strong>
	<?php echo $data['member_apellido'] . ', ' . $data['member_nombre'] ?>
	</strong>
	
</td>

<td>
	<?php echo $data['member_dni']; ?>
</td>

<td>
	<?php echo $data['member_cuit']; ?>
</td>

<td>
	<em>
	<?php
		if ( $data['member_fecha_ingreso'] != '' ) {
			echo date('d.m.Y' ,strtotime($data['member_fecha_ingreso']) );	
		}
	?>
	</em>
</td>

<td>
	<?php
	if ( $data['member_telefono'] != '' ) {
		echo $data['member_telefono']. '<br>';
	}
	
	echo $data['member_movil']; ?>
</td>

<td style="word-break: break-all;">
	<?php echo $data['member_email']; ?>
</td>

<td>
	<?php 
		$empresa = unserialize($data['member_empresa']);
		echo $empresa['empresa_domicilio'];
	?>
</td>
<td>
	<div class="buttons-wrapper">
		
		<button title="Borrar Afiliado" class="del-rechazado" data-id="<?php echo $data['member_id']; ?>">
			<img src="<?php echo URLADMINISTRADOR; ?>/assets/images/delbtn.png" alt="Borrar Afiliado">
		</button>
		
	</div>
</td>
