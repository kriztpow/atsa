<?php
 require_once 'inc/functions.php';

 $homeContent = getHomeContent( 'home' );
 
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
<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,700,300' rel='stylesheet' type='text/css'>
<!-- Font Awsome Icons CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/custom.css?r=0.4543" rel="stylesheet">
<!-- Colors and Backgrounds CSS -->
<link href="css/colors_4.css?r=1.2322" rel="stylesheet">
</head>
<body>
<!-- <div id="preloader">
  <div class="pre_container">
    <div class="loader">
    </div>
  </div>
</div> -->
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
    <a class="navbar-brand" href="<?php echo URLBASE; ?>">
    <img src="images/logo2.png"  width="200px" height="80px" style="margin-top:-35px;margin-left: -110px;" /></a>
  </div>
  <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <li>
      <a href="#about_menu">
      Nosotros </a>
      </li>
      <li>
      <a href="#schedule_menu">
      Agenda </a>
      </li>
      <li>
      <a href="#speakers_menu">
      Cursos y Talleres </a>
      </li>
      <li>
      <a href="#reservation_menu">
      Reservas </a>
      </li>
      <li>
      <a href="#past_menu">
      Galeria </a>
      </li>
      <li>
      <a href="#contact_menu">
      Contacto </a>
      </li>
       <li>
      <a href="https://www.atsa.org.ar">
      
      Atsa Buenos Aires </a>
      </li>
    </ul>
  </div>
 <!-- <a class="navbar-brand" href="http://www.atsa.org.ar">
	  	<img src="images/atsa.png"  width="60px"  style="margin-top:-20px" /></a> -->

 

  <!--/.nav-collapse -->
</div>
<!--/.nav-collapse -->
</nav>

<?php getTemplate('header'); ?>

<div class="clear">
</div>
<div id="about_menu">
  <!-- Page Content -->
  <div class="firstrow">
    <div class="centred">
      <div class="first_line wow fadeInDown">
      </div>
      <div class="first_title wow fadeInDown">
        <p>
           NOSOTROS
        </p>
      </div>
      <div class="first_description wow fadeInDown">

        <?php echo $homeContent['about_text']; ?>
      
      </div>
    </div>
    <div class="wow fadeIn first_image">
      <img src="<?php echo UPLOADCONTENT . '/'. $homeContent['about_mainfoto']; ?>" class="about_mainfoto">
    </div>
  </div>
  <div class="clear">
  </div>
  <div class="wow fadeIn tabs_about">
    <img src="<?php echo UPLOADCONTENT . '/'. $homeContent['about_backfoto']; ?>" class="about_backfoto">
    <div class="mask">
      <ul class="menu_tabs" role="tablist">
        <li class="active">
        <a class="wow fadeInDown btn eventime_button graybtn active" data-toggle="tab" role="button" href="#sectionA">
        Somos Cultura</a>
        </li>
        <li>
        <a class="wow fadeInDown btn eventime_button graybtn" data-toggle="tab" role="button" href="#sectionB">
        Somos Familia</a>
        </li>
        <li>
        <a class="wow fadeInDown btn eventime_button graybtn" data-toggle="tab" role="button" href="#sectionC">
        Somos trayectoria</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
          
          <?php echo $homeContent['about_cultura']; ?>
          
        </div>
        <div id="sectionB" class="tab-pane fade">
            
            <ul class="about_columns">
            <?php $v = explode ('<h4>', $homeContent['about_familia']);
            
            for ($i=1; $i < count($v); $i++) { 
              if ($i % 2 == 0) : ?>
                <li class="list">
                  <?php echo '<h4>' . $v[$i]; ?>
                </li>
              
              <?php else : ?>

                <li class="list right">
                  <?php echo '<h4>' . $v[$i]; ?>
                </li>
              <?php endif; ?>

            <?php }//for
            
            ?>
            </ul>
          
          
        </div>
        <div id="sectionC" class="tab-pane fade">
          
          <div class="about_test about-column2">
            <?php echo $homeContent['about_trayectoria']; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End About -->



<div id="schedule_menu">
  <div class="gap">
  </div>
  <div class="first_line wow fadeInDown">
  </div>
  <div class="first_title">
    <p class=" wow fadeInDown">
       AGENDA
    </p>
  </div>
  <div class="first_description">
    <div class="wow fadeInDown">
      <?php echo $homeContent['agenda_text']; ?>
    </div>
  </div>
  <div class="mini_gap">
  </div>

<!-- Carousel de agenda -->

<?php getTemplate('agenda'); ?>

</div>
<!-- End Schedule -->



<div id="speakers_menu" >
  <div class="speakers wow fadeIn ">
    <div class="mask">
      <div class="first_line">
      </div>
      <div class="first_title">
        <p>
           CURSOS Y TALLERES
        </p>
      </div>
      <div class="first_description">
        <?php echo $homeContent['cursos_text_short']; ?>
        
      </div>
      <div class="mini_gap">
      </div>
      <div class="speakers_row">
        <div class="speakers_image wow fadeIn">
          <img class="cursos-image-left" src="<?php echo UPLOADCONTENT . '/'. $homeContent['cursos_image']; ?>">
        </div>
        <div class="centred">
          <div class="speakers_description wow fadeIn">
            <h3></h3>
            <small></small>
            <br>
            <?php echo $homeContent['cursos_text']; ?>
          </div>
        </div>
      </div>
      <div class="gap">
      </div>
      
      <?php
        $cursos = getCursos();
        getTemplate('cursos', $cursos);
      ?>

      <div class="gap">
      </div>
    </div>
  </div>
