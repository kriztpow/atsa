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


console.log('ready');
var respuesta;
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