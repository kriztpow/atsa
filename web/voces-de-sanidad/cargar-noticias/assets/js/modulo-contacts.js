/*
* Funciones: del modulo de suscriptores: 
* 
* 
*/

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