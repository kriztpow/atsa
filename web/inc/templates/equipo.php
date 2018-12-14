<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de equipo (individual)
*/

/*echo $data['name'].'<br>';
foreach ($data['jugadores'] as $jugador) {
    echo $jugador . '<br>';
}*/
?>
<article class="equipo" data-id="<?php echo $data['id']; ?>" data-slug="<?php echo $data['slug']; ?>">
    <input type="hidden" name="jugadores-ids" value="<?php foreach ($data['jugadores'] as $jugador) {
    echo $jugador . ',';
}?>">
    <header class="header-equipo toggle-data" data-target=".wrapper-datos-duros">
        <hgroup>
            <h1>
                <img src="<?php if ( $data['imagen'] != '' ) { 
                    echo urlbase() . '/uploads/images/' . $data['imagen']; 
                    } else {
                        echo urlbase() . '/assets/images/equipologodefault.png'; 
                    }
                    ?>" class="logo-equipo">
                <span class="titulo-equipo">
                    <?php echo $data['name']; ?>
                </span>
            </h1>
            <h2 class="subtitle">
                Estadísticas por equipo
            </h2>
        </hgroup>
    </header>
    
    <div class="wrapper-datos-duros transition closed">
        <section class="section-equipo">
            <h2 class="title-section-data">
                Estadísticas por equipo
            </h2>
            <div class="data-equipo-wrapper">
                <table class="tabla-datos tabla-datos-vertical">
                    <tr>
                        <td class="head-td">
                            Partidos Jugados:
                        </td>
                        <td>
                            2
                        </td>
                    </tr>
                        <td class="head-td">
                            Pj:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                        <td class="head-td">
                            G:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                        <td class="head-td">
                            E:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                        <td class="head-td">
                            P:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                        <td class="head-td">
                            GF:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                        <td class="head-td">
                            GC:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                        <td class="head-td">
                            DG:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                        <td class="head-td">
                            Puntos:
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="section-jugadores">
            <h2 class="title-section-data">
                Jugadores
            </h2>
            <div class="tabla-datos-wrapper">
                <table class="tabla-datos">
                    <thead>
                        <tr>
                            <td class="head-td">
                                Partidos Jugados
                            </td>
                            <td class="td-center head-td">
                                Goles
                            </td>
                            <td class="td-center head-td">
                                Amarillas
                            </td>
                            <td class="td-right head-td">
                                Rojas
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //for para gener contenido que no existe
                        for ($i=0; $i < 11; $i++) { ?>
                            <tr>
                                <td>
                                    Jugador <?php echo $i+1; ?>
                                </td>
                                <td class="td-center">
                                    10
                                </td>
                                <td class="td-center">
                                    1
                                </td>
                                <td class="td-right">
                                    0
                                </td>
                            </tr>
                        <?php }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="footer-article">
            <button class="collapse-article" data-target=".wrapper-datos-duros">
                <span class="tog1"></span>
                <span class="tog2"></span>
            </button>
        </footer>
    </div>
</article>