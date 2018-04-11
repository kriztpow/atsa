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
<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,700,300' rel='stylesheet' type='text/css'>
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
    <a class="navbar-brand" href="<?php echo URLBASE; ?>">
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
        Atsa Buenos Aires
      </a>
      </li>
    </ul>
  </div>

  <!--/.nav-collapse -->
</div>
<!--/.nav-collapse -->
</nav>

<div class='calendar-wrapper'>
  <div id='calendar'></div>

  <div class="notes-wrapper">
    <p>El color <span style="color: green;">VERDE</span> representa los <span style="color: green;">Cursos, Talleres y sus Muestras</span>, el <span style="color: violet;">VIOLETA</span> los <span style="color: violet;">espectáculos</span> y el <span style="color: lightblue;">CELESTE</span> las <span style="color: lightblue;">Peñas.</span></p>
  </div>

</div>
  
<!-- End Contact -->
  <footer></footer>
      <?php 
    $eventsMusica = getAgenda( -1, true, 'musica');
    $eventsMuestras = getAgenda( -1, true, 'muestras');
    $eventsEspectaculos = getAgenda( -1, true, 'espectaculos');
    
  ?>

<!-- Scripts -->
<script type="text/javascript" src="js/jquery-2.2.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/minify.js"></script>

<script src='js/moment.min.js'></script>
<!--<script src='../lib/jquery.min.js'></script>-->
<script src='js/fullcalendar.min.js'></script>
<script src='js/locale-all.js'></script>
<script>

 

  $(document).ready(function() {
    hoy = new Date();
    $('#calendar').fullCalendar({
      locale: 'es',
      firstDay: 0,
      defaultDate: hoy,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,listYear'
      },
      views: {
        listYear: { buttonText: 'Todos' }
      },
      //editable: true,
      eventMouseover : function(calEvent, jsEvent, view) {
        
        var fecha = calEvent.start._i.split(' ');
        
        f = fecha[0].split( '-' );

        var html = '<article class="evento-wrapper"><h1>'+calEvent.title+'</h1><p>'+calEvent.description+'</p><h4><strong>Fecha</strong>: '+f[2] + '-' + f[1] + '-' + f[0]+'</h4>';

        if (fecha[1] != undefined ) {
          html += '<h4><strong>Hora</strong>: '+fecha[1].substr(0,fecha[1].length-3)+' hs</h4>';
        }
          html += '</article>';
        
        $('.calendar-wrapper').append( $(html) );

      },
      eventMouseout : 
      function(calEvent, jsEvent, view) {

          $('.evento-wrapper').remove();
      },
      //eventLimit: true, // allow "more" link when too many events
      eventSources: [

        // your event source
        {
            events: [ // put the array in the `events` property muestras
            <?php 
            for ($i=0; $i < count($eventsMuestras); $i++) { ?>
              
                {
                    title  : '<?php echo $eventsMuestras[$i]['agenda_titulo']; ?>',
                    description : '<?php echo $eventsMuestras[$i]['agenda_descripcion']; ?>',
                    start  : '<?php echo $eventsMuestras[$i]['agenda_fecha_in']; ?>',
                    end    : '<?php echo $eventsMuestras[$i]['agenda_fecha_out']; ?>',
                    url    : '<?php echo $eventsMuestras[$i]['agenda_url']; ?>',
                },
            
            <?php } ?>
            ],
            color: 'green',     // an option!
            textColor: 'white', // an option!
            backgroundColor: 'green',
        },
        {
            events: [ // put the array in the `events` property espectaculos
                
            <?php 
            for ($i=0; $i < count($eventsEspectaculos); $i++) { ?>
              
                {
                    title  : '<?php echo $eventsEspectaculos[$i]['agenda_titulo']; ?>',
                    description : '<?php echo $eventsEspectaculos[$i]['agenda_descripcion']; ?>',
                    start  : '<?php echo $eventsEspectaculos[$i]['agenda_fecha_in']; ?>',
                    end    : '<?php echo $eventsEspectaculos[$i]['agenda_fecha_out']; ?>',
                    url    : '<?php echo $eventsEspectaculos[$i]['agenda_url']; ?>',
                },
            
            <?php } ?>

            ],
            color: 'violet',     // an option!
            textColor: 'white', // an option!
            backgroundColor: 'violet',
        },
        {
            events: [ // put the array in the `events` property celeste
            <?php 
            for ($i=0; $i < count($eventsMusica); $i++) { ?>
              
                {
                    title  : '<?php echo $eventsMusica[$i]['agenda_titulo']; ?>',
                    description : '<?php echo $eventsMusica[$i]['agenda_descripcion']; ?>',
                    start  : '<?php echo $eventsMusica[$i]['agenda_fecha_in']; ?>',
                    end    : '<?php echo $eventsMusica[$i]['agenda_fecha_out']; ?>',
                    url    : '<?php echo $eventsMusica[$i]['agenda_url']; ?>',
                },
            
            <?php } ?>

            ],
            color: 'lightblue',     // an option!
            textColor: 'white', // an option!
            backgroundColor: 'lightblue',
        },
      ],
    });

  });

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