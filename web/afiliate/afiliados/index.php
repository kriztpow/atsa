<?php
/*
 * Modulo auto administrable
 * Since 2.0
 * Pagina de Inicio con links a cada módulo
*/
session_start();
$online = false;
global $userStatus;
$userStatus = 1;
require_once( 'inc/functions.php' );
//para que no accedan a los otros archivos directamente se define la constante
define('SECUREACCESS', 1);

//chequea si la sesion está iniciada y si no se exedio el tiempo
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $online = true;
    //define la categoria de usuario
    if ( isset($_SESSION['user_status'])  ) {
      $userStatus = $_SESSION['user_status'];
    } else {
      $userStatus = $_SESSION['user_status'];
    }

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

if ( $_SESSION['user_status'] == 'f' ) {
  session_destroy();
  echo 'Su sesion a terminado';
  include TEMPLATEDIR . '/login.php';
  exit;
}

global $modulo;
$modulo = isset($_GET['admin'])?$_GET['admin']:'';
global $slug;
$slug = isset($_GET['slug'])?$_GET['slug']:'';
global $search;
$search = isset($_GET['search'])?$_GET['search']:'';

/*
 * HTML DEL SITIO
*/

include 'header.php';
  
  /*
  SI MODULO ESTA DIFINDO CARGA MODULO
  */

if ( $search != '') : ?>
  <article class="wrapper-modulo">

  <?php getTemplate( 'search', $search ); ?>

  </article><!-- // wrapper interno modulo -->

<?php elseif ( $modulo != '') : ?>
  
  <article class="wrapper-modulo">

  <?php getTemplate( $modulo ); ?>

  </article><!-- // wrapper interno modulo -->

<?php else : 
  /*
   * SI EL MODULO NO ESTA DEFINIDO ENTONCES CARGA EL INDEX PERO DE ACUERDO AL USUARIO:
  */
  
  if ( $userStatus == '0' || $userStatus == '1' || $userStatus == 'a' ) : 
  /*
   * si es usuario editor o administrador, corresponde mostrar todos los modulos
  */  

  getTemplate( 'inicio', $userStatus );

  else : 
  /*
   * si es usuario específico, solo muestra el modulo que le corresponde
  */  

    getTemplate( 'main-shortcut', $userStatus );

  endif;

endif;

include 'footer.php';