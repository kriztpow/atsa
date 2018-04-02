/**
 * File script.js
 *
 * @required jQuery
 * @ver 1.0
 --------------------------------------------------------------
>>> TABLE OF CONTENTS:
1.0
--------------------------------------------------------------*/

var baseUrl = 'http://' + window.location.host + '/afiliate';
var ajaxFileUrl = baseUrl + '/inc/ajax.php';

$(document).ready(function() {
    

    $('#first-form').submit(function( e ) {
    	e.preventDefault();

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
                console.log('enviando')
            },
            success: function ( response ) {
                console.log(response);
                //error 1: no existe el cuil
                //error 2: no ingresaron ningún cuil
                
            },
            error: function ( ) {
                console.log('error');
            },
    	});//cierre ajax


    });
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