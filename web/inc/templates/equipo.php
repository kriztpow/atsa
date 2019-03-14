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
<article class="equipo" data-id="<?php echo $data['id']; ?>" data-slug="<?php echo $data['slug']; ?>" data-liga="<?php echo $data['liga_id']; ?>" data-zona="<?php echo $data['zona_id']; ?>" data-estadistica="false">
    <header class="header-equipo toggle-data" data-target=".wrapper-datos-duros">
        <hgroup>
            <h1>
                <img src="<?php if ( $data['logo'] != '' ) { 
                    echo urlbase() . '/uploads/images/' . $data['logo']; 
                    } else {
                        echo urlbase() . '/assets/images/equipologodefault.png'; 
                    }
                    ?>" class="logo-equipo">
                <span class="titulo-equipo">
                    <?php echo $data['nombre']; ?>
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
                    <div class="loader-ajax"></div>
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
                                Nombre
                            </td>
                            <td class="td-center head-td">
                                <?php if ( $data['deporte_id'] != '3' )  {echo 'Goles'; } ?>
                            </td>
                            <td class="td-center head-td">
                                <?php if ( $data['deporte_id'] != '3' )  {echo 'Amarillas'; } ?>
                            </td>
                            <td class="td-center head-td">
                                <?php if ( $data['deporte_id'] != '3' )  {echo 'Rojas'; } ?>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="tbody-jugadores">
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