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
                        PG
                    </td>
                    
                    <?php if ( $data['deporte'] != '3' ) : ?>
                    
                        <td width="7%" class="head-td td-center td-no-movil">
                            PE
                        </td>

                    <?php endif; ?>
                    
                    <td width="7%" class="head-td td-center td-no-movil">
                        PP
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        <?php if ( $data['deporte'] == '3' ) : ?>
                            TF
                        <?php else : ?>
                            GF
                        <?php endif; ?>
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        <?php if ( $data['deporte'] == '3' ) : ?>
                            TE
                        <?php else : ?>
                            GC
                        <?php endif; ?>
                    </td>
                    <td width="7%" class="head-td td-center td-no-movil">
                        <?php if ( $data['deporte'] == '3' ) : ?>
                            DT
                        <?php else : ?>
                            DG
                        <?php endif; ?>
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

                        <?php if ( $data['deporte'] != '3' ) : ?>
                            <td width="7%" class="td-center head-td td-no-movil">
                                <?php echo isset($equipo['e']) ? $equipo['e'] : '0'; ?>
                            </td>
                        <?php endif; ?>
                        
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
                            <?php 
                                //echo isset($equipo['dg']) ? $equipo['dg'] : '0'; 
                                echo (int)$equipo['gf'] - (int)$equipo['gc'];
                            ?>
                        </td>
                        <td width="21%" class="td-center head-td">
                            <?php echo isset($equipo['puntos']) ? $equipo['puntos'] : '0'; ?>
                        </td>
                    </tr>
                <?php } ?>
                
        </tbody>
    </table>
</div>