/**
 * File script.js
 *
 * @required jQuery
 * @ver 1.0
 --------------------------------------------------------------
>>> TABLE OF CONTENTS:
1.0 FORMULARIO
--------------------------------------------------------------*/

var baseUrl = 'http://' + window.location.host + '/afiliate';
var ajaxFileUrl = baseUrl + '/inc/ajax.php';

/*
 * FORMULARIO
*/

$(document).ready(function() {
    /*
     * FUNCIONES DE LOS LABEL
    */
    //función que hace zoom out a las etiquetas para escribir en los input:
    function zoomOutLabel( input ) {
        var contenedor = $(input).closest('.form-group')
        var label = $(contenedor).find('label')
        $(label).addClass('on');
    }
    //funcion al hacer click en label
    function focusInput( label ) {
        var contenedor = $(label).closest('.form-group')
        var input = $(contenedor).find('input')
        $(input).focus();
    }


    //clic en label, focus en input
    $(document).on('click', 'label', function(){
        focusInput( this );
    });

    //on focus, etiqueta se achica
    $(document).on('focus', 'input', function(){
        zoomOutLabel( this );
        $(this).addClass('input-on');
    });



    /*
     * SUBMIT FORMULARIO 1
    */    

    $(document).on('submit', '#first-form', function( e ) {
        e.preventDefault();

        var contenedor = $('.contenedor-formulario');
        var loader = $('.loader');

    	formData = new FormData( this );
        formData.append('function','try-cuil');
    	$.ajax( {
            type: 'POST',
            url: ajaxFileUrl,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando');
                $(loader).fadeIn();
            },
            success: function ( response ) {
                console.log(response);
                $(loader).fadeOut();
                //error 1: no existe el cuil
                //error 2: no ingresaron ningún cuil
                //error 3: error servidor
                //error 4: ya existe el cuil

                if ( response == '' ) {
                    //console.log(response);
                    $('.msj-inicio').text('OCURRIÓ UN ERROR EN EL SERVIDOR, INTENTE MÁS TARDE').css('color','red')
                } else if ( response == 'error-2' ) {
                    console.log('falta el cuil');
                    //MUESTRA MENSAJE INGRESE CUIL
                    $( $('input[name=cuil]').closest('.form-group') ).find( '.msj-error-input' ).text('INGRESE CUIL').fadeIn()
                } else if( response == 'error-1' ) {
                    console.log('No existe ese cuil');
                    //el cuil no existe, te lleva a la página de error del usuario
                    location.href = baseUrl + '/error';
                } else if ( response == 'error-4' ) {
                    console.log('El cuil ingresado ya esta registrado');
                    //el cuil no existe, te lleva a la página de error del usuario
                    location.href = baseUrl + '/error';
                } else {
                    //carga el nuevo formulario
                    $(contenedor).empty();
                    $(contenedor).append(response);
                }

                
                
            },
            error: function ( ) {
                console.log('error');
            },
    	});//cierre ajax

    });//submit formulario 1

    /*
     * SUBMIT FORMULARIO 2
    */    

    $(document).on('submit', '#second-form', function( e ) {
        e.preventDefault();
        var loader = $('.loader');

        formData = new FormData( this );
        formData.append('function','save-member');
        $.ajax( {
            type: 'POST',
            url: ajaxFileUrl,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando');
                $(loader).fadeIn();
            },
            success: function ( response ) {
                console.log(response);
                $(loader).fadeOut();
                if (response == 'ok') {
                    location.href = baseUrl + '/bienvenidos';
                } else {
                    location.href = baseUrl + '/error';
                }
                
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax

    });//submit formulario 2

});//on ready

/*
FUNCIONES CON LOAD
*/
$( window ).on('load', function(){
    
    /*
     * busca el fondo y lo incerta luego de la carga a modo de fade
     */

    //selecciona la imagen de acuerdo al tamaño
    var backgroundImage = baseUrl + '/assets/images/' + 'fondo-1920.jpg';
    if (window.innerWidth < 1500) {
        backgroundImage = baseUrl + '/assets/images/' + 'fondo-pc-1440.jpg';
    } 
    if( window.innerWidth < 992 ) {
        backgroundImage = baseUrl + '/assets/images/' + 'fondo-medio-tablet.jpg';
    }
    if( window.innerWidth < 768 ) {
        backgroundImage = baseUrl + '/assets/images/' + 'fondo-xs.jpg';
    }

    //coloca el fondo y hace fadeIn
    $('.wrapper-background').css('background-image', 'url(' + backgroundImage + ')').fadeIn();

    


});//on load