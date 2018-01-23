<?php
 require_once 'inc/functions.php';

?>

<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>
Complejo Cultural Sanidad </title>
<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico'/>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Google Font Raleway -->
<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,700,300' rel='stylesheet' type='text/css'>
<!-- Font Awsome Icons CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/custom.css?r=0.4543" rel="stylesheet">
<!-- Colors and Backgrounds CSS -->
<link href="css/colors_4.css?r=1.2322" rel="stylesheet">

<!-- calendar -->
<link href='css/fullcalendar.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />


</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-fixed-top nav_mask">
<div class="navi_container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
    <span class="sr-only">
    Menu</span>
    <span class="icon-bar">
    </span>
    <span class="icon-bar">
    </span>
    <span class="icon-bar">
    </span>
    </button>
    <a class="navbar-brand" href="#home_slider">
    <img src="images/logo2.png"  width="200px" height="80px" style="margin-top:-35px;margin-left: -110px;" /></a>
  </div>
  <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <li>
      <a href="<?php echo URLBASE; ?>#about_menu">
      Nosotros </a>
      </li>
      <li>
      <a href="<?php echo URLBASE; ?>#schedule_menu">
      Agenda </a>
      </li>
      <li>
      <a href="<?php echo URLBASE; ?>#speakers_menu">
      Cursos y Talleres </a>
      </li>
      <li>
      <a href="<?php echo URLBASE; ?>#reservation_menu">
      Reservas </a>
      </li>
      <li>
      <a href="<?php echo URLBASE; ?>#past_menu">
      Galeria </a>
      </li>
      <li>
      <a href="<?php echo URLBASE; ?>#contact_menu">
      Contacto </a>
      </li>
       <li>
      <a href="http://www.atsa.org.ar">
      
      Atsa Buenos Aires </a>
      </li>
    </ul>
  </div>

  <!--/.nav-collapse -->
</div>
<!--/.nav-collapse -->
</nav>
<div class="clear">
</div>

<div class="event-wrapper">
  
</div>

<div class="gap"></div>


<div id="reservation_menu" class="wow fadeIn">
  <div class="reservation">
    <div class="gap">
    </div>
    <div class="first_line">
    </div>
    <div class="first_title">
      <p>
         PRE-RESERVAS Y PRE-INSCRIPCIONES 
      </p>
    </div>
    <div class="first_description">
      <p>
         Realizá acá tu pre-reserva de espectáculos y/o pre-inscripción de talleres y cursos. Te estaremos contestando a la brevedad.</p>
    </div>

    <form id="reservation_form" action="#">
      <input class="wow fadeInDown" type="hidden" name="action" value="sendbooking">
      <input class="wow fadeInDown" name="first_name"type="text" id="make_a_reservation_input_1" placeholder="Nombre">
      <input class="wow fadeInDown" name="last_name" type="text" id="make_a_reservation_input_2" placeholder="Apellido">
      <input class="wow fadeInDown" name="email" type="text" id="make_a_reservation_input_3" placeholder="Mail">
      <input class="wow fadeInDown" name="email2" type="text" id="make_a_reservation_input_4" placeholder="Repita su Mail">
      <input class="wow fadeInDown" name="msg" type="text" id="make_a_reservation_input_5" placeholder="Mensaje">
      <input class="wow fadeInDown"  name="telephone" type="text" id="make_a_reservation_input_6" placeholder="Telefono">
    <div class="gap">
    </div>

      <input type="submit" value="Enviar" class="reservation_button wow fadeInDown" role="button">
      <div class="clear">
      </div>
      <div id="contactMsg" class="wow fadeInUp">
      </div>
    </form>
    <div class="gap">
    </div>

  </div>
</div>
<!-- End Contact -->
  <footer>
        </footer>

<!-- Scripts -->
<script type="text/javascript" src="js/jquery-2.2.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/minify.js"></script>
<!--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=75668146"></script>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-102775844-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');

  </script>-->
</body>
</html>