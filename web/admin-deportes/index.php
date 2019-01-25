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

global $modulo;
$modulo = isset($_GET['admin'])?$_GET['admin']:'';
global $slug;
$slug = isset($_GET['slug'])?$_GET['slug']:'';

/*
 * HTML DEL SITIO
*/

include 'header.php';
  
  /*
  SI MODULO ESTA DIFINDO CARGA MODULO
  */

if ( $modulo != '') : ?>
  
  <article class="wrapper-modulo">

  <?php getTemplate( $modulo ); ?>

  </article><!-- // wrapper interno modulo -->

<?php else : 
  /*
   * SI EL MODULO NO ESTA DEFINIDO ENTONCES CARGA EL INDEX PERO DE ACUERDO AL USUARIO:
  */
  
  getTemplate( 'inicio', $userStatus );


endif;

include 'footer.php';