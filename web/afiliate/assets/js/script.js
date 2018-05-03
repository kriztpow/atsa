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
var specialcharacters = '@#$^&%*()+=[]\'\"\/{}|:;¡!¿?<>,.';
var numeros = '0123456789';
var letras = 'abcdefghijklmnñopqrstuvwxyz';

//busca los caracteres indicados en un string y devuelve true si existen
function areThereAny ( cadena, characters ) {
    for (var i = 0; i < characters.length; i++) {
       if ( cadena.indexOf(characters[i]) != -1 ) {
            return true;    
       }
   }
   return false;
}

//quita numeros de un string
function cleanedOthers(cadena, caracteres){ 

   //eliminamos uno por uno
   for (var i = 0; i < caracteres.length; i++) {
       cadena= cadena.replace(new RegExp(caracteres[i], 'gi'), '');
   }   

   return cadena;
}

//quita caracteres extraños del string, los caracteres se pasan como una variable
function cleanedSpecialCharacters(cadena, specialcharacters){ 

   //eliminamos uno por uno
   for (var i = 0; i < specialcharacters.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialcharacters[i], 'gi'), '');
   }   

   return cadena;
}

//lo pasa a minúsculas
function toLowerCase(cadena) {
    cadena = cadena.toLowerCase();
    return cadena;
}

//remplasa dashes "-" del string por espacios
function replaceDashes( cadena ) {
   cadena = cadena.replace(/-/gi," ");
   cadena = cadena.replace(/_/gi," ");
   return cadena;
}


//borra espacios del string
function removeDashesSpaces( cadena ) {
   cadena = cadena.replace(/-/gi,"");
   cadena = cadena.replace(/_/gi,"");
   cadena = cadena.replace(/ /gi,"");
   return cadena;
}

// Quitamos espacios y los sustituimos por - porque nos gusta mas asi
function replaceSpaces( cadena ) {
   cadena = cadena.replace(/ /gi,"-");
   return cadena;
}

