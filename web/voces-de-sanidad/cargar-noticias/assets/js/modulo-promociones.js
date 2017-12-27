$(document).ready(function(){

	/*
	* Save button
	*/	

	$('#popUpActive').click(function( event ){
		promoActivate = 0;
		mensaje = 'Promoción desactivada';

		if ( this.checked ) {
			promoActivate = 1;
			mensaje = 'Promoción activada';
		}

		$.ajax( {
				type: 'POST',
				url: ajaxFunctionDir + '/activate-promo.php',
				data: {
					popup: promoActivate,
				},
				success: function ( response ) {
					if ( response == 'ok') {
						$('.error-tag').text(mensaje);
					} else {
						$('.error-tag').text('hubo un error');
					}
				},
				error: function ( ) {
					console.log('error');
				},
		});//cierre ajax

	})//click save

	$(document).on('click','.up-new-promo',function(){
		$( "#dialog" ).dialog({
			title: 'Biblioteca de imágenes',
			autoOpen: false,
			appendTo: '.contenido-modulo',
			height: 600,
			width:768,
			modal: true,
			buttons: [
		    {
		    	text: "Cerrar",
		      	class: 'btn btn-primary',
		      	click: function() {
		        $( this ).dialog( "close" );
		      }
		    },
		    {
		    	text: 'Insertar imagen',
		    	class: 'btn btn-success',
		    	click: function () {
		    		//se toma el nombre de la imagen, siempre la primera porque es UNA imagen destacada
		    		newImage = $('.previewAtachment')[0];
		    		newImage =  $(newImage).val();
		    		if ( newImage == '' ) {
		    			$( this ).dialog( "close" );
		    			return;
		    		} else {
		    			checkPostType( newImage, 'promo' );
		    		}
		    		var link = uploadsDir + '/' + newImage;
		    		$('#popupImg').attr('src',link);
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( templatesDir + '/media-browser.php' );

	});

});//ready	

