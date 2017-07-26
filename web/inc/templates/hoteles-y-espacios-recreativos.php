<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * hoteles template
 * Template que muestra hoteles por ahora buscando el array de hoteles en archivo data
*/
?>

<article id="hoteles" class="wrapper-home">
	<header class="header-hoteles">
        <?php
            getSliders( 'hoteles' );
        ?>
    </header>

    <section>
    	<div class="container-fluid">
    		<h1 class="main-title-hoteles">Conoce nuestros hoteles</h1>

    		<ul class="lista-hoteles">

    		<?php 
            //busca los hoteles en la base de datos y los muestra
    		$connection = connectDB();
            $tabla = 'hoteles';
            $query  = "SELECT * FROM " .$tabla;

            $result = mysqli_query($connection, $query);

            if ( $result->num_rows == 0 ) {
            echo '<div>No hay ningún hotel cargado</div>';
            } else {

                while ( $row = $result->fetch_array() ) {
                    $rows[] = $row;
                }

                foreach ($rows as $row ) { 
                    $locationTag           = $row['hotel_location'];
                    $titleHotel            = $row['hotel_titulo'];
                    $descriptionHotel      = $row['hotel_descripcion'];
                    $listaServiciosHotel   = $row['hotel_servicios'];
                    $dataExtraHotel        = $row['hotel_dataextra'];
                    $iconTipoHotel         = $row['hotel_icontipo'];
                    $iconServiciosHotel    = $row['hotel_iconservicios'];
                    $thumnailhotel         = $row['hotel_thumnail'];
                    $infoContingentesHotel = $row['hotel_contingente'];
                   

                ?>
    		
    		<!-- HOTEL -->
    			<li>
    				<article class="hotel-atsa">
    					<div class="row">
    						<div class="col-md-4 col-sm-6">
                            <div class="img-hotel-atsa"
                            <?php if ($thumnailhotel != '') {
                                echo 'style="background-image: url(uploads/images/'.$thumnailhotel.')"';
                                } ?>
    							 >
    								<span class="hotel-tag-location">
    									<?php echo $locationTag; ?>
    								</span>
    							</div>
    						</div><!-- //.col -->

    						<div class="col-md-4 col-sm-6">
    							<h1 class="title-hotel">
    								<?php echo $titleHotel; ?>
    							</h1>
    							<p class="description-hotel">
    								<?php echo $descriptionHotel; ?>
    							</p>
    						</div><!-- //.col -->

    						<div class="col-md-4 col-sm-12">
    							<div class="row">
    								<div class="col-sm-6 col-md-12">
    									<h2 class="servicios-title">
    										Servicios
    									</h2>
    									<p class="lista-servicios-hoteles">
    											<?php echo $listaServiciosHotel; ?>
    									</p>
    								</div>
    								<div class="col-sm-6 col-md-12">
    								<?php
    									if ( $dataExtraHotel != 'none' ) { ?>

    									<div class="data-extra-hotel">
    										<?php echo $dataExtraHotel; ?>
    									</div>

    									<?php 
    									}

    									if ( $infoContingentesHotel != 'none' ) { ?>

    								 	<div class="contingente-hotel">
    										<?php echo $infoContingentesHotel; ?>
    									</div>
    									<?php 
    									} ?>

    								</div>
    							</div><!-- //.inner-row -->
    						</div><!-- //.col -->

    					</div><!-- //.row -->

    					<div class="icon-servicios">
    						<img src="uploads/images/<?php echo $iconServiciosHotel; ?>" alt="Hoteles ATSA" class="img-icon-servicios-hotel">
    						<?php
								if ( $iconTipoHotel != '' ) { ?>

								<img src="uploads/images/<?php echo $iconTipoHotel; ?>" alt="Hoteles ATSA" class="img-icon-tipo-hotel">

								<?php 
								} ?>
    						
    					</div>
    				</article>
    			</li><!-- //HOTEL -->
                <?php
                }//FOREACH
            }//ELSE
            ?>
    		</ul><!-- // .lista-hoteles -->
    	</div>
    </section>

</article>