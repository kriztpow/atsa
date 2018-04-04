/*
* Funciones: del modulo de suscriptores: 
* 
* 
*/

$(document).ready(function(){

	/*
	 * NUMERACION CELDAS
	*/

	
	function numeracionCeldas( index, el ) {
		var numeracion = index+1
		$(el).text(numeracion);
	}

	$('.numeracion-rows').each(function( index, value ){
		numeracionCeldas(index, this)
	});

	$( '#export_excel' ).click(function( event ) {
		$("#datos_a_enviar").val( $("<div>").append( $('.tabla-suscriptores').eq(0).clone()).html());
		$("#FormularioExportacion").submit();
	});//click boton
	//imprime tabla
	$( '#print_tabla' ).click(function( event ) {
		var tablaAImprimir = $('.tabla-contactos');
		var ventimp = window.open(' ', 'popimpr');
		  ventimp.document.write( tablaAImprimir[0].innerHTML );
		  ventimp.document.close();
		  ventimp.print( );
		  ventimp.close();
	});


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

