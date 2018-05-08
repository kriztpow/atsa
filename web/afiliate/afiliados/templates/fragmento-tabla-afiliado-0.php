<?php
/*
 * fragmento de la tabla de afiliados, luego de la numeración que no está en bd
 * 
*/
global $userStatus;
?>
<td>
	<span class="numeracion-rows"></span>
</td>
<td>
	<a href="<?php echo URLADMINISTRADOR .'/index.php?admin=edit-contacts&slug=' . $data['member_cuil']; ?>" title="Editar/ver Afiliado">
		<?php echo $data['member_cuil']; ?>
	</a>
</td>
<td>
	<a href="<?php echo URLADMINISTRADOR .'/index.php?admin=edit-contacts&slug=' . $data['member_cuil']; ?>" title="Editar/ver Afiliado">
		<strong>
		<?php echo $data['member_apellido'] . ', ' . $data['member_nombre'] ?>
		</strong>
	</a>
</td>
<td>
	<?php echo $data['member_telefono']; ?>
</td>
<td>
	<?php echo $data['member_movil']; ?>
</td>
<td>
	<em>
	<?php 
		$empresa = unserialize($data['member_empresa']);
		echo $empresa['razon-social'];
	?>
	</em>
</td>
<td>
	<?php
		if ( $data['member_fecha_ingreso'] != '' ) {
			echo date('d.m.Y' ,strtotime($data['member_fecha_ingreso']) );	
		}
	?>
</td>
<td class="member_notas_wrapper">
	<div class="member_notas" data-member-id="<?php echo $data['member_id']; ?>"><?php echo $data['member_notas']; ?></div>
	<?php if ( $data['member_notas'] != '' ) : ?>
		<div class="member_notas_full" data-member-id="<?php echo $data['member_id']; ?>"><?php echo $data['member_notas']; ?></div>
	<?php endif; ?>
	
</td>

<td>
	<div class="buttons-wrapper">
		<select data-id="<?php echo $data['member_id']; ?>" class="change-status <?php 
			if ( $data['member_status'] == '2' ) {
				echo 'anulado';
			} else {
				echo 'nocontactado';
			}
		?>">
			<?php 
			global $afiliadoStatus;
			$status = $data['member_status'];
			for ($i=0; $i < count($afiliadoStatus); $i++) { 
				$option  = '<option value="';
				$option .= $afiliadoStatus[$i]['status'];
				$option .= '"';
				if ( $afiliadoStatus[$i]['status'] == $data['member_status'] ) {
					$option .= ' selected';	
				}
				$option .= '>';
				$option .= $afiliadoStatus[$i]['definicion'];
				$option .= '</option>';
				
				echo $option;
			}
			?>
		</select>
		<?php if ( $userStatus != '1') : ?>
		<button title="Borrar Afiliado" class="del-user" data-id="<?php echo $data['member_id']; ?>">
			<img src="<?php echo URLADMINISTRADOR; ?>/assets/images/delbtn.png" alt="Borrar Afiliado">
		</button>
		<?php endif; ?>
	</div>
</td>