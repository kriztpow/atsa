/**
 * File script.js
 *
 * @required jQuery
 * @ver 1.0
 --------------------------------------------------------------
>>> TABLE OF CONTENTS:
1.0 FORMULARIO
--------------------------------------------------------------*/

var baseUrl = 'https://' + window.location.host + '/afiliate';
var ajaxFileUrl = baseUrl + '/inc/ajax.php';
var specialcharacters = '@#$^&%*()+=[]\'\"\/{}|:;¡!¿?<>,.';
var numeros = '0123456789';
var letras = 'abcdefghijklmnñopqrstuvwxyz';
var contenedorFamiliares = $('.inputs-grupo-familiar tr');
var familiares = contenedorFamiliares.length;//esto carga el template de familiares cuando el afiliado completa sus datos
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
        if ( location.href.indexOf('completar-datos') != -1 ) {
            return true;
        }
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

    //input name tel
    $(document).on('focusout', 'input[name=member_tel]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');
        var longitud = true;

        valor = cleanedOthers(valor,letras);
        valor = cleanedSpecialCharacters(valor,specialcharacters)
                
        $(this).val(valor);

        if ( valor.length >= 8 ) {
            longitud = false;
        } 

        //si no hay ningún numero pero en el celular si, entonces se perdona
        /*if ( $('input[name=member_cellphone]').val() != '' ) {
            longitud = false;
        }*/
        if ( $('input[name=member_cellphone]').attr('data-validate') == 'true' ) {
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
            //pone el validate on
            $(this).attr('data-validate', 'true');
        }
    });

    //input name cellphone
    $(document).on('focusout', 'input[name=member_cellphone]', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');
        var longitud = true;

        valor = cleanedOthers(valor,letras);
        valor = cleanedSpecialCharacters(valor,specialcharacters)
                
        $(this).val(valor);
        
        if ( valor.length >= 10 && valor.indexOf('15') != -1 ) {
            longitud = false;
        } 
        
        //si no hay ningún numero pero en el celular si, entonces se perdona
        /*if ( $('input[name=member_tel]').val() != '' ) {
            longitud = false;
        }*/
        if ( $('input[name=member_tel]').attr('data-validate') == 'true' ) {
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
            //pone el validate on
            $(this).attr('data-validate', 'true');
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

    $(document).on('change', 'select', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');

        //si hay números devuelve error
        if ( valor == '' || valor == null ) {
            $(icon).addClass('icon-input-error');
            $(msj).fadeIn();
        } else {
            $(icon).removeClass('icon-input-error');    
            $(icon).addClass('icon-input-sucess');    
            $(msj).fadeOut();
        }
    });

    $(document).on('focusout', 'select', function() {
        var valor = $(this).val();
        var contenedor = $(this).closest('.form-group');
        var icon = $(contenedor).find('.icon-input');
        var msj = $(contenedor).find('.msj-error-input');

        //si hay números devuelve error
        if ( valor == '' || valor == null ) {
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
        var contenedorPagina = $('.inner-wrapper');
        //si hay un error el formulario no se envia
        var error = $('.icon-input-error');
        if (error.length != 0 ) {
            if (error.length > 1) {
                alert('Por favor, corrija los errores marcados');
                return false;
            }
            if ( $('input[name=member_cellphone]').attr('data-validate') != 'true' ) {

                if ( $('input[name=member_tel]').attr('data-validate') != 'true' ) {
                    alert('Por favor, corrija los errores marcados');
                    return false;
                }
            }
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
                    //sino recibe respuesta, evidentemente hubo un error
                    console.log(response);
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
                    //el cuil ya existe en la base de datos, te lleva a la página de error del usuario
                    setTimeout(function(){
                        location.href = baseUrl + '/error';
                    }, 1000);
                } else {
                    /*
	                if (response == 'ok') {
	                    location.href = baseUrl + '/bienvenidos';
	                } else {
	                    location.href = baseUrl + '/error';
	                }*/
                    //si no hay error de ningún tipo y no está vacio carga la bienvenida con el link para autocompletar
                    if ( response ) {
                        contenedorPagina.empty();
                        contenedorPagina.append(response)
                    }

                }  
            },
            error: function ( ) {
                console.log('error');
            },
    	});//cierre ajax

    });//submit formulario 1

    /*
     * SUBMIT FORMULARIO 2 - EL QUE COMPLETA EL AFILIADO
    */    
    $(document).on('submit', '#afiliado_form', function( e ) {
        e.preventDefault();
        var loader = $('.loader');

        //1. VALIDACIONES FECHAS
        //fecha de nacimiento:
        var fechaNacimiento = $('input[name=afiliado_fecha_nacimiento]');
        //fecha de afiliacion:
        var fechaAfiliacion = $('input[afiliado_fecha_afiliacion]');
        //fecha de ingreso Sindicato:
        var fechaIngresoSindicato = $('input[name=afiliado_fecha_ingreso_sindicato]');
        //fecha de ingreso empresa:
        var fechaIngresoEmpresa = $('input[name=afiliado_fecha_ingreso]');
        //fecha de hoy
        var today = new Date();

        //validaciones:
        var dateNacimiento = new Date( $(fechaNacimiento).val() );
        if ( dateNacimiento >= today || today.getFullYear() - dateNacimiento.getFullYear() > 65 || today.getFullYear() - dateNacimiento.getFullYear() < 17 ) {
            
            $(fechaNacimiento).css({
                'border-color':'red',
                'color':'red',
            });
            $('.msj-error').text('Error en los campos');
            return;
        } else {
            $(fechaNacimiento).css({
                'border-color':'inherit',
                'color':'inherit',
            });
        }
        
        var dateAfiliacion = new Date( $(fechaAfiliacion).val() );
        if ( today.getFullYear() - dateAfiliacion.getFullYear() > 65 ) {
            
            $(fechaAfiliacion).css({
                'border-color':'red',
                'color':'red',
            });
            $('.msj-error').text('Error en los campos');
            return;
        }

        var dateIngresoSindicato = new Date( $(fechaIngresoSindicato).val() );
        if ( today.getFullYear() - dateIngresoSindicato.getFullYear() > 65 ) {
            
            $(fechaIngresoSindicato).css({
                'border-color':'red',
                'color':'red',
            });
            $('.msj-error').text('Error en los campos');
            return;
        }

        var dateIngresoEmpresa = new Date( $(fechaIngresoEmpresa).val() );
        if ( dateIngresoEmpresa > today || today.getFullYear() - dateIngresoEmpresa.getFullYear() > 60 ) {
            
            $(fechaIngresoEmpresa).css({
                'border-color':'red',
                'color':'red',
            });
            $('.msj-error').text('Error en los campos');
            return;
        }


        //2. agrego los parientes si existen
        var parientesObj = {'parientes': [] };
        var parientes = $('.inputs-grupo-familiar tr');

        //creo la data del formulario y le agrego los parientes
        formData = new FormData( this );

        if ( !$(parientes[0]).hasClass('empty-row') ) {

            for (var i = 0; i < parientes.length; i++) {
                var pariente = {

                    'afiliado_pariente_parentesco' : $(parientes[i]).find('.input-afiliado-pariente-parentesco').val(),
                    'afiliado_pariente_nombre' : $(parientes[i]).find('.input-afiliado-pariente-nombre').val(),
                    'afiliado_pariente_nacionalidad' : $(parientes[i]).find('.input-afiliado-pariente-nacionalidad').val(),
                    'afiliado_pariente_nacimiento' : $(parientes[i]).find('.input-afiliado-pariente-nacimiento').val(),
                    'afiliado_pariente_dni' : $(parientes[i]).find('.input-afiliado-pariente-dni').val(),
                    'afiliado_pariente_sexo' : $(parientes[i]).find('.input-afiliado-pariente-sexo').val(),
                    'afiliado_pariente_discapacidad' : '0',
                }

                if ( $(parientes[i]).find('.input-afiliado-pariente-discapacidad').is(':checked') ) {
                    pariente.afiliado_pariente_discapacidad = '1';
                }
                //lo summamos al array a pasar a bd
                parientesObj.parientes.push(pariente);
            }//for
    
            formData.append('afiliado_parientes', JSON.stringify(parientesObj.parientes) );
        }//if
        
        formData.append('function','afiliado_form');
        $.ajax( {
            type: 'POST',
            url: ajaxFileUrl,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $(loader).fadeIn();
            },
            success: function ( response ) {
                console.log(response);
                $(loader).fadeOut();
                if (response == 'ok') {
                    location.href = baseUrl;
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax

    });//submit formulario 2

    //agregar nuevo familiar
    $(document).on('click', '.btn-add-family', function(){
        addFamiliar();
    });

    //borrar familiar
    $(document).on('click', '.del-pariente', function(){
        $(this).closest('tr').remove();
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

function addFamiliar() {
    if (familiares==0) {
        $('.inputs-grupo-familiar').empty();
    }
    $.ajax( {
        type: 'POST',
        url: ajaxFileUrl,
        data: {
            numero: familiares+1,
            function: 'familiares',
        },
        success: function ( response ) {
            //console.log(response);
            $('.inputs-grupo-familiar').append(response);
            familiares++;
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax

}
