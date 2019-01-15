<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.3
 * MENU html del sitio
*/

/*
 * Selecciona que menu mostrar por ahora hay uno solo, pero 
 * puede haber más luego.
 * Además indica y remarca que está activo incluyendo la clase
 * .main-menu-active a la sección que son 6
 * nosotros, noticias, accion gremial, acción social, deporte y 
 * turismo y cultura
*/

$menuActive = 0;
$classActive = ' class="main-menu-active"';
global $pageActual;

    switch ($pageActual) {
        case 'autoridades':
        case 'quienes-somos':
        case 'sanidad-en-numeros':
            $menuActive = 1; //nosotros
            break;

        case 'noticias':
            $menuActive = 2; //noticias
            break;
        case 'convenios-colectivos':
        case 'leyes-laborales':
        case 'delegados-gremiales':
            $menuActive = 3; //acción gremial
            break;
        case 'beneficios':
            $menuActive = 4; //acción social
            break;
        case 'torneos-y-eventos':
        case 'hoteles-y-espacios-recreativos':
        case 'viajes':
            $menuActive = 5; //deporte y turismo
            break;
        case 'instituto-amado-olmos':
        case 'instituto-de-formacion-tecnico':
        case 'convenios-universitarios':
            $menuActive = 6; //cultura
            break;
    }
?>

<ul class="main-menu">
    <li<?php if ( $menuActive == 1 ) { echo $classActive; } ?>>Nosotros
        <ul class="main-menu-sub1">
            <li><a href="quienes-somos">¿Quiénes somos?</a></li>
            <li><a href="autoridades">Autoridades</a></li>
            <li><a href="sanidad-en-numeros">Sanidad en números</a></li>
        </ul>
    </li>
    <li<?php if ( $menuActive == 2 ) { echo $classActive; } ?>>
        <a href="noticias">Noticias</a>
        <ul class="main-menu-sub1">
            <li><a href="noticias/categoria/ATSA">ATSA Buenos Aires</a></li>
            <li><a href="noticias/categoria/nacionales">Nacionales</a></li>
            <li><a href="noticias/categoria/internacionales">Internacionales</a></li>
        </ul>
    </li>
    <li<?php if ( $menuActive == 3 ) { echo $classActive; } ?>>
        Acción Gremial
        <ul class="main-menu-sub1">
            <li><a href="convenios-colectivos">Convenios Colectivos y Acuerdos Salariales</a></li>
            <li><a href="leyes-laborales">Leyes Laborales</a></li>
            <li><a href="material-difusion">Material de difusión</a></li>
            <!--<li><a href="delegados-gremiales">Delegados gremiales</a></li>-->
        </ul>
    </li>
    <li<?php if ( $menuActive == 4 ) { echo $classActive; } ?>>
        Acción Social
        <ul class="main-menu-sub1">
            <li><a href="beneficios">Beneficios</a></li>
        </ul>
    </li>
    <li<?php if ( $menuActive == 5 ) { echo $classActive; } ?>>
        Deporte y Turismo
        <ul class="main-menu-sub1">
            <li><a href="torneos-y-eventos">Torneos y eventos</a></li>
            <li><a href="hoteles-y-espacios-recreativos">Hoteles y Espacios recreativos</a></li>
            <li><a href="viajes">Viajes</a></li>
        </ul>
    </li>
    <!-- El ultimo item lleva la clase last-item-menu para que el submenu se despliegue más a la izquierda y no se vaya de pagina-->
    <li class="last-item-menu <?php if ( $menuActive == 6 ) { echo 'main-menu-active'; } ?>">
        Cultura
        <ul class="main-menu-sub1">
            <li><a href="instituto-amado-olmos">Instituto Amado Olmos</a></li>
            <li><a href="instituto-de-formacion-tecnico">Instituto de Formación Técnico Profesional</a></li>
            <li><a href="convenios-universitarios">Convenios Universitarios y Alianzas Universitarias</a></li>
            <li><a href="cursos-no-formales">Cursos No Formales</a></li>
        </ul>
    </li>
    <div class="sub-menu2-movil">
        <?php getTemplate( 'sub-menu' ); ?>
    </div>
</ul><!-- //.main-menu -->