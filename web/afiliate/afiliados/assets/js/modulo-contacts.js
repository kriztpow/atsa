/*
* Funciones: del modulo de suscriptores: 
* 
* 
*/

function numeracionCeldas( index, el ) {
		var numeracion = index+1
		$(el).text(numeracion);
	}

$(document).ready(function(){

	/*
	 * NUMERACION CELDAS
	*/

	$('.numeracion-rows').each(function( index, value ){
		numeracionCeldas(index, this)
	});

	$( '#export_excel' ).click(function( event ) {
		$("#datos_a_enviar").val( $("<div>").append( $('.tabla-suscriptores').eq(0).clone()).html());
		$("#FormularioExportacion").submit();
	});//click boton




	//borrar usuario
	$(document).on('click','.del-user',function(){
		var id = $(this).attr('data-id');
		
		if ( confirm( '¿Está seguro de querer BORRAR este afiliado?' ) ) {

			$.ajax( {
		        type: 'POST',
		        url: ajaxFunctionDir + '/delete-suscriptor.php',
		        data: {
		            id: id,
		        },
		        beforeSend: function() {
		            console.log('borrando');
		        },
		        success: function ( response ) {
	                console.log(response);
		            if (response == 'deleted') {
						location.reload(true);
		            }
		            else {
		            	$('.contacts-container').append(response)
		            }
		        },
		        error: function ( ) {
		            console.log('error');
		        },
		    });//cierre ajax
		}
	});
	
	var currentPage = 1;

	//cargar mas afiliados
	$(document).on('click', '.load-more-btn', function() {
		var status = $(this).attr('data-afiliado-status');
		var cantPost = $(this).attr('data-cant-post');
		var orden = $(this).attr('data-post-orden');
		var contenedor = $('.row-usuario');

		$.ajax( {
	        type: 'POST',
	        url: ajaxFunctionDir + '/new-query.php',
	        data: {
	            status: status,
	            cantPost: cantPost,
	            orden: orden,
	            page: currentPage+1,
	        },
	        success: function ( response ) {
                //console.log(response);
                if (response) {
                	//insertamos la respuesta
	                $(contenedor).append(response);
	                //sumamos una página
	                currentPage++;
	                //armamos nueva numeracion
	                $('.numeracion-rows').each(function( index, value ){
						numeracionCeldas(index, this)
					});	
                } else {
                	$('.contacts-container').append($('<div style="font-style:italic;font-size:80%;color:red;">No hay más afiliados que cargar</div>'));
                }

	        },
	        error: function ( ) {
	            console.log('error');
	        },
	    });//cierre ajax
	});

	//cambiar el orden desde el front
	$(document).on('change', '.orden-suscriptores', function() {
		var orden = $(this).val();
		var contenedor = $('.row-usuario');
		var rows = $('.row-usuario tr');

		if ( orden == 'asc' ) {

			for (var i = rows.length - 1; i >= 0; i--) {
				
				$(contenedor).append( $(rows[i]) );

			}
		} else {
			for (var i = 0; i <rows.length; i++) {
				
				$(contenedor).prepend( $(rows[i]) );

			}
		}
	});

	//cambiar el numero a mostrar
	$(document).on('change', '.select-mostrar', function() {
		var status = $(this).attr('data-afiliado-status');
		var cantPost = $(this).val();
		var orden = $(this).attr('data-post-orden');
		var contenedor = $('.row-usuario');
		
		$.ajax( {
	        type: 'POST',
	        url: ajaxFunctionDir + '/new-query.php',
	        data: {
	            status: status,
	            cantPost: currentPage*cantPost,
	            orden: orden,
	        },
	        success: function ( response ) {
                //console.log(response);
                $('.load-more-btn').attr('data-cant-post',cantPost)
            	//borramos primero lo que hay 
            	$(contenedor).empty();
            	//insertamos la respuesta reordenada
                $(contenedor).append(response);
                //armamos nueva numeracion
                $('.numeracion-rows').each(function( index, value ){
					numeracionCeldas(index, this)
				});	
                

	        },
	        error: function ( ) {
	            console.log('error');
	        },
	    });//cierre ajax
	});
		
	$(document).on('mouseenter', '.member_notas', function () {
		
		var contenedor = $(this).closest('.member_notas_wrapper');
		var item = $(contenedor).find('.member_notas_full')
		$(item).fadeIn()
	});
	$(document).on('mouseleave', '.member_notas', function() {
		var contenedor = $(this).closest('.member_notas_wrapper');
		var item = $(contenedor).find('.member_notas_full');
		$(item).fadeOut()
	});

	//cambia el estado del afiliado en la base de datos
	$(document).on('change', '.change-status', function() {
		var id = $(this).attr('data-id');
		var status = $(this).val();
		
		$.ajax( {
	        type: 'POST',
	        url: ajaxFunctionDir + '/update-status-suscriptor.php',
	        data: {
	            id: id,
	            status: status,
	        },
	        success: function ( response ) {
                console.log(response);
	        },
	        error: function ( ) {
	            console.log('error');
	        },
	    });//cierre ajax
		
	});	

});


