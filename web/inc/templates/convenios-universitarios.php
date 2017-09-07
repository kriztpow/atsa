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

	    <h5 class="convenios-alert">
	    	<strong>Mas información</strong><br>
	    	Secretaría de Cultura al 4959-7100 (int 7117/55).
	    </h5>
	    <div id="universidades">
	    <?php
	    //busca y muestra los convenios organizados en tabs verticales de jquery ui
	    	$connection = connectDB();

			$query  = "SELECT * FROM cursos WHERE curso_tipo='universitarios' ORDER by curso_orden asc ";	
			$result = mysqli_query($connection, $query);
			
			if ( $result->num_rows == 0 ) {
				return;
			} else {
				while ( $row = $result->fetch_array() ) {
					$rows[] = $row;
				}//while


				//agrupar datos
				$titulos = array();
				$contenidos = array();
				$idHref = array();
				for ($i=0; $i < count($rows); $i++) { 
					array_push($titulos, $rows[$i]['curso_titulo']);
					array_push($contenidos, $rows[$i]['curso_objespecifico']);
					$newID = 'idConvenio-'.$rows[$i]['curso_ID'];
					array_push($idHref, $newID);
				}//for

				//imprimir titulos
			?> <ul> <?php
				for ($i=0; $i < count($rows); $i++) { ?>
					<li>
						<a href="#<?php echo $idHref[$i]; ?>" class="urltochange">
							<?php echo $titulos[$i]; ?>
						</a>
					</li>
			<?php }//for
			?> </ul> <?php
				//imprimir contenidos
				for ($i=0; $i < count($rows); $i++) { ?>
					<div id="<?php echo $idHref[$i]; ?>" class="tabs-content">
						<?php echo $contenidos[$i]; ?>
					</div>
			<?php }//for



			}//else

	    	mysqli_close($connection);
	    ?>
	    </div>
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