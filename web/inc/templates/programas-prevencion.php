<article id="centro-medico-prevencion" class="wrapper-home">
    <!--------- header -------------->
    <header class="header-home">
        <?php
            getSliders( 'prevencion' );
        ?>
    </header>
    <section class="centro-medico-prevencion">
        <div class="container">
            <div class="title-deco-guion">
                <h1>
                    Centro Médico de Prevención
                </h1>
            </div>

            <p class="centro-medico-prevencion-descripcion">
                La Obra Social de los trabajadores de la Sanidad cuenta con un Centro Médico de Prevención exclusivo para su atención que tiene el objetivo de brindar una atención médica ambulatoria y programada, orientada al control de factores de riesgo de Enfermedad Cardiovascular. Se encuentra ubicado en Avenida San Juan 2954 (CABA), y su horario de atención es de lunes a viernes de 08 a 20 Hs.
            </p>

            <p class="centro-medico-prevencion-descripcion">
                En el Centro de Prevención los trabajadores afiliados podrán tratar problemas de Sobrepeso y Obesidad, iabetes, Dislipemia, ipertensión Arterial, Patologías Reumatológicas y Tabaquismo, entre otras condiciones, ya que cuenta con un conjunto de especialistas en distintas ramas de asistencia.
            </p>

            <p class="centro-medico-prevencion-descripcion"> 
                Además, cuenta con un Programa especial de Rehabilitación Cardiovascular para el paciente que haya presentado durante el último año un evento cardíaco o que haya sido sometido a algún procedimiento quirúrgico. El objetivo del Programa es reducir el riesgo de eventos vasculares futuros. Los planes están basados en consejo médico, educación y ejercicio supervisado.
            </p>

            <div class="title-deco-guion">
                <h2>
                    Programas de Prevención
                </h2>
            </div>

            <div id="programas-prevencion">

            <?php 
            $connection = connectDB();
            $tabla = 'prevencion';
            
            //queries según parámetros 
            $query  = "SELECT * FROM " .$tabla. " ORDER by prevencion_orden"; 
            $result = mysqli_query($connection, $query);
            
            if ( $result->num_rows == 0 ) { 
            
                echo '';
            
            } else {
                while ($row = $result->fetch_array()) {
                    $prevencionID = $row['prevencion_ID'];
                    $prevencionTitulo = $row['prevencion_titulo'];
                    $prevencionTexto = $row['prevencion_texto'];
        ?>
            <!-- item tab -->
                <h3>
                    <span class="text-title-accordion">
                        <?php echo $prevencionTitulo; ?>
                    </span>
                    <span class="icon-cross"></span>
                </h3>
                <div class="programa-prevencion">
                    <?php echo $prevencionTexto; ?>
                </div>
            <?php }//while 
            }//else
            mysqli_close($connection);
            ?>
            </div><!-- // .accordion -->

        </div><!-- // .container -->
    </section>

    <footer>
        <div class="container">
            <div class="logo-estar-bien">
                <img src="assets/images/estar-bien-logo.png" atl="Estar Bien, programa de prevención ATSA" class="img-responsive">
            </div>
            <ul class="row">
                <li class="col-md-4 col-sm-6 col-xs-12">
                    <div class="prevencion-boxes prevencion-boxes-icon-loc">
                        <strong class="text-uppercase">
                            Av San Juan 2954
                        </strong>
                    </div>
                </li>
                <li class="col-md-4 col-sm-6 col-xs-12">
                    <div class="prevencion-boxes prevencion-boxes-icon-tel">
                        <strong>
                            0800 9997264<br>
                            opcion 2
                        </strong>
                    </div>
                </li>
                
                <li class="col-md-4 col-sm-6 col-xs-12">
                    <div class="prevencion-boxes prevencion-boxes-icon-time">
                        <strong>
                            Lunes a Viernes<br>
                            8 a 20hs
                        </strong>
                    </div>
                </li>
            </ul>
        </div>
    </footer>
    
</article><!-- // .wraper-home -->
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        $( "#programas-prevencion" ).accordion({
            collapsible: true,
            active : false,
            heightStyle: "content"
        }
        );
        iconCrossOpener();
        
        $('.ui-accordion-header').click(iconCrossOpener);//click
        
    });//ready

function iconCrossOpener () {
    $('.ui-accordion-header').each(function(){
            
        if ($(this).hasClass('ui-accordion-header-active')) {
            $('.icon-cross', this).addClass('icon-cross-open');
        } else {
            $('.icon-cross', this).removeClass('icon-cross-open');
        }
    });
}
    
</script>