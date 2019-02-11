<?php
/*
 * Archivo de imagenes / inserta imagen nueva
 * versión reducida para el editor TinyMCE
 * Since 3.0
 * 
*/
require_once("../inc/functions.php");
load_module( 'medios' );

?>

<article id="browser-dialog">
	<div class="container">


    
	</div><!-- //.container-fluid -->
</article>

<script src="assets/js/modulo-medios.js"></script>
<script type="text/javascript" language="javascript">

$( function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
  } );

var destacado = false;

//al hacer clic en los medios la url se inserta en el input
$(document).on('click','li.medio',function(){
	item_url = $(this).find('img').data("src");

	if ( $('.ui-dialog-buttonset button').hasClass('imagenes-galerias') ) {
		//puede haber muchos seleccionados pero al deseleccionarlos hay que borrarlos del input para que no se incluyan luego
		//si ya tiene la clase y estaba seleccionada hay que deseleccionarla y luego borrarla del input
		if ( $(this).hasClass('image-selected') ) {
			$(this).removeClass('image-selected');
			$('.previewAtachment').each(function(){
			if ($(this).val() == item_url) {
				$(this).remove()
			}
		});
		} else {
			//sino tiene la clase es más facil, solo hay que agregarla
			$(this).addClass('image-selected');
			var html = '<input type="hidden" class="previewAtachment" name="previewAtachment" value="'+item_url+'">';
		var node = $(html);
		$('#libreria').append(node);
		}

		//o puede haber una sola eleccion
	} else {
		//destacado indica que ya algo seleccionado entonces hay que encontrarlo y deseleccionarlo
	  if (destacado) {
	  	$.each( $('li.medio'), function(){
	  		$(this).removeClass('image-selected');
	  	});
	  	//se borra la que antes estaba seleccionada
	  	$('.previewAtachment').remove();
	  }
	  //una vez todos seleccionados se selecciona la adecuada
	  $(this).toggleClass('image-selected');
	  //y a continuación se indica que hay algo destacado
	  destacado = true;
	  //se agrega al input para que pueda asignarse luego
		var html = '<input type="hidden" class="previewAtachment" name="previewAtachment" value="'+item_url+'">';
		var node = $(html);
		$('#libreria').append(node);
	}
});

</script>