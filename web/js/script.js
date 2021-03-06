/*Lacueva.tv script ATSA
 * 1. Animaciones e interacciones:
 * a) menu del movil
 * b) navegación fija con scroll
 * c) click and scroll
 * d) formularios ajax
 * e) Ajax: cargar más noticias
 * 2. Ajustes css jquery
 * 3. Slider home
 * 4. Formulario peticion
 * 5. acceso delegados
 * 6. mujeres que hicieron historia
 * 7. sanidad solidaria
 * 8. cursos
 * 9. deportes
*/

var currentPageDeportes = 0;

$(document).ready(function(){
    $('.barrita-afiliate').addClass('barrita-afiliate-opening');

    $('#close-barrita').click(function(){
        $('.barrita-afiliate').fadeOut();
    });

    var barritas = $('.barrita-content');
    $(barritas[1]).hide();

    barraActual = 0;


    setInterval(function (){
        if ( barraActual == 0 ) {
            $(barritas[0]).fadeOut()
            $(barritas[1]).fadeIn();     
            barraActual++;
        } else {
            $(barritas[1]).fadeOut()
            $(barritas[0]).fadeIn(); 
            barraActual = 0;
        }
        
    }, 6000);




    //menu-movil
    var mainMenuHeight = '';
    $('.toggle').click(function(){
        var mainMenu = $('.main-menu');
        if (mainMenu.css('height') == '0px') {
            mainMenu.animate({
                'height': '430px'
            },function () {
                mainMenuHeight = '430px';
            })
        } else {
            mainMenu.animate({
                'height': '0'
            })
        }
    });
    
    $('.main-menu li').click(function(){
        var mainMenu = $('.main-menu');
        var subMenu = $('.main-menu-sub1',this);
        if (subMenu.css('height') == '0px') {
            //estas tres lineas averiguan cuanto alto ocuparía el menú al 100%
            subMenu.height('100%');
            var newHeight = subMenu.height() + 'px';
            subMenu.height('0');
            //ahora que ya tenemos el alto, se anima
            subMenu.animate({
                'height': newHeight
            });
            $(this).addClass('main-menu-open-movil');
            mainMenu.css('height', '100%');
        } else {
            subMenu.animate({
                'height': '0'
            }, function(){
                mainMenu.css('height', mainMenuHeight);    
            });
          $(this).removeClass('main-menu-open-movil');  
        }
    });
    
    /*toggle del movil*/
    $('.toggle').on('click', function () {
        $('.main-menu').toggleClass('main-menu-open');
        $('.toggle').toggleClass('toggle-open');
    });
    
    /*menú fijo con scroll*/
    /*navegacion fixed*/
	$(window).scroll(function(){
        if (innerWidth >= 750) {
            if ($(window).scrollTop() > 150) {
                $('#search-form').fadeOut(500, function(){
                    //cambios en el submenu para que entre toogle
                $('.header-sub-menu').addClass('header-sub-menu-fixed');
                });
                //agregar toogle
                $('.toggle-fixed').addClass('toggle-fixed-toclick');
                //cambios en el logo
                $('.brand-name').addClass('brand-name-fixed');
                //cambio contenedor menu principal
                $('.header-nav').addClass('header-nav-fixed');
                $('.nav-index').addClass('nav-index-fixed');
                $('.nav-index-transparent').addClass('nav-index-fixed');
            } else {
                $('#search-form').fadeIn();
                //quitar toogle
                $('.toggle-fixed').removeClass('toggle-fixed-toclick');
                //cambios en el submenu para que entre toogle
                $('.header-sub-menu').removeClass('header-sub-menu-fixed');
                //cambios en el logo
                $('.brand-name').removeClass('brand-name-fixed');
                //cambio contenedor menu principal
                $('.header-nav').removeClass('header-nav-fixed').removeClass('header-nav-fixed-open');
                $('.nav-index').removeClass('nav-index-fixed');
                $('.nav-index-transparent').removeClass('nav-index-fixed');
            }
        }
    });    
    
    /*toggle fixed*/
    $('.toggle-fixed').on('click', function () {
        $('.toggle-fixed').toggleClass('toggle-open');
        $('.header-nav').toggleClass('header-nav-fixed-open');
        
    });

    $( '#espacio-audiovisual' ).click(function(){
        $( '.data-link', this ).fadeOut();
    });



    $(".click-scroll").on("click", function ( event ) {
        event.preventDefault();
        var url = $(this).attr('href');
        
        $('html, body').stop().animate({
                    scrollTop: $(url).offset().top - 90
                }, 'slow');
    });



    /*
    formularios
    */

    $( '#subscribe-form' ).on('submit', function( event ){
        
        event.preventDefault();

        var formulario =  this;
        var form_type = 'subscribe';
        var imgAjax = $( '.load-ajax-suscribe' );

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                //console.log(response);
                imgAjax.text(response);
                imgAjax.fadeIn();
                //$(formulario).reset();
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    
    });//cierra submit formulario suscribe

    $( '#main-form' ).on('submit', function( event ){
        
        event.preventDefault();
        var formulario =  this;
        var form_type = 'contact';
        var errorMsj = $( '.error-msj' );
        //var imgAjax = $( '.load-ajax-suscribe' );
        var email = $( '#email' ).val();
        var emailConfirm = $( '#email-confirm' ).val();
        if ( email != emailConfirm ) {
            errorMsj.fadeIn();
            return;
        }

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                //imgAjax.fadeIn();
                console.log('enviando formulario');
            },
            success: function ( response ) {
                
                if ( response == 1 ) {
                    $( '.msj-exito' ).fadeIn();
                    formulario.reset();
                } else {
                    $( '.msj-error' ).fadeIn();
                }
            },
            error: function () {
                console.log('error');
                $( '.msj-error' ).fadeIn();
            },
        });//cierre ajax
    
    });//cierra submit formulario contact


    $( '#footer-form' ).on('submit', function( event ){
        
        event.preventDefault();
        var formulario =  this;
        var form_type = 'footer-form';

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                if ( response == 1 ) {
                    $( '.contact-footer-msj-exito' ).fadeIn();
                } else {
                    $( '.contact-footer-msj-error' ).fadeIn();
                }
            },
            error: function () {
                console.log('error');
            },
        });//cierre ajax
    
    });//cierra submit formulario footer



    $( '#pre-ingreso-form' ).on('submit', function( event ){
        
        event.preventDefault();

        var formulario =  this;
        var form_type = 'afiliate';
        //var imgAjax = $( '.load-ajax-suscribe' );

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                //imgAjax.fadeIn();
                console.log('enviando formulario');
            },
            success: function ( response ) {
                console.log(response);
                if ( response == 1 ) {
                    $('.formulario-pre-ingreso').fadeOut();
                    $( '.pre-afiliacion-exitosa' ).fadeIn();
                } else {
                    $('.formulario-pre-ingreso').fadeOut();
                    $( '.pre-afiliacion-error' ).fadeIn();
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    
    });//cierra submit formulario afiliate


    //cargar más ajax
    var currentPage = 1;

    $('.load-more-news').click(function( event ){
        event.preventDefault();
        
        console.log('cargarmas');
        var contenedorNews = $('.loop-noticia');
        var contenedorAjax = $('.loading-news-ajax');
        var actualCategoria = this.id;
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/ajax-noticias-cargarmas.php',
            data: {
                page: currentPage + 1,
                categoria: actualCategoria,
            },
            beforeSend: function() {
                contenedorAjax.html('cargando');
                console.log('cargando');
            },
            success: function ( response ) {
                    currentPage++;
                    contenedorNews.append(response);
                    contenedorAjax.html('');
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax

    })//load-more-news



});//cierre document ready function