//quita acentos y ñ y lo pasa a minúsculas
function cleanAcentos( cadena ) {

   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();

   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   return cadena;
}


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
     * VALIDACIONES FORMULARIO
    */
    
    //KEY UP INPT (al ir escribiendo):
    //type text, si encuentra numeros o caracteres raros devuelve la cruz de error
    $(document).on('keyup', 'input[type=text]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');

        //si hay números devuelve error
        if ( areThereAny(valor, numeros+specialcharacters) || valor=='' ) {
            $(icon).addClass('icon-input-error');    
        } else {
            $(icon).removeClass('icon-input-error');    
        }
    });

    //si encuentra letras o caracteres raros te lo indica
    $(document).on('keyup', 'input[type=number]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');

        //si hay letras o caracteres raro devuelve error
        if ( areThereAny(valor, letras+specialcharacters) || valor=='' ) {
            $(icon).addClass('icon-input-error');    
        } else {
            $(icon).removeClass('icon-input-error');    
        }
    });

    //si la fecha es mayor a la de hoy, es inválida te lo indica
    $(document).on('keyup', 'input[type=date]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');
        var date = new Date(valor);
        var today = new Date();

        //si es la fecha de hoy, o la fecha de ingreso es mayor a 60 años o está vacía es nula
        if ( today-date < 0 || today-date > 2209034488072 || valor == '' || valor == '0000-00-00' ) {
            $(icon).addClass('icon-input-error');
        } else {
            $(icon).removeClass('icon-input-error');    
        }
    });

    //FOCUS OUT INPUT
    //input text
    $(document).on('focusout', 'input[type=text]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');

        valor = cleanedSpecialCharacters(valor,specialcharacters);
        
        valor = cleanedOthers(valor,numeros);
        valor = replaceDashes(valor);
        
        $(this).val(valor);

        //si hay números devuelve error
        if ( areThereAny(valor, numeros+specialcharacters) || valor == '' || valor.length < 3) {
            $(icon).addClass('icon-input-error');
            $(msj).fadeIn();
            
        } else {
            $(icon).removeClass('icon-input-error');    
            $(icon).addClass('icon-input-sucess');    
            $(msj).fadeOut();
           
        }
    });

    //input type numbers
    $(document).on('focusout', 'input[type=number]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');

        valor = cleanedOthers(valor,letras);
       
        valor = cleanedSpecialCharacters(valor,specialcharacters)
        
        $(this).val(valor);

        //ver si pasa las pruebas de longitud, por defecto no las pasa se prueba en los distintos campos de número
        var longitud = true;
        //campo dni
        if ( this.name == 'dni' && valor.length == 8 ) {
            longitud = false;
        }
        //campo cuil o cuit
        if ( ( this.name == 'cuil' || this.name == 'cuit') && valor.length == 11 ) {
            longitud = false;
        }
        //campo tel
        if ( this.name == 'member_tel' && valor.length >= 8 ) {
            longitud = false;
        }
        //campo cel
        if ( this.name == 'member_cellphone' && valor.length >= 10 && valor.indexOf('15') != -1 ) {
            longitud = false;
        }
        //campo alturas
        if ( ( this.name == 'job_number' || this.name == 'member_number') && valor != '' ) {
            longitud = false;
        }
        
        //si hay letras o no pasa alguna de las validaciones devuelve error
        if ( longitud || areThereAny(valor, letras+specialcharacters) ) {
            $(icon).addClass('icon-input-error');
            $(msj).fadeIn();
            
        } else {
            $(icon).removeClass('icon-input-error');    
            $(icon).addClass('icon-input-sucess');    
            $(msj).fadeOut();

            
        }
    });

    //fecha focus out
    $(document).on('focusout', 'input[type=date]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');
        var date = new Date(valor);
        var today = new Date();

        //si es la fecha de hoy, o la fecha de ingreso es mayor a 60 años o está vacía es nula
        if ( today-date < 0 || today-date > 2209034488072 || valor == '' || valor == '0000-00-00' ) {
            $(icon).addClass('icon-input-error');
            $(msj).fadeIn();
            
        } else {
            $(icon).removeClass('icon-input-error');    
            $(icon).addClass('icon-input-sucess');    
            $(msj).fadeOut();  
            
        }
    });

    $(document).on('focusout', 'input[type=email]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');

        valor = cleanedSpecialCharacters(valor,'#$^&%*()[]\'\"\/{}:;<>,');
        //remueve algún espacio si hay
        valor = valor.replace(/ /gi,"");
        
        $(this).val(valor);

        //si hay números devuelve error
        if ( valor == '' || valor.length < 8 || valor.indexOf('@') == -1 || valor.indexOf('@')  == 0 ) {
            $(icon).addClass('icon-input-error');
            $(msj).fadeIn();
        } else {
            $(icon).removeClass('icon-input-error');    
            $(icon).addClass('icon-input-sucess');    
            $(msj).fadeOut();
        }
    });


    /*
     * SUBMIT FORMULARIO 1
    */    

    $(document).on('submit', '#first-form', function( e ) {
        e.preventDefault();
        
        //si hay un error el formulario no se envia
        var error = $('.icon-input-error');
        if (error.length != 0 ) {
            return false;
        }

       
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
                $(loader).fadeIn();
            },
            success: function ( response ) {
                //console.log(response);
                $(loader).fadeOut();
                //error 1: no existe el cuil
                //error 2: no ingresaron ningún cuil
                //error 3: error servidor
                //error 4: ya existe el cuil

                //si responde con errores:
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
                    setTimeout(function(){
                        location.href = baseUrl + '/error';
                    }, 1000);
                    
                } else if ( response == 'error-4' ) {
                    console.log('El cuil ingresado ya esta registrado');
                    //el cuil no existe, te lleva a la página de error del usuario
                    setTimeout(function(){
                        location.href = baseUrl + '/error';
                    }, 1000);
                } else {
                                        
	                if (response == 'ok') {
	                    location.href = baseUrl + '/bienvenidos';
	                } else {
	                    location.href = baseUrl + '/error';
	                }
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
        //si hay un error el formulario no se envia
        var error2 = $('.icon-input-error');
        if (error2.length != 0) {
            return false;
        }

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
                $(loader).fadeIn();
            },
            success: function ( response ) {
                //console.log(response);
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
