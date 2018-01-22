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

<div class='calendar-wrapper'>
  <div id='calendar'></div>
</div>



<!-- End Contact -->
  <footer></footer>
     

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

    $('#calendar').fullCalendar({
      locale: 'es',
      firstDay: 0,
      defaultDate: '2018-01-19',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      views: {
        listWeek: { buttonText: 'Agenda' }
      },
      //editable: true,
      eventMouseover : function(calEvent, jsEvent, view) {

        
        var fecha = calEvent.start._i.split('T');
        console.log(fecha[1])
        var html = '<article class="evento-wrapper"><h1>'+calEvent.title+'</h1><p>'+calEvent.description+'</p><h4><strong>Fecha</strong>: '+fecha[0]+'</h4>';

        if (fecha[1] != undefined ) {
          html += '<h4>'+fecha[1]+'</h4>';
        }
          html += '<p><small>Hace clic en el evento del calendario para reservar y ver más info.</small></p></article>';
        
        $('.calendar-wrapper').append( $(html) );

      },
      eventMouseout : 
      function(calEvent, jsEvent, view) {

          //console.log(calEvent)
          $('.evento-wrapper').remove();
      },
      //eventLimit: true, // allow "more" link when too many events
      eventSources: [

        // your event source
        {
            events: [ // put the array in the `events` property
                {
                    title  : 'event1',
                    start  : '2018-01-01'
                },
                {
                    title  : 'event2',
                    start  : '2018-01-05',
                    end    : '2010-01-07',
                    description : 'este sería un texto basico de algo',
                },
                {
                    title  : 'event3',
                    start  : '2018-01-09T12:30:00',
                }
            ],
            color: 'green',     // an option!
            textColor: 'white', // an option!
            backgroundColor: 'green',
        },
        {
            events: [ // put the array in the `events` property
                {
                    title  : 'event1',
                    start  : '2017-12-31T13:30:00'
                },
                {
                    title  : 'event1261',
                    start  : '2018-01-05T13:30:00'
                },
                {
                    title  : 'event2',
                    start  : '2018-01-12T13:00:00',
                    end    : '2010-01-12T13:30:00'
                },
                {
                    title  : 'event3',
                    start  : '2018-01-06T13:30:00',
                    description: 'decime algo lo bastante largo',
                }
            ],
            color: 'violet',     // an option!
            textColor: 'white', // an option!
            backgroundColor: 'violet',
        },
        {
            events: [ // put the array in the `events` property
                {
                    title  : 'event1',
                    start  : '2018-01-01T13:30:00'
                },
                {
                    title  : 'event2',
                    start  : '2018-01-05T13:00:00',
                    end    : '2010-01-07T13:30:00'
                },
                {
                    title  : 'event3',
                    start  : '2018-01-09T13:30:00',
                    url    : 'http://atsa.org.ar'
                }
            ],
            color: 'lightblue',     // an option!
            textColor: 'white', // an option!
            backgroundColor: 'lightblue',
        },
      ],
    });

  });

</script>


</body>
</html>
