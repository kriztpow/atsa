<?php
/*
 * Modulo auto administrable
 * Since 2.0
 * Pagina de Inicio con links a cada módulo
*/
session_start();
$online = false;
require_once( 'inc/functions.php' );
//para que no accedan a los otros archivos directamente se define la constante
define('SECUREACCESS', 1);

//chequea si la sesion está iniciada y si no se exedio el tiempo
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $online = true;
  } else {
  
   include TEMPLATEDIR . '/login.php';

  exit;
  }

$now = time();
if($now > $_SESSION['expire']) {
  session_destroy();
  echo 'Su sesion a terminado';
  include TEMPLATEDIR . '/login.php';
  exit;
}

if ( isset($_SESSION['user_status']) && $_SESSION['user_status'] == 'd' ) {
  session_destroy();
  echo 'Su sesion a terminado';
  include TEMPLATEDIR . '/login.php';
  exit;
}

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
<div class="main-shortcut-wrapper"> 
    <div class="container">
      <div class="row">
        <div class="col-30">
          <div class="logo">
            <img src="<?php echo LOGOSITE; ?>" alt="<?php echo SITENAME; ?>">
            <p><?php echo SITENAME; ?> <?php echo DATEPUBLISHED; ?></p>
            <p><a class="btn btn-info btn-sm" href="../" target="_blank">volver a pagina principal</a></p>
          </div>
        </div>
        <div class="col-70">
          <h2 class="">Noticias Destacadas</h2>
          <p>Estas son las noticias destacadas del slider del inicio:</p>
          
          <div class="container">
<!---------- noticias ---------------->
            <ul class="loop-noticias-backend-excerpt">

              <?php mainshorcutIndex(); ?>
              
            </ul>
<!---------- fin noticias ---------------->
          </div>
          <hr>
          
          <div class="row">
            <div class="col-30">
              <p>
                <a class="btn btn-inverse" href="index.php?admin=noticias" role="button">Ver todas</a>
              </p>
            </div>
            <div class="col-30">
              <p>
                <a class="btn btn-inverse" href="index.php?admin=editar-noticias" role="button">Agregar nueva</a>
              </p>
            </div>
          </div>
            
        </div>
      </div>
        
     </div>
  
</div>


<!---------- ACCESOS DIRECTOS A LOS MODULOS ---------------->
<div class="container">
  <div class="row">

    <div class="col-50">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Suscriptores</h2>
          <p>Ver, analizar, imprimir y exportar suscriptores.</p>
          <p><a class="btn btn-primary" href="index.php?admin=contacts" role="button">Ver suscriptores</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    <div class="col-50">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Noticias</h2>
          <p>Administrar las noticias: Borrar, cargar y editar.</p>
          <p><a class="btn btn-primary" href="index.php?admin=noticias" role="button">Ver lista de noticias</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->
    
    <div class="col-50">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Biblioteca de medios</h2>
          <p>Subir, borrar y manipular archivos e imagenes.</p>
          <p><a class="btn btn-primary" href="index.php?admin=biblioteca-medios" role="button">Ir a la Biblioteca</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    <div class="col-50">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Promociones</h2>
          <p>Activar o desactivar promociones, agregar imagen prediseñada.</p>
          <p><a class="btn btn-primary" href="index.php?admin=promociones" role="button">Modificar promociones</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

  </div><!-- //row -->
</div><!-- //containre -->

<?php } else {
/*
 * HTML MODULOS
*/
?>
<article class="wrapper-modulo">

  <?php getTemplate( $modulo ); ?>

</article><!-- // wrapper interno modulo -->

<?php }

include 'footer.php';