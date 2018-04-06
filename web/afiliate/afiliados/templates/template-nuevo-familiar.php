<?php
/*
 * Template de los familiares
 * Since 2.0
*/

$number = 1;

if ( isset($_POST['numero'] ) ) {
	$number	= $_POST['numero'];
}

for ($i=0; $i < count($data); $i++) { ?>
	<tr>
		<td>
			<span class="td-number"><?php echo $number; ?></span>
		</td>
		<td>
			<input type="text" name="afiliado_pariente_parentesco" class="input-afiliado-pariente-parentesco" value="<?php if ( isset( $data[$i]['afiliado_pariente_parentesco'] ) ) { echo $data[$i]['afiliado_pariente_parentesco']; } ?>">
		</td>
		<td>
			<input type="text" name="afiliado_pariente_nombre" class="input-afiliado-pariente-nombre" value="<?php if ( isset( $data[$i]['afiliado_pariente_nombre'] ) ) { echo $data[$i]['afiliado_pariente_nombre']; } ?>">
		</td>
		<td>
			<input type="text" name="afiliado_pariente_nacionalidad" class="input-afiliado-pariente-nacionalidad" value="<?php if ( isset( $data[$i]['afiliado_pariente_nacionalidad'] ) ) { echo $data[$i]['afiliado_pariente_nacionalidad']; } ?>">
		</td>
		<td>
			<input type="text" name="afiliado_pariente_nacimiento" class="input-afiliado-pariente-nacimiento" value="<?php if ( isset( $data[$i]['afiliado_pariente_nacimiento'] ) ) { echo $data[$i]['afiliado_pariente_nacimiento']; } ?>">
		</td>
		<td>
			<input type="text" name="afiliado_pariente_dni" class="input-afiliado-pariente-dni" value="<?php if ( isset( $data[$i]['afiliado_pariente_dni'] ) ) { echo $data[$i]['afiliado_pariente_dni']; } ?>">
		</td>
		<td>
			<input type="text" name="afiliado_pariente_sexo" class="input-afiliado-pariente-sexo" value="<?php if ( isset( $data[$i]['afiliado_pariente_sexo'] ) ) { echo $data[$i]['afiliado_pariente_sexo']; } ?>">
		</td>
		<td>
			<input type="checkbox" name="afiliado_pariente_discapacidad" class="input-afiliado-pariente-discapacidad"<?php if ( isset( $data[$i]['afiliado_pariente_discapacidad'] ) && $data[$i]['afiliado_pariente_discapacidad'] == '1' ) { echo ' checked'; } ?>>
		</td>
	</tr>	
<?php 
//suma el número
$number = $number+1;
} 