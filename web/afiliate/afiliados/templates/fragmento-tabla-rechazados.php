<?php
/*
 * fragmento de la tabla de afiliados, luego de la numeración que no está en bd
 * 
*/
?>
<td width="3%">
	<span class="numeracion-rows"></span>
</td>

<td width="10%">
	
	<?php echo $data['member_cuil']; ?>
	
</td>

<td width="15%">
	
	<strong>
	<?php echo $data['member_apellido'] . ', ' . $data['member_nombre'] ?>
	</strong>
	
</td>

<td width="12">
	<?php echo $data['member_dni']; ?>
</td>

<td width="12%">
	<?php echo $data['member_cuit']; ?>
</td>

<td width="6%">
	<em>
	<?php
		if ( $data['member_fecha_ingreso'] != '' ) {
			echo date('d.m.Y' ,strtotime($data['member_fecha_ingreso']) );	
		}
	?>
	</em>
</td>

<td width="10%">
	<?php
	if ( $data['member_telefono'] != '' ) {
		echo $data['member_telefono']. '<br>';
	}
	
	echo $data['member_movil']; ?>
</td>

<td width="12%">
	<?php echo $data['member_email']; ?>
</td>

<td width="15%">
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
