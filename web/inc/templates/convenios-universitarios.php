<article id="convenios-universitarios" class="wrapper-page less-padding">

    <div class="container">
		<div class="title-deco-guion">
		    <h1 class="title-azul">
		    	Convenios y Alianzas Universitarias
		    </h1>
	    </div>
	    <p class="convenios-info">
	    	Contamos con alianzas exclusivas con dos Universidades y una Fundación, a través de las cuales se brindan Licenciaturas, Cursos y Tecnicaturas.
	    </p>

		<div class="wrapper-cursos-no-formales">
			<ul class="row loop-cursos-formacion-tecnica">
			<?php
				$connection = connectDB();
				$tabla = 'cursos';
				$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='universitarios' ORDER by curso_orden ";
					
				$result = mysqli_query($connection, $query);
				
				if ( $result->num_rows == 0 ) {
					echo 'No hay ningún convenio cargado';
				} else {
					while ($row = $result->fetch_array()) { ?>
					
					<li class="col-lg-3 col-md-4 col-sm-6">
						<a href="/convenio/<?php echo $row['curso_slug'] ?>">
						<article class="curso-formacion-tecnica convenio-universitario">
							<figure>
							<?php if ($row['curso_imagen'] != '') : ?>
								
								<img src="uploads/images/<?php echo $row['curso_imagen']; ?>" alt="Cursos ATSA">

							<?php endif; ?>

								<div class="shutter">
									<img src="<?php echo urlBase(); ?>/assets/images/open-icon.png">
								</div>

							</figure>

							<h1>
								<?php echo $row['curso_titulo']; ?>
							</h1>

						</article><!-- //curso -->
						</a>
					</li><!-- //.col-md-3 .col-sm-6 -->

				<?php }//while 
				}//else
				mysqli_close($connection);
			?>
			</ul>
		</div>

	    <h5 class="convenios-alert">
	    	<strong>Mas información</strong><br>
	    	Secretaría de Cultura al 4959-7100 (int 7117/55).
	    </h5>
	    
	</div>
</article>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {

    	//arregla los url para que funcionen las tabs
        var base = window.location.href
        $('.urltochange').each( function (){
            var baseurl = this.href;
            var url = this.href.split("#")[1];
            var newURL = base + '#' + url;
            $(this).attr('href',newURL);
        });
    	$( "#universidades" ).tabs({active : 0}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
    	$( "#universidades li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    });//ready
	
</script>