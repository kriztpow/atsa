<?php 
    $equipos = explode(',', $data['equipos_id']);
    $equipo1 = getPostsFromDeportesById( $equipos[0], 'equipos' );
    $equipo2 = getPostsFromDeportesById( $equipos[1], 'equipos' );
?>
<tr>
    <td class="equipo" data-id="<?php echo $equipo1['id']; ?>">
        <?php echo $equipo1['nombre']; ?>
    </td>
    <td class="vs">
        vs
    </td>
    <td class="equipo" data-id="<?php echo $equipo2['id']; ?>">
        <?php echo $equipo2['nombre']; ?>
    </td>
    <td class="btns">
        <a data_id="id" href="index.php?admin=editar-partidos&id=<?php echo $data['id']; ?>" target="_blank">
            Editar
        </a>
    </td>
</tr>