/*
 * FORMULARIO AFILIADO INDIVIDUAL
*/
var contenedorFamiliares = $('.inputs-grupo-familiar tr');
var familiares = contenedorFamiliares.length;
if (familiares === 0) {
	$('.inputs-grupo-familiar').append( $('<tr class="empty-row no-print"><td colspan=8>Agregar grupo familiar haciendo clic en el boton rojo</td></tr>') );
}


function addFamiliar() {
	if (familiares==0) {
		$('.inputs-grupo-familiar').empty();
	}
	$.ajax( {
        type: 'POST',
        url: ajaxFunctionDir + '/ajax-nuevo-familiar.php',
        data: {
            numero: familiares+1,
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

$(document).ready(function(){
	//agregar nuevo familiar
	$(document).on('click', '.btn-add-family', function(){
		addFamiliar();
	});
	

	//borrar familiar
	$(document).on('click', '.del-pariente', function(){
		$(this).closest('tr').remove();
	});
	
	
	//imprimir formulario
   	$( '.print_page' ).click(function( event ) {
   		
   		//primero hay que limpiar los input type date si están vacios
   		$('input[type=date]').each(function(){
   			if( $(this).val() == '' ) {
   				this.type = 'text';
   				$(this).css('border','1px solid #333');	
   			}
   			
   		});
   		
        //finalmente estamos listos para imprimir:
		window.print();

	});//imprimir formulario

   	/*
	* imprimir a pdf
   	*/

   	$( '#print_pdf' ).click(function( event ) {
		$("#datos_a_enviar").val( $("<div>").append( $('.wrapper-impresion').eq(0).clone()).html());
		$("#FormularioExportacion").submit();
	});//click boton



   	//guardar afiliado
   	$(document).on('submit', '#afiliado_form', function( e ) {
        e.preventDefault();

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
	        		pariente.afiliado_pariente_discapacidad = 'on';
	        	}
	        	//lo summamos al array a pasar a bd
	        	parientesObj.parientes.push(pariente);
	        }//for
    
       		formData.append('afiliado_parientes', JSON.stringify(parientesObj.parientes) );
        }//if

        $.ajax( {
	        type: 'POST',
	        url: ajaxFunctionDir + '/update-afiliado.php',
	        data: formData,
	        processData: false,
	        contentType: false,
	        cache: false,
	        success: function ( response ) {
	            console.log(response);
	            if (response == 'cuil' ) {
	            	alert('El CUIL no puede estar vacío');
	            } else if (response == 'cuil-duplicado' ) {
	            	alert('Este CUIL ya existe en la Base de datos');
	            }else {
		            $('.msj-error').text(response);
		            //finalmente, si el contacto es nuevo refresca la pagina
		            if ( $('.input_member_id').val() == '' ) {
		            	href = window.location.href;
		            	window.location.href = href+'&slug='+$('.input-afiliado-cuil').val();
		            }
	            }
	        },
	        error: function ( ) {
	            console.log('error');
	        },
	    });//cierre ajax
        
   	});//guardar afiliado

});//on ready