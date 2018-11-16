<?php
//chequea que no se acceda directo
if(!defined("SECUREACCESS"))
{
    die("El acceso directo a este archivo no está permitido.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo SITETITLE; ?></title>
<link rel="shortcut icon" href="<?php echo FAVICONICO; ?>">

<!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<!-- jQquery UI css -->
  <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
<!-- Custom CSS -->
  <link href="assets/css/admin-style.css?version=4" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!------- header ------>
<header>
<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="text-uppercase navbar-brand" href="index.php"><?php echo SITENAME; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Noticias<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li>
                  <a href="index.php?admin=editar-noticias" role="button">Agregar nueva</a>
                  </li>
                <li>
                  <a href="index.php?admin=noticias" role="button">Ver todas</a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar Página<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!--
                <li role="separator" class="divider"></li>
                <li class="dropdown-header"></li>-->
                <li>
                  <a href="index.php?admin=beneficios" role="button">Beneficios</a>
                </li>
                <li>
                  <a href="index.php?admin=convenios" role="button">Convenios</a>
                </li>
                <li>
                  <a href="index.php?admin=cursos" role="button">Cultura</a>
                </li>
                <li>
                  <a href="index.php?admin=hoteles" role="button">Hoteles y Viajes</a>
                </li>
                <li>
                  <a href="index.php?admin=home-page" role="button">Home Page</a>
                </li>
                <li>
                  <a href="index.php?admin=laboratorio" role="button">Laboratorio de simulación</a>
                </li>
                <li>
                  <a href="index.php?admin=leyes-laborales" role="button">Leyes laborales</a>
                </li>
                <li>
                  <a href="index.php?admin=preguntas" role="button">Preguntas frecuentes</a>
                </li>
                <li>
                  <a href="index.php?admin=prevencion" role="button">Programas de prevencion</a>
                </li>
                <li>
                  <a href="index.php?admin=page-edit&id=1" role="button">Sanidad en números</a>
                </li>
                <li>
                  <a href="index.php?admin=page-edit&id=2" role="button">Política de privacidad</a>
                </li>
                <li>
                  <a href="index.php?admin=staff" role="button">Staff</a>
                </li>
                <li>
                  <a href="index.php?admin=sliders" role="button">Sliders</a>
                </li>
                <li>
                  <a href="index.php?admin=deportes" role="button">Torneos y Eventos</a>
                </li>
                <li>
                  <a href="index.php?admin=vivo" role="button">Vivo</a>
                </li>
                <li>
                  <a href="index.php?admin=peticion" role="button">Petición</a>
                </li>
                <li>
                  <a href="index.php?admin=delegados-home" role="button">Acceso a delegados</a>
                </li>
                <li>
                  <a href="index.php?admin=delegados-videos" role="button">Videos para delegados</a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="index.php?admin=change-password" role="button">Cambiar contraseña</a></li>
                <li><a href="index.php?admin=nuevo-usuario" role="button">Registrar nuevo usuario</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../" target="_blank">Ver página</a></li>
            <li class="active"><a id="logout" href="#">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>
<!-- main contenido -->
<main role="main" class="main">

<div class="container titulo-gral-admin">
  <h1 class="text-center text-uppercase">
    Panel de control
  </h1>
</div>