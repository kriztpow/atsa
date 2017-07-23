<!------------ noticias recientes ------------>
<section class="section-sidebar">
	<h2 class="title-sidebar">
		Noticias Recientes
	</h2>
	<ul class="loop-recientes">
		<?php NoticiasRecientesHTML( 'none' ); ?>
	</ul>
</section>

<!------------ etiquetas ------------>
<section class="hidden-xs section-sidebar">
	<h2 class="title-sidebar">
		Etiquetas
	</h2>
	<div class="etiquetas-noticias">
		<a href="/noticias/categoria/nacionales">nacionales</a>,
		<a href="/noticias/categoria/ATSA">ATSA</a>,
		<a href="/noticias/categoria/internacionales">internacionales</a>,
		<a>Cultura</a>,
		<a>Voces de Sanidad</a>,
		<a>Espacio Audiovisual</a>,
		<a>Convenios de trabajo</a>,
		<a>Beneficios</a>
	</div>
</section>

<!------------ archivo noticias ------------>
<section class="hidden-xs section-sidebar archivo-noticias-menu">
	<h2>
		Archivo Noticias
	</h2>
	<div id="accordion-archivo">
	<!-- item tab -->
		<h3>
		  	Julio 2017
		</h3>
		<div>
			<ul class="content-archivo">
				<li>
					<a href="/noticias/gobierno-planea-flexibilizar-convenios-colectivos-y-rebajar-costos-laborales">
						El Gobierno planea flexibilizar convenios colectivos y rebajar costos laborales
					</a>
				</li>
				<li>
					<a href="/noticias/inscripciones-abiertas">
						Inscripciones abiertas
					</a>
				</li>
				<li>
					<a href="/noticias/las-14-claves-de-la-flexibilizacion-laboral-de-brasil">
						Las 14 claves de la flexibilización laboral de Brasil
					</a>
				</li>
				<li>
					<a href="/noticias/bienvenidos-compañeros-y-compañeras">
						Bienvenidos compañeros y compañeras
					</a>
				</li>
				<li>
					<a href="/noticias/juntos-y-conectados-somos-mas">
						Juntos y Conectados somos más
					</a>
				</li>
				<li>
					<a href="/noticias/acuerdo-salarial-2017-cct-107">
						Acuerdo Saladrial 2017 – CCT 107
					</a>
				</li>
				<li>
					<a href="/noticias/acuerdo-salarial-2017-cct-459">
						Acuerdo Saladrial 2017 – CCT 459
					</a>
				</li>
				<li>
					<a href="/noticias/inscripciones-abiertas">
						Inscripciones abiertas
					</a>
				</li>

				<li>
					<a href="/noticias/acuerdo-salarial-2017-cct-122">
						Acuerdo Saladrial 2017 – CCT 122
					</a>
				</li>

				<li>
					<a href="/noticias/acuerdo-salarial-2017-cct-108">
						Acuerdo Saladrial 2017 – CCT 108
					</a>
				</li>
				<li>
					<a href="/noticias/hector-daer-sobre-las-elecciones-2017">
						Héctor Daer sobre las elecciones 2017: “Mi voto va a la unidad del movimiento obrero
					</a>
				</li>
				<li>
					<a href="/noticias/red-sindical-uni">
						Red Sindical UNI
					</a>
				</li>
				<li>
					<a href="/noticias/uni-americas">
						UNI Américas
					</a>
				</li>
				<li>
					<a href="/noticias/unicare">
						Unicare
					</a>
				</li>
				<li>
					<a href="/noticias/UNI-americas-avanza-en-defensa-de-l@s-trabajador@s">
						UNI Américas avanza en defensa de l@s trabajador@s
					</a>
				</li>
				<li>
					<a href="/noticias/el-discurso-del-papa-francisco-a-los-sindicatos-italianos">
						El discurso del Papa Francisco a los sindicatos italianos
					</a>
				</li>
			</ul>
		</div>

		<!-- item tab -->
		<h3>
		  	Junio 2017
		</h3>
		<div>
			<ul class="content-archivo">
				<li><a href="/noticias/paritarias-2017-hector-daer">Paritarias 2017: “El Gobierno tiene que dar respuestas sobre los temas que nos preocupan a los trabajadores”</a></li>
				<li><a href="/noticias/las-paritarias-son-de-los-trabajadores">Las paritarias son de los trabajadores</a></li>
				<li><a href="/noticias/no-al-2x1">No al 2x1</a></li>
			</ul>
		</div>
	</div><!-- //#accordion -->
</section>
<!------- scripts de esta pagina ------>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-archivo" ).accordion({
    		collapsible: true,
    		active : false,
    		heightStyle: "content",
    	});
    });//ready
</script>