/*
 * Ajustes de CSS (visuales) con Jquery
*/   

$(window).on('load', function(){
//Ajuste iniciales sin eventos

console.log('all loaded')


});//cierre document ready function



/*
 * slider superior del home
*/
$(window).on( 'load', function(){
    
    /*
     *preparación del slider
    */
    
    //variables
    var contenedor = $('.slides'); 
    var slider = $('.slider');
    var slides = $(slider).find('.slide-item');
    var cantSlides = slides.length;
    var contenedorText = $('.slide-data');
    var titleSlide = $('.slide-title');
    var textSlide = $('.slide-text');
    var slideActual = 0;
    var left = $('.slider-control-left');
    var right = $('.slider-control-right');
    var speedAuto = 6000;

    //mueve todos los slides menos el primero a la derecha, queda solo el primero para ver
    for (i=1; i< cantSlides; i++) {
        $(slides[i]).css({'left':'-1920px'});
    }
    
    //si la ventana es mayor de 750 (tablet o pc) oculta el texto para animarlo
    if (innerWidth >= 750) {
        contenedorText.hide();
    }
    
    /*
     *función de funcionamiento del slider propiamente
    */
    
    //slide go left or right or rewind cuando llega al final
    function play ( where ) {
        if ( where == 'right' ) {
            if (slideActual == cantSlides-1) {
               //si es el ultimo slide no puede ir a la derecha, por lo tanto no hace nada
                return;
           } else {
               //mueve los slide
               $(slides[slideActual]).animate({'left':'1920px'},300);
               $(slides[slideActual+1]).animate({'left':'0px'},300);
               
               slideActual += 1;
               
               textAnimation(slideActual);
           }
        } else if ( where == 'left' ) {
            if (slideActual == 0) {
                //si es el primer slide no puede ir a la izquierda, por lo tanto no hace nada
               return;
           } else {
               $(slides[slideActual-1]).animate({'left':'0'},300)
               $(slides[slideActual]).animate({'left':'-1920'},300)
               
               slideActual -= 1;
               
               textAnimation(slideActual);
           }
        } else {
            //where == 'rewind'
            //lleva el primer slider a posicion 0
            $(slides[0]).animate({'left':'0'},300)
            //lleva el ultimo, es decir el actual a posición inicial
            $(slides[cantSlides-1]).animate({'left':'-1920'},300)
            //y pone todos en cero para volver a empezar
            for (i=1; i < cantSlides; i++) {
                $(slides[i]).css({'left':'-1920px'});
            }
            
            slideActual = 0;

        }
    }//play()
    
    //animación interna del slide: texto
    function textAnimation( actual ) {
        var textoAnimar = contenedorText[actual];
        $(textoAnimar).css('bottom', '-300px');
        
        setTimeout(function(){
           $(textoAnimar)
                .fadeIn()
               .animate({
               'bottom': '10px'
           })
        },500)
        
        setTimeout(function(){
           $(textoAnimar).fadeOut();
        },speedAuto-500);
    };
    
    //slide automatico
    var slideAutomatico = setInterval( playAuto, speedAuto );
        function playAuto (){
            if (slideActual == cantSlides-1) {
                //si es la última retrocede todos los slider y vuelve a empezar
                //borra el intervalo
                clearInterval(slideAutomatico);
                //retrocede todos los slides
                play('rewind');
                //velve a ejecutar intervalo
                slideAutomatico = setInterval( playAuto, speedAuto )
                //empieza la animación del texto
                textAnimation(slideActual);
            } else {
                //sino lo pasa hacia la derecha
                play('right');   
            }
        }
        
   
    right.click( function() { play ( 'right' )} );
    left.click( function() { play ( 'left' )} );

    /*
     * INICIA SLIDER
    */
    
    //quita el cargardor, muestra el primer slider
    $('.loader-slider').fadeOut();
    //inicia animación del texto del primer slide
    textAnimation(slideActual);
    
    
});//slider superior-home


