<?php
/*
 * Modulo auto administrable
 * Since 2.0
 * Pagina de Inicio con links a cada módulo
*/
session_start();
$online = false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $online = true;
  } else {
  
   include 'inc/templates/login.php';

  exit;
  }

$now = time();
if($now > $_SESSION['expire']) {
  session_destroy();
  echo 'Su sesion a terminado';
  include 'inc/templates/login.php';
  exit;
}

if ( isset($_SESSION['user_status']) && $_SESSION['user_status'] == 'd' ) {
  session_destroy();
  echo 'Su sesion a terminado';
  include 'inc/templates/login.php';
  exit;
}
//para que no accedan a los otros archivos directamente se define la constante
define('SECUREACCESS', 1);

require_once( 'inc/functions.php' );

global $modulo;
$modulo = isset($_GET['admin'])?$_GET['admin']:'';
global $slug;
$slug = isset($_GET['slug'])?$_GET['slug']:'';

/*
 * HTML DEL SITIO
*/

include 'header.php';

if ( $modulo == '') {

?>
<!---------- ACCESOS DIRECTO DESTACADO A UN MODULO IMPORTANTE ---------------->
<div class="container"> 
  <div class="jumbotron email">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4 hidden-sm">
          <div class="container logo">
            <img class="img-responsive text-center" src="<?php echo LOGOSITE; ?>" alt="<?php echo SITENAME; ?>">
            <p><?php echo SITENAME; ?> <?php echo DATEPUBLISHED; ?></p>
            <p><a class="btn btn-info btn-sm" href="../" target="_blank">volver a pagina principal</a></p>
          </div>
        </div>
        <div class="col-sm-12 col-md-8">
          <h2 class="text-uppercase">Noticias Recientes</h2>
          <p>Estas son las últimas 3 noticias cargadas:</p>
          
          <div class="container-fluid">
<!---------- noticias ---------------->
            <ul class="loop-noticias-backend-excerpt">

            <?php listaNoticias(3,'publicado'); ?>
              
            </ul>
<!---------- fin noticias ---------------->
          </div>
          <hr>
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-offset-1 col-sm-3">
                <p>
                  <a class="btn btn-success" href="index.php?admin=noticias" role="button">Ver todas</a>
                </p>
              </div>
              <div class="col-sm-3 col-sm-offset-2">
                <p>
                  <a class="btn btn btn-warning" href="index.php?admin=editar-noticias" role="button">Agregar nueva</a>
                </p>
              </div>
            </div>
          </div>  
        </div>
      </div>
        
     </div>
   </div>
</div>


<!---------- ACCESOS DIRECTOS A LOS MODULOS ---------------->
<div class="container">
  <div class="row">

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section links y pdfs -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Noticias</h2>
            <p>Administrar las noticias: Borrar, cargar y editar.</p>
            <p><a class="btn btn-success btn-sm" href="index.php?admin=noticias" role="button">Ver lista de noticias</a></p>
          </div>
        </div>
      </section><!-- //section links y pdfs -->
    </div><!-- //columna -->
    
    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section otras opciones -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Beneficios</h2>
            <p>Modificar lista de beneficios para el afiliado de ATSA.</p>
            <p><a class="btn btn-danger btn-sm" href="index.php?admin=beneficios" role="button">Modificar Beneficios</a></p>
          </div>
        </div>
      </section><!-- //section otras opciones -->
    </div><!-- //columna -->


    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section otras opciones -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Convenios</h2>
            <p>Modificar convenios, actas y escalas y evaluación.</p>
            <p><a class="btn btn-info btn-sm" href="index.php?admin=convenios" role="button">Modificar Convenios</a></p>
          </div>
        </div>
      </section><!-- //section otras opciones -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section otras opciones -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Cultura</h2>
            <p>Cursos profesionales, no formales, convenios e Instituto.</p>
            <p><a class="btn btn-warning btn-sm" href="index.php?admin=cursos" role="button">Modificar Cursos</a></p>
          </div>
        </div>
      </section><!-- //section otras opciones -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section links y pdfs -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Hoteles y Viajes</h2>
            <p>Modificar hoteles (imágenes, textos, links) y viajes.</p>
            <p><a class="btn btn-danger btn-sm" href="index.php?admin=hoteles" role="button">Modificar hoteles</a></p>
          </div>
        </div>
      </section><!-- //section links y pdfs -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section links y pdfs -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Home Page</h2>
            <p>Modificar página de inicio, videos, links, textos.</p>
            <p><a class="btn btn-info btn-sm" href="index.php?admin=home-page" role="button">Modificar página</a></p>
          </div>
        </div>
      </section><!-- //section links y pdfs -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section links y pdfs -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Laboratorio de simulacion</h2>
            <p>Modificar los items de simulación del laboratorio.</p>
            <p><a class="btn btn-warning btn-sm" href="index.php?admin=laboratorio" role="button">Modificar hoteles</a></p>
          </div>
        </div>
      </section><!-- //section links y pdfs -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section links y pdfs -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Leyes laborales</h2>
            <p>Modificar leyes, cargar pdf, modificar archivos.</p>
            <p><a class="btn btn-success btn-sm" href="index.php?admin=leyes-laborales" role="button">Modificar hoteles</a></p>
          </div>
        </div>
      </section><!-- //section links y pdfs -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section otras opciones -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Preguntas frecuentes</h2>
            <p>Modificar lista de preguntas frecuentes en ATSA.</p>
            <p><a class="btn btn-primary btn-sm" href="index.php?admin=preguntas" role="button">Modificar Preguntas</a></p>
          </div>
        </div>
      </section><!-- //section otras opciones -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section otras opciones -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Programas de Prevencion</h2>
            <p>Modificar lista de programas de prevención en ATSA.</p>
            <p><a class="btn btn-info btn-sm" href="index.php?admin=prevencion" role="button">Modificar programas</a></p>
          </div>
        </div>
      </section><!-- //section otras opciones -->
    </div><!-- //columna -->

  <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section programas -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Política de privacidad</h2>
            <p>Modificar y editar el texto del contenido.</p>
            <p><a class="btn btn-success btn-sm" href="index.php?admin=page-edit&id=2" role="button">Modificar página</a></p>
          </div>
        </div>
      </section><!-- //section programas -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section programas -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Sanidad en números</h2>
            <p>Modificar y editar el contenido de la página en cuestión.</p>
            <p><a class="btn btn-success btn-sm" href="index.php?admin=page-edit&id=1" role="button">Modificar página</a></p>
          </div>
        </div>
      </section><!-- //section programas -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section programas -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Staff</h2>
            <p>Modificar y agregar autoridades, vocales, delegados. </p>
            <p><a class="btn btn-warning btn-sm" href="index.php?admin=staff" role="button">Modificar sliders</a></p>
          </div>
        </div>
      </section><!-- //section programas -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
      <!-- section programas -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2>Sliders</h2>
            <p>Modificar los sliders actuales: borrar y/o agregar fotos.</p>
            <p><a class="btn btn-info btn-sm" href="index.php?admin=sliders" role="button">Modificar sliders</a></p>
          </div>
        </div>
      </section><!-- //section programas -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
       <!-- section galeria imágenes -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2 class="modulo-titulo">Torneos y Eventos</h2>
            <p>Modificar los pdfs del torneo, fechas, reglamentos...</p>
            <p>
              <a class="btn btn-primary btn-sm" href="index.php?admin=deportes" role="button">Modificar deportes</a>
            </p>
          </div>
        </div>
      </section><!-- //section galeria imágenes -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
       <!-- section galeria imágenes -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2 class="modulo-titulo">Petición</h2>
            <p>Modificar petición, títulos, links, textos, imagenes, urls.</p>
            <p>
              <a class="btn btn-danger btn-sm" href="index.php?admin=peticion" role="button">Modificar petición</a>
            </p>
          </div>
        </div>
      </section><!-- //section galeria imágenes -->
    </div><!-- //columna -->
    
    <div class="col-sm-12 col-md-6 col-lg-4">
       <!-- section galeria imágenes -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2 class="modulo-titulo">Vivo</h2>
            <p>Modificar url del video y texto</p>
            <p>
              <a class="btn btn-primary btn-sm" href="index.php?admin=vivo" role="button">Modificar vivo</a>
            </p>
          </div>
        </div>
      </section><!-- //section galeria imágenes -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
       <!-- section galeria imágenes -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2 class="modulo-titulo">Home Delegados</h2>
            <p>Modificar home de acceso a delegados</p>
            <p>
              <a class="btn btn-success btn-sm" href="index.php?admin=delegados-home" role="button">Modificar</a>
            </p>
          </div>
        </div>
      </section><!-- //section galeria imágenes -->
    </div><!-- //columna -->

    <div class="col-sm-12 col-md-6 col-lg-4">
       <!-- section galeria imágenes -->
      <section>
        <div class="jumbotron modulos">
          <div class="container">
            <h2 class="modulo-titulo">Videos Delegados</h2>
            <p>Modificar o agregar los videos para delegados</p>
            <p>
              <a class="btn btn-warning btn-sm" href="index.php?admin=delegados-videos" role="button">Modificar</a>
            </p>
          </div>
        </div>
      </section><!-- //section galeria imágenes -->
    </div><!-- //columna -->


  </div><!-- //row -->
</div><!-- //containre -->

<?php } else {
/*
 * HTML MODULOS
*/

getTemplate( $modulo );

}

include 'footer.php';

?>