</div>
<!-- End Speakers -->

<?php getTemplate( 'modal-cursos', $cursos ); ?>

<div class="pricing_tables">
    <div class="gap">
    </div>
    <div class="first_line">
    </div>
    <div class="first_title">
      <p>
         ESPACIO AUDIOVISUAL
      </p>
    </div>
    <div class="first_description">
      
    </div>

	<div class="allcontent_bootstrap">
		<div class="container-fluid">
			<div class="row">
				<div class="videoWrapper">
          <?php 
          $video = explode('=', $homeContent['audiovisual_video'] )[1];
            echo '<iframe width="100%"  height="200%" src="https://www.youtube.com/embed/' .$video. '" frameborder="0" allowfullscreen></iframe>';
          ?>
					
				</div>
				<br/>
				<br/>
				<br/>
				<br/>

					<a class="schedule_reservation wow btn eventime_button  fadeInRight" href="<?php echo $homeContent['audiovisual_link']; ?>" role="button" target="_blank">
						Ver más publicaciones</a>
 
				
			</div>
        </div>
	</div>
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
<!-- End Reservation -->
<!-- Past -->
<div id="past_menu" class="wow fadeIn">
  <div class="gap">
  </div>
  <div class="first_line">
  </div>
  <div class="first_title">
    <p>
       Galeria
    </p>
  </div>
  
  <div class="mini_gap">
  </div>



<?php
  $galeria = getSliders('galeria');
  getTemplate('galeria', $galeria);
?>

</div>
<!-- End Past -->
<div class="gap">
</div>

<?php getTemplate( 'modal-galeria', $galeria ); ?>

<!-- Contact -->
<div id="contact_menu" class="wow fadeIn">
  <div class="contact ">
    <div class="mask">
      <div class="first_line">
      </div>
      <div class="first_title">
        <p>
           Contacto
        </p>
      </div>
      <div class="first_description">
        <p>
           <?php echo $homeContent['contact_text']; ?>
        </p>
      </div>
      <div class="mini_gap">
      </div>
      
      <div class="contact_information">
        <p class="wow fadeIn">
          <span class="texticon fa fa-envelope"></span><?php echo $homeContent['contact_email']; ?><br><span class="texticon fa fa-phone"></span> 
          <?php echo $homeContent['contact_tel1']; ?><br/>
          <span class="texticon fa fa-phone"></span> <?php echo $homeContent['contact_tel2']; ?>
        </p>
        <a href="<?php echo $homeContent['contact_facebook']; ?>" target="_blank" class="contact_icon fa fa-facebook wow fadeInUp">
        </a>
      </div>
      <div class="mini_gap">
      </div>
      <div id="map">
      </div>
      
      <!-- <form class="eventime_contact_form" action="#">
           <input type="hidden" >
        <input name="first_name" class="" type="text" placeholder="First Name">
        <input name="last_name" class="rightinput" type="text" placeholder="Last Name">
        <input name="email"  type="email" placeholder="Email">
        <input name="telephone"  class="rightinput" type="tel" placeholder="Phone">
        <textarea placeholder="Message" name="message" class="make_a_reservation_message"></textarea>
        <input type="submit" value="send request" class="contact_button">
        <div class="clear">
        </div>
        <div id="contactMsgc">
        </div>
      </form> -->
    </div>
  </div>
  </div>


<!-- End Contact -->
  <footer>
        </footer>
     

<!-- Scripts -->
<script type="text/javascript" src="js/jquery-2.2.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmpvxwkkvE8BCYK_Cif5Il0VG2Nh1yjbQ"
  type="text/javascript"></script>
<!--Attetion! You need to replace follow Google MAP APi-->
<script type="text/javascript" src="js/minify.js"></script>
<script>
	
/*
(function(){

  //var x = document.querySelectorAll(".")
  var speed = 0.2;

  window.onscroll = function(){
    [].slice.call().forEach(function(el,i){

      var windowYOffset = window.pageYOffset,
          elBackgrounPos = "0 " + (windowYOffset * speed) + "px";

      el.style.backgroundPosition = elBackgrounPos;

    });
  };

})();
*/

</script>
<script type="text/javascript">
 //<![CDATA[

// Google Map
google.maps.event.addDomListener(window, 'load', init);
   function init() {
   // Basic options for a simple Google Map
   // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
   var mapOptions = {
    // How zoomed in you want the map to start at (always required)
   zoom: 15,
   scrollwheel: false,
   // The latitude and longitude to center the map (always required)
   center: new google.maps.LatLng(-34.6149, -58.4007)
   //,  
   // How you would like to style the map.
   // This is where you would paste any style found on Snazzy Maps.
  // styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
    };
    // Get the HTML DOM element that will contain your map
   var mapElement = document.getElementById('map');
   // Create the Google Map using our element and options defined above
   var map = new google.maps.Map(mapElement, mapOptions);
   // Let's also add a marker while we're at it


var marker = new google.maps.Marker({
      position: new google.maps.LatLng(-34.6149, -58.4007),
      //icon: 'images/pin_star.svg',
      map: map,
      animation: google.maps.Animation.DROP,
      title: 'Aca estamos!'
      });

    }
  //]]>
   </script>

   <!--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=75668146"></script>-->
    <!--<script>
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