/*
 * slider noticiias recientes
*/
$(window).on( 'load', function(){
    
    /*
     *preparación del slider
    */
    
    //variables
    var contenedor = $('.slides');
    var slider = $('.slider-recientes');
    var slides = $(slider).find('.slide-item');
    var cantSlides = slides.length;
    var contenedorText = $('.slide-data');
    var titleSlide = $('.slide-title');
    var textSlide = $('.slide-text');
    var slideActual = 0;
    var left = $('.slider-control-left');
    var right = $('.slider-control-right');
    var speedAuto = 6000;

    //mueve todos los slides menos el primero a la derecha, queda solo el primero para ver
    for (i=1; i< cantSlides; i++) {
        $(slides[i]).css({'left':'-1920px'});
    }
    
    //si la ventana es mayor de 750 (tablet o pc) oculta el texto para animarlo
    if (innerWidth >= 750) {
        contenedorText.hide();
    }
    
    /*
     *función de funcionamiento del slider propiamente
    */
    
    //slide go left or right or rewind cuando llega al final
    function play ( where ) {
        if ( where == 'right' ) {
            if (slideActual == cantSlides-1) {
               //si es el ultimo slide no puede ir a la derecha, por lo tanto no hace nada
                return;
           } else {
                //mueve los slide
               $(slides[slideActual]).animate({'left':'1920px'},300);
               $(slides[slideActual+1]).animate({'left':'0px'},300);
               
               slideActual += 1;
               
               textAnimation(slideActual);
           }
        } else if ( where == 'left' ) {
            if (slideActual == 0) {
                //si es el primer slide no puede ir a la izquierda, por lo tanto no hace nada
               return;
           } else {
               $(slides[slideActual-1]).animate({'left':'0'},300)
               $(slides[slideActual]).animate({'left':'-1920'},300)
               
               slideActual -= 1;
               
               textAnimation(slideActual);
           }
        } else {
            //where == 'rewind'
            //lleva el primer slider a posicion 0
            $(slides[0]).animate({'left':'0'},300)
            //lleva el ultimo, es decir el actual a posición inicial
            $(slides[cantSlides-1]).animate({'left':'-1920'},300)
            //y pone todos en cero para volver a empezar
            for (i=1; i < cantSlides; i++) {
                $(slides[i]).css({'left':'-1920px'});
            }
            
            slideActual = 0;

        }
    }//play()
    
    //animación interna del slide: texto
    function textAnimation( actual ) {
        var textoAnimar = contenedorText[actual];
        $(textoAnimar).css('bottom', '-300px');
        
        setTimeout(function(){
           $(textoAnimar)
                .fadeIn()
               .animate({
               'bottom': '10px'
           })
        },500)
        
        setTimeout(function(){
           $(textoAnimar).fadeOut();
        },speedAuto-500);
    };
    
    //slide automatico
    var slideAutomatico = setInterval( playAuto, speedAuto );
        function playAuto (){
            if (slideActual == cantSlides-1) {
                //si es la última retrocede todos los slider y vuelve a empezar
                //borra el intervalo
                clearInterval(slideAutomatico);
                //retrocede todos los slides
                play('rewind');
                //velve a ejecutar intervalo
                slideAutomatico = setInterval( playAuto, speedAuto )
                //empieza la animación del texto
                textAnimation(slideActual);
            } else {
                //sino lo pasa hacia la derecha
                play('right');   
            }
        }
        
   
    right.click( function() { play ( 'right' )} );
    left.click( function() { play ( 'left' )} );

    /*
     * INICIA SLIDER
    */
    
    //quita el cargardor, muestra el primer slider
    $('.loader-slider').fadeOut();
    //inicia animación del texto del primer slide
    textAnimation(slideActual);
    
    
});//slider superior-home


