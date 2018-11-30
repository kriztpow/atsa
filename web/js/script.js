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
*/
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
                console.log(response);
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
 * FORMULARIO PETICION
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
 * ACCESO A DELEGADOS
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