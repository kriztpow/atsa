var baseUrl = 'http://' + window.location.host + '/voces';
var uploadsUrl = baseUrl + '/contenido'
var functionsDir = baseUrl + '/inc';

$(document).ready(function(){
    /*
     * clic boton cargar mas noticias
    */
    $(document).on('click', '.btn-load-more-news', function( e ){
        e.preventDefault();
        var btn = this;
        var loader = $('.ajax-loader-noticias');
        var contenedor = $('#contenedor-noticias');
        var categoria = $(btn).attr('data-categoria');
        var page = parseInt($(btn).attr('data-page'));
        var resto = parseInt( $(btn).attr('data-resto') );
        var cantPost = $(btn).attr('data-cantpost');
        var mensaje = $('.mensaje-sutil');
        var newMensaje = resto + ' noticias más';
        
        $(this).attr('data-resto', resto);

        $.ajax( {
            type: 'POST',
            url: functionsDir + '/ajax.php',
            data: {
                function: 'load-more',
                page: page,
                categoria: categoria,
                cantPost: cantPost,

            },
            beforeSend: function() {
                loader.fadeIn();
            },
            success: function ( response ) {
                //console.log(response);
                $('.grid-item').css('position','relative');
                $('.grid-item').css('left','0');
                $('.grid-item').css('top','0');
                contenedor.append(response);
                loader.fadeOut();
                resto = resto - cantPost;
                if ( resto <= 0 ) {
                    $('.load-more-wrapper').remove();
                } else {
                    newMensaje = resto + ' noticias más';
                    mensaje.html(newMensaje);
                    //aumento el numero en el boton
                    $(btn).attr('data-page', page+1);
                    //pongo el nuevo resto
                    $(btn).attr('data-resto', resto);
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    });


    /*
    POPUP
    */
    var popup = $( '.popup' );
    var popupIMG = $( '.popup img' );
    var tiempo = 10000;
    if ( popup.length != 0 ) {
        var closeX = $( '.close-popup' );
        var closeBTN = $( '.cerrar-popup' );
        
        function openPop () {
            popup.addClass('popup-active');
            popupIMG.fadeIn();
        }
        
        setTimeout( openPop, tiempo);
        
        function closePopup() {
            popup.removeClass('popup-active');
            popupIMG.fadeOut(tiempo);
        }

        closeX.click(closePopup);
        closeBTN.click(closePopup);

    }

    /*
     * ENVIAR FORMULARIO
    */

    $('#formulario-contacto').submit(function( e ){
        e.preventDefault();

        var msjRespuesta = $('.form-response-contact');
        var btnSubmit = $('.form-submit', this);
        var textoBtn = btnSubmit.val();
        
        formData = new FormData( this );
        formData.append('function','contact-form');

        $.ajax( {
            type: 'POST',
            url: functionsDir + '/ajax.php',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                //cambia texto del boton
                btnSubmit.val('enviando');
            },
            success: function ( response ) {
                console.log(response);

                //devuelve el boton a su estado original
                btnSubmit.val(textoBtn);
                //muestra texto de respuesta a usuario
                msjRespuesta.text(response);
                if (response == 'Recibimos su consulta, responderemos a la brevedad') {
                    $('#formulario-contacto')[0].reset();
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax

    });


    /*
     * SUSCRIBIRSE FOOTER
    */

    $('#formulario-registro-footer').submit(function( e ){
        e.preventDefault();

        var msjRespuesta = $('.response-msj-footer');
        var btnSubmit = $('.form-submit', this);
        var textoBtn = btnSubmit.val();

        var formData = new FormData( this );
        formData.append('function','suscribe-footer');
        
        $.ajax( {
            type: 'POST',
            url: functionsDir + '/ajax.php',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                //cambia texto del boton
                btnSubmit.val('enviando');
            },
            success: function ( response ) {
                console.log(response);

                //devuelve el boton a su estado original
                btnSubmit.val(textoBtn);
                //muestra texto de respuesta a usuario
                $(msjRespuesta[1]).text(response)
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
       
    });



    /*
     * SUSCRIBIRSE
    */

    $('#formulario-registro').submit(function( e ){
        e.preventDefault();

        var msjRespuesta = $('.form-response-registro');
        var btnSubmit = $('.form-submit', this);
        var textoBtn = btnSubmit.val();

        var formData = new FormData( this );
        formData.append('function','suscribe-form');

        $.ajax( {
            type: 'POST',
            url: functionsDir + '/ajax.php',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                //cambia texto del boton
                btnSubmit.val('enviando');
            },
            success: function ( response ) {
                console.log(response);
                //devuelve el boton a su estado original
                btnSubmit.val(textoBtn);
                //muestra texto de respuesta a usuario
                msjRespuesta.text(response);
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    });


    

});