/*
 * FORMULARIO PETICION
*/

$(document).ready(function(){
    $( '#peticion-form' ).on('submit', function( event ){
        
        event.preventDefault();

        var formulario =  this;
        var form_type = 'peticion';
        //var imgAjax = $( '.load-ajax-suscribe' );

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                //imgAjax.fadeIn();
                //console.log('enviando formulario');
            },
            success: function ( response ) {
                console.log(response);
                if ( response == 1 ) {
                    window.location.href = 'https://' + window.location.host + '/peticion-gracias';
                } else {
                    $('#peticion-form').append($('<span style="display:block;margin-top: 20px;">Hubo un error, intente otra vez.</span>'));
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    
    });//cierra submit formulario afiliate
});

/*
 * LOGIN ACCESO A DELEGADOS
*/

$(document).ready(function(){
    $( '#login-acceso-delegados' ).on('submit', function( event ){
        
        event.preventDefault();

        var formulario =  this;
        var form_type = 'acceso-delegados';
        //var imgAjax = $( '.load-ajax-suscribe' );

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                //imgAjax.fadeIn();
                console.log('buscando usuario');
            },
            success: function ( response ) {
                //console.log(response);
                if ( response == 1 ) {
                    window.location.reload();
                } else {
                    console.log(response);
                    $('#peticion-form').append($('<span style="display:block;margin-top: 20px;">Hubo un error, intente otra vez.</span>'));
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    
    });//cierra submit formulario afiliate
});

/*
 * ACCESO A DELEGADOS Funciones
*/

$(document).ready(function(){

    if (innerWidth < 768 ) {
        $('.video-wrapper-destacado iframe').height(250);
    }

    //cambia el video al hacer clic sobre el
    $(document).on('click', '.togle-video', function(e) {
        e.preventDefault();

        var url = $(this).attr('data-video');
        var titulo = $(this).find('.video-tittle').text();
        var fecha = $(this).find('.fecha-video').text();
        var texto = $(this).find('.video-text').html();
        titulo = titulo.split('-')[0];
        
        var iframe = $('.video-wrapper-destacado iframe');
        var tituloDestacado = $('.video-wrapper-destacado .video-tittle');
        var fechaDestacada = $('.video-wrapper-destacado .date');
        var textoDestacado = $('.video-wrapper-destacado .texto-video');
        

        $(iframe).attr('src', url);
        $(tituloDestacado).text(titulo);
        $(fechaDestacada).text(fecha);
        $(textoDestacado).html(texto);
                
    });
});

/*
 * MUJERES Q HICIERON HISTORIA
*/

$(document).ready(function(){

    $(document).on('click', '.mujer', function(e) {
        e.preventDefault();
        var wrapper = $('#mujer_info .wrapper');
        var contenedor = $(wrapper).find('.mujer-contenido');
        var id = $(this).attr('data-id');
        var titulo = $(this).find('.titulo').text();
        var fecha = $(this).find('.fecha').text();
        var contenido = $(this).find('.contenido').html();

        var html = '<h2><strong>'+titulo+'</strong><small>'+fecha+'</small></h2>' + contenido;

        $(contenedor).empty().append( $(html) );
        $('#mujer_info').fadeIn();

    });

    $(document).on('click', '.close-button', function(e) {
        $('#mujer_info').fadeOut();
    });
});//MUJERES


/*
 * ACTIVAR, FORMULARIO
*/
$(document).ready(function(){
    $( '#activar_formulario' ).on('submit', function( event ){
        
        event.preventDefault();

        var formulario =  this;
        var form_type = 'activar';
        //var imgAjax = $( '.load-ajax-suscribe' );

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                //imgAjax.fadeIn();
                //console.log('enviando formulario');
            },
            success: function ( response ) {
                console.log(response);
                if ( response == 1 ) {
                    $( '.msj-exito' ).fadeIn();
                    formulario.reset();
                } else {
                    $( '.msj-error' ).fadeIn();
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    
    });//cierra submit formulario afiliate
});

/* SANIDAD SOLIDARIA */
$(document).ready(function(){
    $( '#sanidad_formulario' ).on('submit', function( event ){
        
        event.preventDefault();

        var formulario =  this;
        var form_type = 'sanidad-solidaria';
        //var imgAjax = $( '.load-ajax-suscribe' );

        var formData = new FormData( formulario );
        formData.append('form_type', form_type);
      
        $.ajax( {
            type: 'POST',
            url: 'inc/scripts/form-process.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                //imgAjax.fadeIn();
                //console.log('enviando formulario');
            },
            success: function ( response ) {
                console.log(response);
                if ( response == 1 ) {
                    $( '.msj-exito' ).fadeIn();
                    formulario.reset();
                } else {
                    $( '.msj-error' ).fadeIn();
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    
    });//cierra submit formulario afiliate
});


/*
 * CURSOS
*/

$(document).on('click', '.convenio-universitario', function(e) {
    e.preventDefault();
    var wrapper = $('.wrapper-modal');
    var contenedor = $(wrapper).find('.contenedor-interno');
    
    var id = $(this).attr('data-id');
    var titulo = $(this).find('.titulo-curso').text();
    var contenido = $(this).find('.contenido-curso').html();

    var html = '<h1>'+titulo+'</h1><div class="contenido">' + contenido + '</div>';

    $(contenedor).empty().append( $(html) );
    $('#modal-curso').fadeIn();

    if ( window.innerWidth < 768 ) {
        $('html, body').stop().animate({
            scrollTop: 0
        }, 'slow');
    }

});

$(document).on('click', '.close-button', function(e) {
    $('#modal-curso').fadeOut();
});


/*
 * DEPORTES
*/

//esta funcion carga el contenido de deportes la pagina completa con header y menus, todo se hace por ajax, se carga desde el template onload:
function getContent(contenido, liga) {
    var funcionAjax = 'contenido-macro';
    var loader = $('.loader-ajax');
    var contenedor = $('#contenedorAjax');
    var tituloPag = $('.nav-title');
    var errorMsj = 'Hubo un problema de conexion, intente nuevamente';
    var errorDefault = '<p class="error-default">'+errorMsj+'</p>';
    
    if ( liga == '' || liga == undefined || liga == null ) {
        liga = '';
    }
    if ( contenido == '' || contenido == undefined || contenido == null ) {
        contenido = '';
    } 
      
    $.ajax( {
        type: 'POST',
        url: 'inc/scripts/ajax-deportes.php',
        data: {
            contenido: contenido,
            liga: liga,
            funcionAjax: funcionAjax,
        },
        beforeSend: function() {
            $(contenedor).fadeOut().empty();
            $(loader).fadeIn();
        },
        success: function ( response ) {
            //console.log(response);
            $(loader).fadeOut();
            if ( response ) {
                var data = JSON.parse(response);

                if ( data.error > 0 ) {

                    console.log(data.error);
                    $(contenedor).append( errorDefault ).fadeIn();

                } else {
                    //chequea que los títulos sean iguales, sino los cambia
                    if ( data.titulo.slug !=  $(tituloPag).attr('data-slug') ) {
                        $(tituloPag).attr('data-slug', data.titulo.slug);
                        $(tituloPag).text(data.titulo.name);
                    }
                    //inserta el html en el contenedor
                    
                    $(contenedor).empty().append( data.html ).fadeIn();
                    
                    //reinicia/inicia los acordeones
                    initSports();

                }

            } else {
                $(contenedor).empty().hide().append( errorDefault ).fadeIn();
            }
            
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax
    
}

//esta funcion carga el contenido de deportes pero solo el contenido ya que el menu y lo demas ya esta, todo se hace por ajax: sirve por ejemplo para filtrar por zonas
function getMiniContent(contenido, liga, contenedor, variables) {
    var loader = $('.loader-ajax');
    var tituloDeportes = $('#nameZona');
    var errorMsj = 'Hubo un problema de conexion, intente nuevamente';
    var errorDefault = '<p class="error-default">'+errorMsj+'</p>';
    
    if ( liga == '' || liga == undefined || liga == null ) {
        liga = '';
    }
    if ( contenido == '' || contenido == undefined || contenido == null ) {
        contenido = '';
    }
    
    if ( variables != undefined ) {
        var funcionAjax = 'contenido-zona';
        var data = {
            contenido: contenido,
            liga: liga,
            variables:variables,
            funcionAjax: funcionAjax,
        }
    }
      
    $.ajax( {
        type: 'POST',
        url: 'inc/scripts/ajax-deportes.php',
        data: data,
        beforeSend: function() {
            $(contenedor).fadeOut().empty();
            $(loader).fadeIn();
        },
        success: function ( response ) {
            //console.log(response);
            $(loader).fadeOut();
            if ( response ) {
                var data = JSON.parse(response);

                if ( data.error > 0 ) {

                    console.log(data.error);
                    $(contenedor).append( errorDefault ).fadeIn();

                } else {
                    
                    //inserta el html en el contenedor
                    $(contenedor).empty().append( data.html ).fadeIn();
                    
                    //reinicia/inicia los acordeones
                    initSports();

                }

            } else {
                $(contenedor).append( errorDefault ).fadeIn();
            }
            
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax
    
}


/*
 * busca y arma las estadíscitas del equipo por ajax cuando se hace clic y luego lo incerta en el lugar
 recibe como parametro el "article" del html que es donde están todos los datos para ir a buscar todo
*/
function getEstadisticas( equipo ) {
    var loader = $('.loader-ajax');
    var equipoId = $(equipo).attr('data-id');
    var zonaId = $(equipo).attr('data-liga');
    var ligaId = $(equipo).attr('data-zona');
    var contenedorEstadistica = $(equipo).find('.tabla-datos-vertical')
    var contenedorJugadores = $(equipo).find('.tbody-jugadores')
    var target = $( $(equipo).find('.toggle-data') ).attr('data-target');
    var contenedor = $(equipo).find(target);

    //agrega la marca de que ya esta cargada la estadística para que no haya que cargarlo otra vez
    $(equipo).attr('data-estadistica', 'true');
    
    var data = {
        funcionAjax: 'estadisticas-equipo',
        equipo: equipoId,
        liga: ligaId,
        zona: zonaId,
    };

    $.ajax( {
        type: 'POST',
        url: 'inc/scripts/ajax-deportes.php',
        data: data,
        beforeSend: function() {
            $(loader).fadeIn();
        },
        success: function ( response ) {
            //console.log(response);
            $(loader).fadeOut();
            if ( response ) {
                var data = JSON.parse(response);

                if ( data.error > 0 ) {

                    console.log(data.error);
                    $(contenedorEstadistica).append( errorDefault ).fadeIn();
                    $(contenedorJugadores).append( errorDefault ).fadeIn();

                } else {
                    
                    //inserta el html de los jugadoresen el contenedor
                    $(contenedorJugadores).empty().append( data.html_jugadores ).fadeIn();
                    //inserta el html de estadisticas en el contenedor
                    $(contenedorEstadistica).empty().append( data.html_estadisticas ).fadeIn();
                    //luego agranda la altura del contenedor para verlo bien
                    $(contenedor).css('height', $(contenedor).prop('scrollHeight') + 'px');
                    
                    //reinicia/inicia los acordeones
                    initSports();

                }

            } else {
                $(contenedor).append( errorDefault ).fadeIn();
            }
            
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax

}


/* Recupera por ajax el resumen del partido, puede tener fotos y videos.
*el id para buscar el contenido, el contenedor es donde se va a ubicar la data y el wrapper es lo que hay que ajustar o hacer crecer en altura para que se muestre bien el contenido
*/
function getResumenPartido(id, contenedor, wrapper) {
    var errorMsj = 'Hubo un problema de conexion, intente nuevamente';
    var errorDefault = '<p class="error-default">'+errorMsj+'</p>';

    var data = {
        funcionAjax: 'resumen-partido',
        contenido_id: id,
    };

    $.ajax( {
        type: 'POST',
        url: 'inc/scripts/ajax-deportes.php',
        data: data,
        success: function ( response ) {
            //console.log(response);
            
            if ( response ) {
                var data = JSON.parse(response);

                if ( data.status != 'ok' ) {

                    console.log(data.error);
                    $(contenedor).empty().append( errorDefault ).fadeIn();

                } else {
                    
                    //inserta el html de los jugadoresen el contenedor
                    $(contenedor).empty().append( data.html ).fadeIn();
                    
                    $(wrapper).css('height', $(wrapper).prop('scrollHeight') + 'px');
                    
                    //reinicia/inicia los acordeones
                    initSports();
                    var carousel = $(contenedor).find('.nuevocarousel');
                    if (carousel.length > 0) {
                        initfotosSliders(carousel);
                    }
                    

                }

            } else {
                $(contenedor).append( errorDefault ).fadeIn();
            }
            
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax
    
}

//inicia el owl carousel
var idcarousel = 0;
function initfotosSliders(carousel) {
    idcarousel++;
    var nuevoid = 'fotos-resumen-'+idcarousel;
    $(carousel).attr('id', nuevoid);
    $('#'+nuevoid).owlCarousel({
        items:1,
        margin:10,
        autoHeight:true,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
    });
}

//esta funcion va cambiando de fecha en la pagina de proxima fecha
function getNewFecha(direccion, liga) {
    var contenedor = $('#minicontenedorAjax');

    //avanza o retrocede la pagina
    if (direccion=='prev') {
        currentPageDeportes--;
    } else {
        currentPageDeportes++;
    }

    //console.log('Page: '+currentPageDeportes, 'Direccion: '+direccion);
    var data = {
        funcionAjax: 'cambiar-fecha',
        liga: liga,
        direccion: direccion,
        page:currentPageDeportes,
    };

    $.ajax( {
        type: 'POST',
        url: 'inc/scripts/ajax-deportes.php',
        data: data,
        success: function ( response ) {
            //console.log(response);
            
            if ( response ) {
                var data = JSON.parse(response);

                if ( data.status != 'ok' ) {

                    console.log(data.error);
                    $(contenedor).empty().append( errorDefault ).fadeIn();

                } else {
                    
                    //inserta el html de los jugadoresen el contenedor
                    $(contenedor).empty().append( data.html ).fadeIn();
                }
            } else {
                $(contenedor).append( errorDefault ).fadeIn();
            }
            
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax
}


//esta funcion inicia los deportes si el contenido se carga
//tiene los clicks y los change y todos los eventos
function initSports() {

    //acordeones de equipos
    $(document).on('click', '.toggle-data', function(){
        var target = $(this).attr('data-target');
        var wrapper = $(this).closest('article');
        var contenedor = $(wrapper).find(target);

        if ( contenedor.height() == 0 ) {
            $(contenedor).css('height', $(contenedor).prop('scrollHeight') + 'px');
            $(contenedor).addClass('opened');
            $(contenedor).removeClass('closed');

            //si las estadisticas no estan cargadas, entonces la buscan por ajax
            if ( $(wrapper).attr('data-estadistica') == 'false' ) {
                getEstadisticas( wrapper );
            }

        } else {
            $(contenedor).css('height', '0');
            $(contenedor).addClass('closed');
            $(contenedor).removeClass('opened');
        }

    });

    //cierra acordeon
    $(document).on('click', '.collapse-article', function(){
        var target = $(this).attr('data-target');
        var wrapper = $(this).closest('article');
        var contenedor = $(wrapper).find(target);
        $(contenedor).css('height', '0');
        $(contenedor).addClass('closed');
        $(contenedor).removeClass('opened');
    });

    //cambia el selector, este selector cambia los equipos
    $('#submenudeportesajax').change(function(){
        var contenido = $(this).attr('data-contenido');
        var deporte = $(this).val();
        currentPageDeportes = 0;
        
        //luego utiliza la funcion anterior para cargar nuevo contenido
        getContent(contenido, deporte);
    });

    //cambia el selector, este selector cambia los equipos
    $('#zonadeportesajax').change(function(){
        var contenido = $(this).attr('data-contenido');
        var liga = $('#submenudeportesajax').val();
        var zona = $(this).val();
        var contenedor = $('#minicontenedorAjax');
        currentPageDeportes = 0;
        
        //luego utiliza la funcion anterior para cargar nuevo contenido
        getMiniContent(contenido, liga, contenedor, zona);
    });

    //boton que muestra resumen del partido
    $(document).on('click', '.button-resumen-partido', function () {
        var contenidoId = $(this).attr('data-contenido');
        var partido = $(this).closest('article');
        var resumen = $(partido).find('.resumen-partido');
        var wrapperResumen = $(partido).find('.resumen-partido-interno');
        var data = $(partido).find('.resumen-wrapper');
        
        if ( data.length == 0 ) {
            var loader = '<div class="loader-ajax"><img src="assets/images/loader.gif"></div>';
            $(wrapperResumen).append( $(loader) );

            getResumenPartido(contenidoId, wrapperResumen, resumen);
            
        } 

        if ( $(resumen).height() == 0 ) {
            //var alturaResumen = '200';
            var alturaResumen = $(resumen).prop('scrollHeight')
            $(resumen).css('height' , alturaResumen + 'px');
        } else {
            $(resumen).css('height' , 0);
        }
        
    });//clic en resumen

    /*
    * POR AJAX NAVEGA ENTRE LAS FECHAS
    */
    $(document).on('click', '.nav-fechas-btn', function (e) {
        e.preventDefault();

        var direccion = $(this).attr('data-direccion');
        var liga = $('#submenudeportesajax').val();

        getNewFecha(direccion, liga);

    });


}//initsports()