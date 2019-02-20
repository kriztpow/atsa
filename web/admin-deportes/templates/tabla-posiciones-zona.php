<div class="wrapper-zona">

    <h3 class="titulo-zona">
        <?php echo $data['zona']['nombre']; ?>
    </h3>
    <div class="wrapper-equipos">
        <table class="tabla-datos tabla-posiciones">
            <thead>
                <tr>
                    <td width="30" class="head-td">
                        Equipos
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        PJ
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        G
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        E
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        P
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        GF
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        GC
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        DG
                    </td>
                    <td width="21%" class="head-td td-center">
                        Puntos
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ( $data['equipos'] as $equipo ) { ?>
                   
                    <tr data-id="<?php echo $equipo['id']; ?>">
                        <td width="30%" class="td-main">
                            <?php echo $equipo['nombre']; ?>
                        </td>
                        <td width="7%" class="td-center head-td td-no-movil">
                            <?php echo isset($equipo['pj']) ? $equipo['pj'] : '0'; ?>
                        </td>
                        <td width="7%" class="td-center head-td td-no-movil">
                            <?php echo isset($equipo['g']) ? $equipo['g'] : '0'; ?>
                        </td>
                        <td width="7%" class="td-center head-td td-no-movil">
                            <?php echo isset($equipo['e']) ? $equipo['e'] : '0'; ?>
                        </td>
                        <td width="7%" class="td-center head-td td-no-movil">
                            <?php echo isset($equipo['p']) ? $equipo['p'] : '0'; ?>
                        </td>
                        <td width="7%" class="td-center head-td td-no-movil">
                            <?php echo isset($equipo['gf']) ? $equipo['gf'] : '0'; ?>
                        </td>
                        <td width="7%" class="td-center head-td td-no-movil">
                            <?php echo isset($equipo['gc']) ? $equipo['gc'] : '0'; ?>
                        </td>
                        <td width="7%" class="td-center head-td td-no-movil">
                            <?php echo isset($equipo['dg']) ? $equipo['dg'] : '0'; ?>
                        </td>
                        <td width="21%" class="td-center head-td">
                            <?php echo isset($equipo['puntos']) ? $equipo['puntos'] : '0'; ?>
                        </td>
                    </tr>
                <?php } ?>
                
        </tbody>
    </table>
</div>