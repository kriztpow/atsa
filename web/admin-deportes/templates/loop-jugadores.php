<?php 
    $imagen = URLADMINISTRADOR . '/assets/images/default-staff-image.png';

    if ( $data['imagen'] != '' ) {
        $imagen = UPLOADSURLIMAGES .'/'. $data['imagen'];
    }
?>
<tr>
    <td width="10%">
        <input type="hidden" name='imagen_jugador' value="<?php echo $data['imagen']; ?>">
        <img class="imagen-jugador" src="<?php echo $imagen; ?>" alt="Imagen Jugador">
    </td>
    <td width=70%>
        <input type="text" name="nombre_jugador" value="<?php echo $data['nombre']; ?>">
    </td>
    <td width=20%>
        <button data-id="<?php echo $data['id']; ?>" type="button" class="btn btn-xs btn-danger imagen-jugador-btn">
            Cambiar Imagen
        </button>
        <button data-id="<?php echo $data['id']; ?>" type="button" class="btn btn-xs borrar-jugador-btn">
            <img src=<?php echo URLADMINISTRADOR . '/assets/images/delbtn.png'; ?> alt="borrar-btn" title="Borrar jugador">
        </button>
    </td>
</tr>