/*
 * Script del soft con las funciones de todos los módulos salvo editar noticias
 * principal tarea: cargar los módulos por ajax y manejar los botones gral
 * Since 4.0
 * Es el único script que siempre esta
 * 
 * INDICE
 * 1. Funciones generales reutilizables
 * 2. logout (index)
 * 3. Nuevo usuario
 * 4. change password
 * 5. loop de sliders
 * 6. editar slider
 * 7. loop de noticias
 * 8. Torneos y eventos
 * 9. Convenios
 * 10. Leyes
 * 11. staff
 * 12. hoteles
 * 13. cursos
 * 14. beneficios
 * 15. page edit
 * 16. preguntas
 * 17. programas de prevencion
 * 18. home page
 * 19. vivo page
 * 20. peticion
 * 21. contenido delegados
 * 22. mujeres que hicieron historia
 * 23. viajes
*/

function scrollHaciaArriba() {
$("html, body").animate({
            scrollTop: 0
        }, "slow");
}
function getCleanedString(cadena){
   // Definimos los caracteres que queremos eliminar
   var specialChars = "!@#$^&%*()+=[]'\"\/{}|:;¡¿<>?,.";

   // Los eliminamos todos
   for (var i = 0; i < specialChars.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
   }   

   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();

   // Quitamos espacios y los sustituimos por - porque nos gusta mas asi
   cadena = cadena.replace(/ /g,"-");

   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   return cadena;
}
	function getCleanedStringPLUS(cadena,specialChars){
   // Definimos los caracteres que queremos eliminar

   // Los eliminamos todos
   for (var i = 0; i < specialChars.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
   }   

   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();

   // Quitamos espacios y los sustituimos por - porque nos gusta mas asi
   cadena = cadena.replace(/ /g,"-");

   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   return cadena;
}

$(document).ready(function() {

	//logout
	$('#logout').click(function(event){
		event.preventDefault();
				
		$.ajax( {
			type: 'POST',
			url: 'inc/templates/logout.php',
            //funcion antes de enviar
            beforeSend: function() {
            },
			success: function ( response ) {
				window.setTimeout('location.reload()', 1000);
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax
	});
	
});//document.ready



/*
* NUEVO USUARIO
*/


$(document).ready(function() {

	$('#register').submit(function(event){
			event.preventDefault();
			var formulario = this;
			var data = $(this).serialize();
			var msj = $('.error-tag');

			$.ajax( {
				type: 'POST',
				url: 'inc/register.php',
				data: data,
				success: function ( response ) {
					if ( response == 'existe') {
						msj.html('ya hay un usuario con ese nombre');
					} else if (response == 'exito') {
						msj.html('el usuario ya fue creado, puede iniciar sesión')
						//window.setTimeout('location.href = index.php', 2000);
					} else {
						msj.html('hubo un error, intente más tarde');
					}
				},
				error: function ( error ) {
					console.log(error);
				},
			});//cierre ajax
		});//submit

})//ready

/*
* CHANGE PASSWORD
*/

$(document).ready(function() {

	$('#password_form').submit(function(event){
			event.preventDefault();

			var formulario = this;
			var data = $(this).serialize();
			var msj = $('.error-tag');

			$.ajax( {
				type: 'POST',
				url: 'inc/password.php',
				data: data,
				success: function ( response ) {
					if ( response == 'error') {
						msj.html('Usuario o contraseña incorrecta');
					} else if (response == 'exito') {
						msj.html('el cambio fue echo exitosamente');
						//window.setTimeout('location.href = index.php', 2000);
					} else {
						msj.html('hubo un error, intente más tarde');
					}
				},
				error: function ( error ) {
					console.log(error);
				},
			});//cierre ajax
		});//submit

})//ready


/*
* EDITAR SLIDER
*/

$(document).ready(function (){
	$('#myModalLabel').html('Editar Slider');
	
	//Sube nueva imagen para crear nuevo slider
	$('#imagen_destacada_wrapper').on('click','#new-item',function(){
		var ubicacion = $('.sliders-wrapper').attr('id');

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
		      	class: 'btn btn-default',
		      	click: function() {
		        $( this ).dialog( "close" );
		      }
		    },
		    {
		    	text: 'Insertar imagen',
		    	class: 'btn btn-success',
		    	click: function () {
		    		newImage = $('.previewAtachment').val();
		    		crearSliderBD( newImage, ubicacion )
		    		//cierra dialogo de carga
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});

		$( "#dialog" ).dialog( 'open' )
		.load( 'inc/templates/media-browser.php' );

	});//Sube nueva imagen para crear nuevo slider


	//esta funcion crea nuevo slider en base de datos si la imagen se cargó con exito, necesita el nombre de la imagen y la ubicación para guardar el slider
	function crearSliderBD( sliderImagen, ubicacion ) {
		var contenedor = $('.sliders-wrapper');
			if ( sliderImagen != '') {
				var urlimg = 'https://' + window.location.host + '/uploads/images/' + sliderImagen;
				$.ajax( {
		            type: 'POST',
		            url: 'inc/save-slider-item.php',
		            data: {
		                sliderImagen: sliderImagen,
		                new: 'true',
		                ubicacion: ubicacion,
		            },
		            success: function ( response ) {
		            	$( '.load-ajax' ).fadeOut();
		            	var html = '<li class="item-slider" id="'+response+'"><h3>Item Nuevo Creado</h3><div class="row"><div class="col-sm-6"><form id="edit_slider_imagen" name="edit_slider_imagen" data-sliderID="'+response+'" method="POST" ><div class="group-form"><input type="hidden" name="slider_imagen" value="'+sliderImagen+'"><img src="'+urlimg+'" class="img-responsive"></div><div class="group-form"><div class="group-form recargar-btn-wrapper"><button data-sliderID="'+response+'" type="button" class="btn btn-info btn-xs">Cargar nueva foto</button></div></div></form></div><div class="col-sm-6"><div class="group-form input-sliders"><label for="slider_titulo">Titulo a mostrar</label><input type="text" name="slider_titulo"></div><div class="group-form input-sliders"><label for="sliderLink">URL</label><input type="text" name="sliderLink"></div><div class="group-form input-sliders"><label for="slider_textoLink-new">Texto boton</label><input type="text" name="slider_textoLink-new" id="slider_textoLink-new" value="Leer más"></div></div></div><div class="row"><div class="col-sm-6"><div class="group-form input-sliders"><label for="slider_texto">Texto slider</label><textarea id="slider_texto" name="slider_texto"></textarea></div></div><div class="col-sm-6"><hr><div class="row"><div class="col-sm-5"><div class="group-form input-sliders"><label for="slider_orden">Orden de ubicación</label><input type="number" name="slider_orden" id="slider_orden"></div></div><div class="col-sm-7"><div class="group-form input-sliders borrar-guardar-btns"><button data-id="'+response+'" type="button" class="btn btn-warning btn-guardar">Guardar item</button><button data-id="'+response+'" type="button" class="btn btn-danger btn-xs btn-borrar">Borrar item</button><span class="msj-guardar"></span></div></div></div></div></div></li>';
						var node = $(html)
						contenedor.prepend(node);
		            },
		            error: function ( ) {
		                console.log('error');
		            },
		        });//cierre ajax
				
			}
		}//crearSliderIMG()

	//clic en guardar cambios item
	$(document).on('click', '.btn-guardar', function(){
		var sliderId = $(this).attr('data-id');
		var item = '#'+sliderId
		var ID = $(item);
		var texto = ID.find('textarea').val();
		var imagen = ID.find('input[type=hidden]').val()
		var titulo = $(ID.find('input')[1]).val();
		var url = $(ID.find('input')[2]).val()
		var textoBtn = $(ID.find('input')[3]).val()
		var orden = $(ID.find('input')[4]).val();
		var ubicacion = $('.sliders-wrapper').attr('id');
		var msj = ID.find('.msj-guardar');
		if (orden == '') {
			orden = 0;
			$(ID.find('input')[4]).val(orden);
		}
		if ( textoBtn == '') {
			textoBtn = 'Leer más';
			$(ID.find('input')[3]).val(textoBtn);
		}
		$.ajax( {
	            type: 'POST',
	            url: 'inc/save-slider-item.php',
	            data: {
	                sliderId: sliderId,
	                texto: texto,
	                sliderImagen: imagen,
	                titulo: titulo,
	                url: url,
	                textoBtn: textoBtn,
	                orden: orden,
	                ubicacion: ubicacion,
	                new: 'false',
	            },
	            beforeSend: function() {
	            	msj.html('guardando, espere');
            	},
	            success: function ( response ) {
	            	if (response == 'saved') {
	            	//borra el slider del front
	                	msj.html('guardado');
	                	ID.find('.msj-guardar-imagen').empty();
	                } else {
	                	msj.html('error');
	                }
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax

	});//click btn-guardar
	
		
	//clic en borrar cambios
	$('body', this).on('click', '.btn-borrar', function(){
		var sliderId = $(this).attr('data-id');
		var contenedor = '#'+sliderId;
		
		if ( confirm( '¿Está seguro de querer BORRAR este item del slider?' ) ) {
			$.ajax( {
	            type: 'POST',
	            url: 'inc/delete-slider-item.php',
	            data: {
	                sliderId: sliderId,
	            },
	            success: function ( response ) {
	            	if (response == 'deleted') {
	            	//borra el slider del front
	                	$(contenedor).remove()
	                }
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
		}//if

	});//click btn-borrar

	//modificar la foto
	$(document).on('click', '.btn-recargar', function(){
		var sliderId = $(this).attr('data-sliderid');
		var item = '#'+sliderId
		var ID = $(item);
		var InputImagen = ID.find('input[type=hidden]');
		var ImagenMostrar = ID.find('img');
		var msjExito = 'No te olvides de guardar item'
		var msj = ID.find('.msj-guardar-imagen');
		var ImagenBiblioteca = '';

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
		      	class: 'btn btn-default',
		      	click: function() {
		        $( this ).dialog( "close" );
		      }
		    },
		    {
		    	text: 'Insertar imagen',
		    	class: 'btn btn-success',
		    	click: function () {
		    		newImage = $('.previewAtachment').val();
					msj.html(msjExito);
		    		InputImagen.val(newImage);
		    		ImagenMostrar.attr('src', '/uploads/images/'+newImage);
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});

		$( "#dialog" ).dialog( 'open' )
		.load( 'inc/templates/media-browser.php' );

	});//modificar la foto

});//ready

/*
* LOOP NOTICIAS
*/

$(document).ready(myFunctionNoticias);//ready
var currentPage = 2;

function myFunctionNoticias(){
$('#myModalLabel').html('Noticias');

//cargar más ajax


$('#load-more').click(function( event ){
    event.preventDefault();

    var contenedorNews = $('.loop-noticias-backend');
    var contenedorAjax = $('.loading-news-ajax');
    var actualCategoria = $('#post_categoria').val();
    if (actualCategoria == 'todas') {
    	actualCategoria = 'none';
    }
    $.ajax( {
        type: 'POST',
        url: 'inc/load-more-news.php',
        data: {
            page: currentPage,
            categoria: actualCategoria,
        },
        beforeSend: function() {
            contenedorAjax.html('cargando');
            console.log('cargando');
            $('.info-resumen').remove();
        },
        success: function ( response ) {
                currentPage++;
                contenedorNews.append(response);
                contenedorAjax.html('');
                //myFunctionNoticias();
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax

});//load-more-news

//filtra las noticias por categorias, detecta el cambio en el select superior y por ajax hace una nueva query, borra el contenido actual y muestra el requerido
$('#post_categoria').change(function(){
	var categoria = $(this).val();
	if (categoria == 'todas') {
		categoria = 'none';
	}
	var contenedorNews = $('.loop-noticias-backend');
    $.ajax( {
        type: 'POST',
        url: 'inc/new-query-category.php',
        data: {
            categoria: categoria,
        },
        beforeSend: function() {
    		contenedorNews.empty(); 
    		$('.info-resumen').remove();       
        },
        success: function ( response ) {
            contenedorNews.append(response);
            //myFunctionNoticias();
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax
});//change

//borrar post
$('.btn-delete-post').click(function( event ){
	var deletePost = false;
	event.preventDefault();
	var postToDelete = $(this).attr('href');
	var itemToDelete = this.parentElement.parentElement.parentElement.parentElement;
	if ( confirm( '¿Está seguro de querer BORRAR la noticia?' ) ) {
		deletePost = true;
	}

	if (deletePost) {
		$.ajax( {
            type: 'POST',
            url: 'inc/delete-post.php',
            data: {
                post_url: postToDelete,
            },
            success: function ( response ) {
            	if (response == 'deleted') {
            	//borra la noticia del front
                	itemToDelete.remove()
                	//myFunctionNoticias();
                }
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
	}
});//click .btn-delete-post

//publicar post
$('.btn-publish-post').click(function( event ){
	event.preventDefault();
	var postToPublish = $(this).attr('href');
	var itemToDelete = $(this);
	$.ajax( {
        type: 'POST',
        url: 'inc/publish-post.php',
        data: {
            post_url: postToPublish,
        },
        success: function ( response ) {
        	if (response == 'ok') {
        	//borra la noticia del front
            	itemToDelete.empty();
            	itemToDelete.html('PUBLICADO')
            	//myFunctionNoticias();
            }
        },
        error: function ( ) {
            console.log('error');
        },
    });//cierre ajax
	
});//click .btn-delete-post

//cierra las noticias y abre el editor en el mismo modulo
$('.btn-new-post').click( function( event ){
	event.preventDefault();
	var data = {'modulo' : 'admin=editar-noticias'};

	$.ajax( {
		type: 'POST',
		url: 'inc/templates/modulos.php',
		data: data,
        //funcion antes de enviar
        beforeSend: function() {
        	//chequea si hay un modulo anterior para borrarlo
        	var moduloAnt = $('.wrapper-modulo')
        	if ( moduloAnt ) {
        		moduloAnt.remove();
        	}
        },
		success: function ( response ) {
			//borrar cargardor
			//insertar contenido
			$('.modal-body').append(response);
		},
		error: function ( error ) {
			console.log(error);
		},
	});//cierre ajax

});//click .btn-new-post

}//myfuncionnoticias()



/*
* EDITAR NOTICIA
*/

$(document).ready(function(){

	/*
	 Editor de noticias by tinyMCE
	*/
	tinyMCE.init({
		selector: '#post_contenido',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});

	/*
	 accordion by jquery ui
	*/
	$( "#accordion" ).accordion({
		heightStyle: "content",
		active: false,
			collapsible: true,
	});


	/*
	* editar la noticia / crear nueva noticia
	*/

	//coloca la fecha de hoy automaticamente si no hay fecha anterior:
	function setDate(date){
	    z=$(date).attr('value');

	    var today = new Date();
	    var dd = today.getDate();
	    var mm = today.getMonth()+1; //January is 0!

	    var yyyy = today.getFullYear();
	    if(dd<10){dd='0'+dd} 
	    if(mm<10){mm='0'+mm} 
	    today = yyyy+'-'+mm+'-'+dd;     

	    $(date).attr('value',today);
	}
	if ( $('#post_date').val() == '' ) {
		setDate('#post_date');
	}

	//coloca un url automáticamente
	$('#post_title').focusout(function(){
		//primero chequea que no tenga ya un url, si lo tiene se anula
		var titulo = $(this).val();
		var url = $('#post_url');

		if (url.val() == '') {
			var newTitulo = getCleanedString(titulo);
			url.val(newTitulo);
		}
	});

	//detecta el cambio de status y cambia el input de publicado a borrador para que al guardar se modifique en la base de datos
	$('#change_status').change(function(){
		var status = $(this).val();
		$('#post_status').val(status);
	});

	/*
	 Clic en los botones del formulario, se realiza algunas validaciones primero
	*/
	$('.btn-submit').click(function( event ){
		event.preventDefault();
		var error = $('.error-msj-list');

		//el título no puede estar vacío
		if ( $('#post_title').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">El título de la noticia no puede estar vacía</li>');
			return;
		}
		//la url no puede estar vacía
		if ( $('#post_url').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">La URL no puede estar vacía</li>');
			return;
		} else {
			var url = $('#post_url').val();
			var urlTag = $('#post_url');
			var newURL = getCleanedString(url);
			urlTag.val(newURL);
		}

		//pasa las etiquetas a mayusculas que es como se guardan para evitar duplicados y le quita la coma final imnecesaria y la coma inicial q a veces está
		var etiquetas = $('#post_tags').val().toUpperCase();
		if ( etiquetas.lastIndexOf(",") == etiquetas.length-1 ) {
			etiquetas = etiquetas.substring(0, etiquetas.length-1);
		}
		//borra la doble coma, punto y otros
		etiquetas = etiquetas.replace(/,,/gi,",");
		etiquetas = etiquetas.replace(/;/gi,",");
		etiquetas = etiquetas.replace(/,,/gi,",");
		etiquetas = etiquetas.replace(/\./gi,",");
		etiquetas = etiquetas.replace(/:/gi,",");

		//borra la coma inicial si es por error
		if ( etiquetas.indexOf(",") == 0 ) {
			etiquetas = etiquetas.substring(1, etiquetas.length);
		}
		$('#post_tags').val(etiquetas);

		

		//ver que boton se hace clic para cambiar el estado
		var name = $(this).attr('name');
		//si es boton publicar
		if ( name == 'submit_publish' ) {
			
			if (confirm('¿Seguro que quiere publicar esta noticia?')) {
				//se cambia el status a publicado
				$('#post_status').val('publicado');
				//se hace submit al formulario
				$('#editar-noticia-formulario').submit();
			}
		} else {
			//si es el boton guardar primero se chequea si ya fue publicado o es un nuevo post
			if ( $('#post_status').val() == 'new' ) {
				//si es nuevo se pasa a borrador
				$('#post_status').val('borrador');	
				$('#editar-noticia-formulario').submit();
			} else {
				//sino, simplemente se hace submit
				$('#editar-noticia-formulario').submit();	
			}
		}
	});//click button

	/*
	* Submit POST form ajax
	*/
	$('#editar-noticia-formulario').submit(function( event ){
		event.preventDefault();
		var error = $('.error-msj-list');

		//primero revalidamos que el titulo y el url esten,sino estan hay un error
		//el título no puede estar vacío
		if ( $('#post_title').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">El título de la noticia no puede estar vacía</li>');
			return;
		}
		//la url no puede estar vacía
		if ( $('#post_url').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">La URL no puede estar vacía</li>');
			return;
		}
		var galeriaImagenes = [];
		//procesa los datos de la galeria de imagenes y su orden actual
		var imagenes = $('.galeria-imagenes-wrapper').find('input');
		for (var i = 0; i < imagenes.length; i++) {
			
			galeriaImagenes.push( $(imagenes[i]).val() );

		}
		var formulario = $( this );
		var imgAjax = $( '.load-ajax' );
		var formData = new FormData( formulario[0] );
		formData.append('imgGaleria', galeriaImagenes);
		//serializo la data del formulario para enviar
		//var data = $( this ).serialize();
		
		$.ajax({
			type: 'POST',
			url: 'inc/editor-backend.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            	imgAjax.fadeIn();
            },
			success: function ( response ) {
				imgAjax.fadeOut();
				//si hay un error de vuelve el error
				if ( response == '0' ) {
					error.append( '<li class="error-msj-list-item-danger">Hubo un pequeño error</li>');
				} else if (response == 'error-url') {
					error.append( '<li class="error-msj-list-item-danger">Ya existe una entrada con ese URL</li>');
				} else {
					
					error.append( '<li class="error-msj-list-item-danger">Los Cambios fueron guardados</li>');
					
				}
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax
	});//submit #editar-noticia-formulario

	//esta inscripción sirve solo para arreglar un defecto de integracio del editor tinymce
	$(document).on('focusin', function(e) {
	  if ($(e.target).closest(".mce-window").length) {
	    e.stopImmediatePropagation();
	  }
	});

});//ready()


/*
SUBIR Y BORRAR IMAGEN DESTACADA
*/

$(document).ready(function () {
	//borrar imagen destacada
$('#imagen_destacada_wrapper').on('click', '#del-post_imagen', function(){
	
	if (confirm('Seguro quiere borrar la imagen')) {
		//borra la imagen del src para que no se vea
		$('.post_imagen').attr('src', '');
		//borra la imagen del input, para que al guardar se elimine en la bd
		$('#post_imagen').val('');

		//se borra el boton de borrar imagen
		$('#del-post_imagen').remove();
		//se agrega el de cargar imagen

		$('#upload-post_imagen_btn').remove();
		var html = $('<div class="upload-post_imagen_btn_wrapper"><button type="button" id="upload-post_imagen_btn" class="btn btn-info">Subir imagen</button><p><small>La imagen debería ser por lo menos de 1440 px por 545px</small></p></div>');
		$('#imagen_destacada_wrapper').append(html);
	}
});


//cargar imagen destacada
$(document).on('click','#upload-post_imagen_btn',function(){
	
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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye la imagen en el input a guardar en base de datos, solo nombre
					$('#post_imagen').val(newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					var innherHtml = '<img src="'+urlimg+'" class="img-responsive post_imagen"><button id="del-post_imagen" class="btn btn-danger">Borrar imagen</button>'
					var html = $(innherHtml);
					$('#imagen_destacada_wrapper').append(html);
					//se borra el boton de cargar imagen
					$('.upload-post_imagen_btn_wrapper').remove();
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
});

});// ready imagenDestacada ()

	
/*
GALERIA DE IMAGENES (MEDIA BROWSER)
*/

$(document).ready(function () {
	
	$( ".galeria-imagenes-wrapper" ).sortable({
		stop: function( event, ui ) {
			var item = 0;
			$('.imgGaleriaItemOrden').each(function(){
				$(this).html(item+1);
				item++;
			});
		},
	});

	//eliminar imagen galeria
	$(document).on('click', '.imgGaleriaItemDelBTN', function(){
		this.parentElement.remove();
	});//eliminar imagen galeria

	//agregar imagenes galeria
	$( ".galeria-imagenes-wrapper" ).disableSelection();

	$(document).on('click', '#agregar_imagenes_galeria', function(){
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
			      	class: 'btn btn-default',
			      	click: function() {
			        $( this ).dialog( "close" );
			      }
			    },
			    {
			    	text: 'Insertar imagenes',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		var contenedor = $('.galeria-imagenes-wrapper');
			    		//se toma el nombre de la imagen
			    		newImages = $('.previewAtachment');
			    		if ( newImages.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		for (var i = 0; i < newImages.length; i++) {
			    			nombreArchivo = $(newImages[i]).val();
			    			var html = '<li><input type="hidden" name="imgGaleriaItem" value="'+nombreArchivo+'"><figure><img src="/uploads/images/'+nombreArchivo+'" class="img-responsive"><span class="imgGaleriaItemOrden">0</span></figure><button class="btn btn-xs btn-danger imgGaleriaItemDelBTN">Borrar imagen</button></li>';
			    			var node = $(html);
			    			contenedor.append(node);
			    		}
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//clic agregar imagenes galeria

	
});// ready galeria imagenes


/*
TORNEOS Y EVENTOS
*/

$(document).ready(function(){

	$( "#accordionDeportes" ).accordion({
		heightStyle: "content",
		active: false,
			collapsible: true,
	});


	//agregar seccion en deportes
	$(document).on('click', '#new-section-deportes-btn', function(){
		var contenedor = $('#accordionDeportes');
		var nombreSeccion = prompt('Agregue un nombre para identificar la nueva sección');
		var textoSeccion = prompt('Agregue un texto que se vera en la página para la sección');

		if (nombreSeccion == '') {
			nombreSeccion = prompt('ES NECESARIO AGREAGAR UN NOMBRE PARA IDENTIFICAR LA NUEVA SECCIÓN');
		}

		if (textoSeccion == '') {
			textoSeccion = prompt('ES NECESARIO AGREAGAR UN TEXTO QUE SE VA A VER EN LA PÁGINA PARA LA NUEVA SECCIÓN');
		}

		if (nombreSeccion == '') {
			return;
		}

		if (textoSeccion == '') {
			return;
		}

		nombreSeccion = getCleanedStringPLUS(nombreSeccion,"!@#$^&%*()+=[]'\"\/{}|:;¡¿<>?,.");

		contenedor.empty()
		var html = '<h3>'+nombreSeccion+'</h3><div><h4 class="deportes-section-title" data-nombre="'+nombreSeccion+'">'+textoSeccion+' | <small class="change-section-name-deportes-btn">Cambiar nombre u orden</small></h4><ul class="links-deportes" id="'+nombreSeccion+'"><li><button class="btn btn-warning btn-sm new-link-deportes-btn">Crear nuevo link</button></li></ul></div><hr>';
		contenedor.append($(html));
		
		$.ajax( {
	            type: 'POST',
	            url: 'inc/new-section-deportes.php',
	            data: {
	                post_type: 'section',
	                seccion: nombreSeccion,
	                url: '',
	                texto: textoSeccion,
	                orden: '0',
	            },
	            success: function ( response ) {
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
		
	});//agregar seccion en deportes


	//cambiar nombre de sección
	$(document).on('click', '.change-section-name-deportes-btn', function(){
		var contenedor = this.closest('.deportes-section-title');
		var idsection = $(contenedor).attr('data-nombre');
		var li = this.closest('div');
		var contenedorOrden = $(li).find('.orden-secciones-deportes span');

		var nombreSeccion = prompt('Agregue un nuevo texto o déjelo en blanco para mantener el actual');
		var orden = prompt('Agregue un nuevo orden numérico o déjelo en blanco para mantener el actual');
		$(contenedor).html(nombreSeccion);
		contenedorOrden.html(orden);

		//hay que modificar el nombre de la nueva seccion en base de datos
		$.ajax( {
	            type: 'POST',
	            url: 'inc/update-section-deportes.php',
	            data: {
	                seccion: idsection,
	                texto: nombreSeccion,
	                orden: orden,
	            },
	            success: function ( response ) {
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
	});//cambiar nombre de sección

	//botones de borrar y cambiar archivos
	$(document).on('click', '.btn-del-file-deportes', function(){
		var li = $(this).closest('li')
		var id = $(this).closest('article').attr('id');
		
		//borrar item de la base de datos
		$.ajax( {
	            type: 'POST',
	            url: 'inc/delete-item-deportes.php',
	            data: {
	                idItem: id,
	            },
	            success: function ( response ) {
	            	$(li).remove();
	            },
	            error: function ( ) {
	                console.log('error');
	                $('.error-msj-deportes').html('No se pudo borrar');
	            },
	        });//cierre ajax
	});//borrar archivo deportes


	//cambiar archivo deportes
	$(document).on('click', '.btn-load-file-deportes', function(){
		
		var article = $(this).closest('article');
		var contenedor = article.find('.link-deportes-file')
		var url = 'https://' + window.location.host + '/uploads/pdfs/'

		$( "#dialog" ).dialog({
				title: 'Biblioteca de archivos',
				autoOpen: false,
				appendTo: '.contenido-modulo',
				height: 600,
				width:768,
				modal: true,
				buttons: [
			    {
			    	text: "Cerrar",
			      	class: 'btn btn-default',
			      	click: function() {
			        $( this ).dialog( "close" );
			      }
			    },
			    {
			    	text: 'Insertar archivo',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		//se toma el nombre de la imagen
			    		var newFile = $('.previewAtachment').val();
			    		if ( newFile.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		contenedor.empty();
			    		var html = '<a href="'+url+newFile+'" target="_blank" data-href="'+newFile+'">'+newFile+'</a><br><small><span class="btn-load-file-deportes">Cambiar</span> o <span class="btn-del-file-deportes">Borrar</span> archivo</small>';
			    		contenedor.append($(html));
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );

	});//cambiar archivo deportes


	//agregar link archivo deportes (no hace nada en la BD hasta que se guardan los cambios)
	$(document).on('click', '.new-link-deportes-btn', function(){
		var id = $(this).closest('ul').attr('id');
		var IDcontenedor = '#'+id;
		var contenedor = $(IDcontenedor);
		var html = '<li><article class="link-deportes-wrapper" id="id"><div class="row"><div class="col-sm-2"><h4><small>Orden:</small></h4><input type="text" class="link-deportes-orden" value="0"></div><div class="col-sm-3"><input type="text" class="link-deportes-texto" value="Texto del link"></div><div class="col-sm-3"><div class="link-deportes-file"><small><span class="btn-load-file-deportes new">Cargar nuevo</span> archivo</small></div></div><div class="col-sm-2"><button class="btn btn-sm btn-info btn-save-file-deportes">Guardar cambios</button></div><div class="col-sm-2"><span class="error-msj-deportes"></span></div></div></article></li>';
		contenedor.prepend($(html));
	});//agregar link archivo deportes


	//guardar cambios link deportes
	$(document).on('click', '.btn-save-file-deportes', function(){
		debugger;
		var idSeccion = $(this).closest('ul').attr('id');
		var article = $(this).closest('article');
		var orden = article.find('.link-deportes-orden').val();
		var texto = article.find('.link-deportes-texto').val();
		var url = article.find('.link-deportes-file a').attr('data-href');
		var errormsj = article.find('.error-msj-deportes');
		var newItem = false;
		var idItem = article.attr('id');
		if (article.attr('id') == 'id' ) {
			newItem = true;	
		}

		//modificar la base de datos con nuevo archivo
		$.ajax( {
	            type: 'POST',
	            url: 'inc/save-item-deportes.php',
	            data: {
	                post_type: 'link',
	                seccion: idSeccion,
	                url: url,
	                texto: texto,
	                orden: orden,
	                newItem: newItem,
	                idItem: idItem,
	            },
	            beforeSend: function() {
	            	errormsj.html('guardando, espere');
            	},
	            success: function ( response ) {
	            	article.attr('id', response);
	            	errormsj.html('Elemento guardado');
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax

	});//guardar cambios link deportes

});//ready torneos y eventos




/*
CONVENIOS
*/
$(document).ready(function(){

	$( "#accordionConvenios" ).accordion({
		heightStyle: "content",
		active: false,
			collapsible: true,
	});

	//agregar seccion en convenios
	$(document).on('click', '#new-section-convenios-btn', function(){
		var contenedor = $('#accordionConvenios');
		var nombreSeccion = prompt('Agregue un nombre para identificar la nueva sección');
		var textoSeccion = prompt('Agregue un texto que se vera en la página para la sección');

		if (nombreSeccion == '') {
			nombreSeccion = prompt('ES NECESARIO AGREAGAR UN NOMBRE PARA IDENTIFICAR LA NUEVA SECCIÓN');
		}

		if (textoSeccion == '') {
			textoSeccion = prompt('ES NECESARIO AGREAGAR UN TEXTO QUE SE VA A VER EN LA PÁGINA PARA LA NUEVA SECCIÓN');
		}

		if (nombreSeccion == '') {
			return;
		}

		if (textoSeccion == '') {
			return;
		}

		nombreSeccion = getCleanedStringPLUS(nombreSeccion,"!@#$^&%*()+=[]'\"\/{}|:;¡¿<>?,.");

		contenedor.empty()
		var html = '<h3>'+nombreSeccion+'</h3><div><h4 class="convenios-section-title" data-nombre="'+nombreSeccion+'">'+textoSeccion+' | <small class="change-section-name-convenios-btn">Cambiar nombre u orden</small></h4><ul class="links-convenios" id="'+nombreSeccion+'"><li><button class="btn btn-warning btn-sm new-link-convenios-btn">Crear nuevo link</button><button class="btn btn-success btn-sm new-link-convenios-btn-url">Crear nuevo link</button></li></ul></div><hr>';
		contenedor.append($(html));
		
		$.ajax( {
	            type: 'POST',
	            url: 'inc/new-section-convenios.php',
	            data: {
	                post_type: 'section',
	                seccion: nombreSeccion,
	                url: '',
	                texto: textoSeccion,
	                orden: '0',
	            },
	            success: function ( response ) {
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
		
	});//agregar seccion en convenios


	//cambiar nombre de sección
	$(document).on('click', '.change-section-name-convenios-btn', function(){
		var contenedor = this.closest('.convenios-section-title');
		var idsection = $(contenedor).attr('data-nombre');
		var li = this.closest('div');
		var contenedorOrden = $(li).find('.orden-secciones-convenios span');
		var data = {};
		var nombreSeccion = prompt('Agregue un nuevo texto o déjelo en blanco para mantener el actual');
		var orden = prompt('Agregue un nuevo orden numérico o déjelo en blanco para mantener el actual');
		
		//si no se pone un orden se toma el anterior
		if ( orden == '' ) {
			orden = contenedorOrden.html();
		}

		//si no se pone nombre de seccion no se actualiza
		if ( nombreSeccion == '' ) {
			data = {
	                seccion: idsection,
	                orden: orden,
	            }
		} else {
		data = {
            seccion: idsection,
            orden: orden,
            texto: nombreSeccion,
	            },
		$(contenedor).html(nombreSeccion);
		}

		contenedorOrden.html(orden);
		
		//hay que modificar el nombre de la nueva seccion en base de datos
		$.ajax( {
	            type: 'POST',
	            url: 'inc/update-section-convenios.php',
	            data: data,
	            success: function ( response ) {
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
	});//cambiar nombre de sección

	//botones de borrar y cambiar archivos
	$(document).on('click', '.btn-del-file-convenios', function(){
		var li = $(this).closest('li')
		var id = $(this).closest('article').attr('id');
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
		//borrar item de la base de datos
			$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-convenios.php',
		            data: {
		                idItem: id,
		            },
		            success: function ( response ) {
		            	$(li).remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $('.error-msj-convenios').html('No se pudo borrar');
		            },
		        });//cierre ajax
		}
	});//borrar archivo convenios


	//cambiar archivo convenios
	$(document).on('click', '.btn-load-file-convenios', function(){
		
		var article = $(this).closest('article');
		var contenedor = article.find('.link-convenios-file')
		var url = 'https://' + window.location.host + '/uploads/pdfs/'

		$( "#dialog" ).dialog({
				title: 'Biblioteca de archivos',
				autoOpen: false,
				appendTo: '.contenido-modulo',
				height: 600,
				width:768,
				modal: true,
				buttons: [
			    {
			    	text: "Cerrar",
			      	class: 'btn btn-default',
			      	click: function() {
			        $( this ).dialog( "close" );
			      }
			    },
			    {
			    	text: 'Insertar archivo',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		//se toma el nombre de la imagen
			    		var newFile = $('.previewAtachment').val();
			    		if ( newFile.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		contenedor.empty();
			    		var html = '<a href="'+url+newFile+'" target="_blank" data-href="'+newFile+'" data-url="0">'+newFile+'</a><br><small><span class="btn-load-file-convenios">Cambiar</span> o <span class="btn-del-file-convenios">Borrar</span> archivo</small>';
			    		contenedor.append($(html));
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );

	});//cambiar archivo convenios


	//agregar archivo convenios (no hace nada en la BD hasta que se guardan los cambios)
	$(document).on('click', '.new-link-convenios-btn', function(){
		var id = $(this).closest('ul').attr('id');
		var IDcontenedor = '#'+id;
		var contenedor = $(IDcontenedor);
		var html = '<li><article class="link-convenios-wrapper" id="id"><div class="row"><div class="col-sm-2"><h4><small>Orden:</small></h4><input type="text" class="link-convenios-orden" value="0"></div><div class="col-sm-3"><input type="text" class="link-convenios-texto" value="Texto del link"></div><div class="col-sm-3"><div class="link-convenios-file"><small><span class="btn-load-file-convenios new">Cargar nuevo</span> archivo</small></div></div><div class="col-sm-2"><button class="btn btn-sm btn-info btn-save-file-convenios">Guardar cambios</button></div><div class="col-sm-2"><span class="error-msj-convenios"></span></div></div></article></li>';
		contenedor.prepend($(html));
	});//agregar link archivo convenios

	//agregar url convenios (no hace nada en la BD hasta que se guardan los cambios)
	$(document).on('click', '.new-link-convenios-btn-url', function(){
		var id = $(this).closest('ul').attr('id');
		var IDcontenedor = '#'+id;
		var contenedor = $(IDcontenedor);

		var linkcopiado = prompt("copie el link aquí");
		var html = '<li><article class="link-convenios-wrapper" id="id"><div class="row"><div class="col-sm-2"><h4><small>Orden:</small></h4><input type="text" class="link-convenios-orden" value="0"></div><div class="col-sm-3"><input type="text" class="link-convenios-texto" value="Texto del link"></div><div class="col-sm-3"><div class="link-convenios-file"><a href="'+linkcopiado+'" target="_blank" data-href="'+linkcopiado+'" data-url="1">'+linkcopiado+'</a><br><small><span class="btn-load-file-convenios">Cambiar</span> o <span class="btn-del-file-convenios">Borrar</span> archivo</small></div></div><div class="col-sm-2"><button class="btn btn-sm btn-info btn-save-file-convenios">Guardar cambios</button></div><div class="col-sm-2"><span class="error-msj-convenios"></span></div></div></article></li>';

		contenedor.prepend($(html));
	});//agregar link archivo convenios




	//guardar cambios link convenios
	$(document).on('click', '.btn-save-file-convenios', function(){
		var idSeccion = $(this).closest('ul').attr('id');
		var article = $(this).closest('article');
		var orden = article.find('.link-convenios-orden').val();
		var texto = article.find('.link-convenios-texto').val();
		var url = article.find('.link-convenios-file a').attr('data-href');
		var errormsj = article.find('.error-msj-convenios');
		var newItem = false;
		var idItem = article.attr('id');
		var eslink = '0';
		
		if (article.attr('id') == 'id' ) {
			newItem = true;	
		}
		if ( article.find('.link-convenios-file a').attr('data-url') == '1') {
			eslink = '1';
		}

		debugger;
		//modificar la base de datos con nuevo archivo
		$.ajax( {
	            type: 'POST',
	            url: 'inc/save-item-convenios.php',
	            data: {
	                post_type: 'link',
	                seccion: idSeccion,
	                url: url,
	                texto: texto,
	                orden: orden,
	                newItem: newItem,
	                idItem: idItem,
	                eslink: eslink,
	            },
	            beforeSend: function() {
	            	errormsj.html('guardando, espere');
            	},
	            success: function ( response ) {
	            	article.attr('id', response);
	            	errormsj.html('Elemento guardado');
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax

	});//guardar cambios link convenios

});//ready convenios



/*
LEYES LABORALES
*/

$(document).ready(function(){

	//botones de borrar y cambiar archivos
	$(document).on('click', '.btn-del-file-leyes', function(){
		var li = $(this).closest('li')
		var id = $(this).closest('article').attr('id');
		

		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
		//borrar item de la base de datos
			$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-convenios.php',
		            data: {
		                idItem: id,
		            },
		            success: function ( response ) {
		            	$(li).remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $('.error-msj-leyes').html('No se pudo borrar');
		            },
		        });//cierre ajax
		}
	});//borrar archivo leyes


	//cambiar archivo convenios
	$(document).on('click', '.btn-load-file-leyes', function(){
		
		var article = $(this).closest('article');
		var contenedor = article.find('.link-leyes-file')
		var url = 'https://' + window.location.host + '/uploads/pdfs/'

		$( "#dialog" ).dialog({
				title: 'Biblioteca de archivos',
				autoOpen: false,
				appendTo: '.contenido-modulo',
				height: 600,
				width:768,
				modal: true,
				buttons: [
			    {
			    	text: "Cerrar",
			      	class: 'btn btn-default',
			      	click: function() {
			        $( this ).dialog( "close" );
			      }
			    },
			    {
			    	text: 'Insertar archivo',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		//se toma el nombre de la imagen
			    		var newFile = $('.previewAtachment').val();
			    		if ( newFile.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		contenedor.empty();
			    		var html = '<a href="'+url+newFile+'" target="_blank" data-href="'+newFile+'" data-url="0">'+newFile+'</a><br><small><span class="btn-load-file-leyes">Cambiar</span> o <span class="btn-del-file-leyes">Borrar</span> archivo</small>';
			    		contenedor.append($(html));
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );

	});//cambiar archivo convenios


	//agregar archivo convenios (no hace nada en la BD hasta que se guardan los cambios)
	$(document).on('click', '.new-link-leyes-btn', function(){
		var id = $(this).closest('ul').attr('id');
		var IDcontenedor = '#'+id;
		var contenedor = $(IDcontenedor);
		var html = '<li><article class="link-leyes-wrapper" id="id"><div class="row"><div class="col-sm-2"><h4><small>Orden:</small></h4><input type="text" class="link-leyes-orden" value="0"></div><div class="col-sm-3"><input type="text" class="link-leyes-texto" value="Texto del link"></div><div class="col-sm-3"><div class="link-leyes-file"><small><span class="btn-load-file-leyes new">Cargar nuevo</span> archivo</small></div></div><div class="col-sm-2"><button class="btn btn-sm btn-info btn-save-file-leyes">Guardar cambios</button></div><div class="col-sm-2"><span class="error-msj-leyes"></span></div></div></article></li>';
		contenedor.prepend($(html));
		scrollHaciaArriba();
	});//agregar link archivo convenios

	//agregar url convenios (no hace nada en la BD hasta que se guardan los cambios)
	$(document).on('click', '.new-link-leyes-btn-url', function(){
		var id = $(this).closest('ul').attr('id');
		var IDcontenedor = '#'+id;
		var contenedor = $(IDcontenedor);

		var linkcopiado = prompt("copie el link aquí");
		var html = '<li><article class="link-leyes-wrapper" id="id"><div class="row"><div class="col-sm-2"><h4><small>Orden:</small></h4><input type="text" class="link-leyes-orden" value="0"></div><div class="col-sm-3"><input type="text" class="link-leyes-texto" value="Texto del link"></div><div class="col-sm-3"><div class="link-leyes-file"><a href="'+linkcopiado+'" target="_blank" data-href="'+linkcopiado+'" data-url="1">'+linkcopiado+'</a><br><small><span class="btn-del-file-leyes">Borrar</span> archivo</small></div></div><div class="col-sm-2"><button class="btn btn-sm btn-info btn-save-file-leyes">Guardar cambios</button></div><div class="col-sm-2"><span class="error-msj-leyes"></span></div></div></article></li>';

		contenedor.prepend($(html));
		scrollHaciaArriba();
	});//agregar link archivo convenios




	//guardar cambios link convenios
	$(document).on('click', '.btn-save-file-leyes', function(){
		var idSeccion = 'leyes';
		var article = $(this).closest('article');
		var orden = article.find('.link-leyes-orden').val();
		var texto = article.find('.link-leyes-texto').val();
		var url = article.find('.link-leyes-file a').attr('data-href');
		var errormsj = article.find('.error-msj-leyes');
		var newItem = false;
		var idItem = article.attr('id');
		var eslink = '0';
		
		if (article.attr('id') == 'id' ) {
			newItem = true;	
		}
		if ( article.find('.link-leyes-file a').attr('data-url') == '1') {
			eslink = '1';
		}
		//modificar la base de datos con nuevo archivo
		$.ajax( {
	            type: 'POST',
	            url: 'inc/save-item-convenios.php',
	            data: {
	                post_type: 'link',
	                seccion: idSeccion,
	                url: url,
	                texto: texto,
	                orden: orden,
	                newItem: newItem,
	                idItem: idItem,
	                eslink: eslink,
	            },
	            beforeSend: function() {
	            	errormsj.html('guardando, espere');
            	},
	            success: function ( response ) {
	            	article.attr('id', response);
	            	errormsj.html('Elemento guardado');
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax

	});//guardar cambios link leyes

});//ready leyeslaborales

/*
STAFF
*/
$(document).ready(function(){
	$( "#accordionStaff" ).accordion({
		heightStyle: "content",
		active: false,
			collapsible: true,
	});

	//agregar item - no hace nada hasta hacer clic en guardar cambios o borrarlo
	$(document).on('click', '.btn-add-staff', function(){
		var contenedor = $(this).siblings('ul');
		if (  contenedor.length == 1 && $( contenedor.find('li') ).attr('data-loaded') == 'false' ) {
			contenedor.empty();
		}
		var html = '<li class="lista-staff-item"><article><div class="row"><div class="col-sm-3"><img src="assets/images/default-staff-image.png" alt="Autoridad-ATSA" class="img-responsive" data-href=""></div><div class="col-sm-9"><div class="row"><div class="col-sm-6"><p><label>Nombre: <input type="text" name="nombre" value=""></label></p><p><label>Cargo: <input type="text" name="cargo" value=""></label></p><p><label>Trabajo: <input type="text" name="trabajo" value=""></label></p></div><div class="col-sm-6"><p><label>RedSocial: <input type="text" name="redSocial" value=""></label></p><p><label>Orden: <input type="number" name="orden" value="0"></label></p><p class="error-msj-staff-item"></p></div></div><p><button class="btn btn-xs btn-info btn-change-staff-item-img" data-id="new">Cambiar imagen</button></p><p class="btns-item-footer"><button class="btn btn-sm btn-success btn-save-staff-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-staff-item" data-id="new">Borrar elemento</button></p></div></div></article></li>';
		contenedor.prepend($(html));

	});
	
	//borrar item
	$(document).on('click', '.btn-del-staff-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('li');

		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
		//borrar item de la base de datos
			$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-staff.php',
		            data: {
		                idItem: idItem,
		            },
		            success: function ( response ) {
		            	$(contenedor).remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $('.error-msj-staff-item').html('No se pudo borrar');
		            },
		        });//cierre ajax
		}
	});//borrar item staff


	//guardar cambios
	$(document).on('click', '.btn-save-staff-item', function(){
		var idItem = $(this).attr('data-id');
		var li = this.closest('li');
		var post_type = $(li.closest('ul')).attr('data-postType');
		var imgItem =  $(li).find('img').attr('data-href');
		var input = $(li).find('input');
		var nombreItem = $(input[0]).val();
		var cargoItem = $(input[1]).val();
		var trabajoItem = $(input[2]).val();
		var redSocialItem = $(input[3]).val();
		var ordenItem = $(input[4]).val();
		var isnew = false;

		if ( idItem == 'new' ) {
			isnew = true;			
		}

		$.ajax( {
            type: 'POST',
            url: 'inc/save-item-staff.php',
            data: {
            	post_type: post_type,
                idItem: idItem,
                img: imgItem,
                nombre: nombreItem,
                cargo: cargoItem,
                trabajo: trabajoItem,
                redSocial: redSocialItem,
                orden: ordenItem,
                newItem: isnew,
            },
            beforeSend: function() {
	            	$( li).find('.error-msj-staff-item').html('guardando, espere');
            	},
            success: function ( response ) {
            	$( li).find('.error-msj-staff-item').html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $( li).find('.error-msj-staff-item').html('No se pudo guardar');
            },
        });//cierre ajax

	});//guardar cambios staff item

	//cambiar imagen
	$(document).on('click', '.btn-change-staff-item-img', function(){
		var idItem = $(this).attr('data-id');
		var li = this.closest('li');
		var imgItem =  $(li).find('img')

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(imgItem).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(imgItem).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );


	});//cambiar image cambios staff item

});//READY staff


/*
HOTELES Y VIAJES
*/
$(document).ready(function(){
	/*$( "#hotelesyviajes" ).accordion({
		heightStyle: "content",
		active: false,
			collapsible: true,
	});*/

	/*
	 Editor de texto by tinyMCE
	*/
	tinyMCE.init({
		selector: '#promo-viajes-text',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});

	/*
	 Editor de texto by tinyMCE
	*/
	tinyEditor();
	function tinyEditor() {
		tinyMCE.init({
		selector: '.hotel-text-tiny',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});
	}
	

	//guardar cambios viajes
	$('#save-viajes-data').click(function(){
		var textoSuperior = $('#texto-superior').val();
		var textoContacto = $('#texto-contacto').val();
		var tituloPromo = $('#titulo-promo').val();
		var textoPromo = $('#promo-viajes-text').val();

		$.ajax( {
            type: 'POST',
            url: 'inc/save-viajes.php',
            data: {
            	textoSuperior: textoSuperior,
            	textoContacto: textoContacto,
            	tituloPromo: tituloPromo,
            	textoPromo: textoPromo,
            },
            beforeSend: function() {
            	$('.msj-viajes-saved').html('guardando, espere');
        	},
            success: function ( response ) {
            	$('.msj-viajes-saved').html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $('.msj-viajes-saved').html('No se pudo guardar');
            },
        });//cierre ajax

	});//save buton viajes


	$('#new-item-hotel').click(function(){
		var contenedor = $('.lista-hoteles-admin');
		var html = '<li class="lista-hoteles-admin-item"><article><div class="row"><div class="col-sm-4"><label>Titulo: <br><input name="titulo-hotel" type="text"></label><label>Leyenda Imagen: <br><input name="leyenda-imagen-hotel" type="text"></label><ul class="hoteles-imagenes"><li><img src="" class="img-responsive img-hotel-imagen"><button class="btn btn-xs btn-warning btn-change-image-hotel">agregar imagen</button></li><li><img src="" class="img-responsive img-hotel-icontipo"><button class="btn btn-xs btn-success btn-change-image-hotel">Agregar icono hotel</button></li><li><img src="" class="img-responsive img-hotel-iconserv"><button class="btn btn-xs btn-info btn-change-image-hotel">Agregar icono servicios</button></li></ul></div><div class="col-sm-8"><label>Descripción Hotel: <br><textarea class="hotel-text-tiny" name="descripcion-hotel"></textarea></label><label>Servicios Hotel: <br><textarea class="hotel-text-tiny" name="servicios-hotel"></textarea></label><label>Contingente Hotel: <br><textarea class="hotel-text-tiny" name="contingente-hotel"></textarea></label></div></div><div class="btn-viajes-wrapper"><span class="msj-viajes-saved"></span><button class="btn btn-danger btn-hotel-save-item" data-id="new">Guardar Cambios</button>&nbsp;<button class="btn btn-success btn-hotel-del-item" data-id="new">Borrar hotel</button></div></article></li>';
		contenedor.prepend(html);
		tinyEditor();
	});//click new-item-hotel

	//borrar hotel
	$(document).on('click', '.btn-hotel-del-item', function(){
		var idItem = $(this).attr('data-id');
		var li = this.closest('li');
		var msj = $(li).find('.msj-viajes-saved');
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(li).remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-hotel.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(li).remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-hotel-del-item
	
	//guardar cambios hotel
	$(document).on('click', '.btn-hotel-save-item', function(){
		var idItem = $(this).attr('data-id');
		var btn = $(this);
		article = this.closest('article');
		newArticle = false;
		var inputs = $(article).find('input');
		var textareas = $(article).find('textarea');
		var titulo = $(inputs[0]).val();
		var caption = $(inputs[1]).val();
		var imagen = $(article).find('.img-hotel-imagen').attr('data-href');
		var iconhotel = $(article).find('.img-hotel-icontipo').attr('data-href');
		var iconserv = $(article).find('.img-hotel-iconserv').attr('data-href');
		var descripcion = $(textareas[0]).val();
		var servicios = $(textareas[1]).val();
		var contingente = $(textareas[2]).val();
		var msj = $(article).find('.msj-viajes-saved');
		var btnDel = $(article).find('.btn-hotel-del-item')

		if ( idItem == 'new' ) {
			newArticle = true;
		}

		$.ajax( {
            type: 'POST',
            url: 'inc/save-hoteles.php',
            data: {
            	titulo: titulo,
            	caption: caption,
            	imagen: imagen,
            	iconhotel: iconhotel,
            	iconserv: iconserv,
            	descripcion: descripcion,
            	servicios: servicios,
            	contingente: contingente,
            	newArticle: newArticle,
            	idItem: idItem,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax

	})//click guardar cambios hotel

	//cambiar imagenes:

	//cambiar o agregar imagen hotel
	$(document).on('click', '.btn-change-image-hotel', function(){
		var li = this.closest('li');
		var img = $(li).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );


	});//cambiar image cambios staff item


});//ready hoteles y viajes


/*
CURSOS (formales y no formales)
*/

$(document).ready(function(){
	/*$( "#cursosacordion" ).accordion({
		heightStyle: "content",
		active: false,
		collapsible: true,
	});*/
	
	$( "#contenedor-formacion-tecnica" ).accordion({
		heightStyle: "content",
		active: false,
		collapsible: true,
	});

	$( "#contenedor-no-formal" ).accordion({
		heightStyle: "content",
		active: false,
		collapsible: true,
	});

	$( "#contenedor-universitarios" ).accordion({
		heightStyle: "content",
		active: false,
		collapsible: true,
	});

	
	tinyEditor();
	function tinyEditor() {
		tinyMCE.init({
		selector: '.tinyeditorcursos',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		//media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});
	}

	//coloca un url automáticamente
	//$('.cursos_input_titulo').focusout(function(){
	$(document).on('focusout', '.cursos_input_titulo', function(){
		//primero chequea que no tenga ya un url, si lo tiene se anula
		var titulo = $(this).val();
		var contenedor = this.closest('div');
		var url = $(contenedor).find('.cursos_input_slug');

		if (url.val() == '') {
			var newTitulo = getCleanedString(titulo);
			url.val(newTitulo);
		}
	});

	//guardar cambios
	$(document).on('click', '.btn-curso-save-item', function(){
		var idItem = $(this).attr('data-id');
		var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('article');
		var msj = $(article).find('.msj-cursos-saved');
		var btnDel = $(article).find('.btn-curso-del-item')
		var data = {};
		
		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}

		if ( post_type == 'formacion_tecnica' ) {
			var inputs = $(article).find('input');
			var textareas = $(article).find('textarea');
			var titulo = $(inputs[0]).val();
			var slug = $(inputs[1]).val();
			var resumen = $(textareas[0]).val();
			var metodologia = $(textareas[2]).val();
			var objGeneral = $(textareas[3]).val();
			var objEspecifico = $(article).find('.tinyeditorcursos').val();
			var requisitos = $(textareas[4]).val();
			var imagen = $(article).find('.imagen-curso').attr('data-href');
			var destinatario = $(textareas[5]).val();
			var certificado = $(inputs[2]).val();
			var cursada = $(textareas[1]).val();
			var horarios = $(inputs[3]).val();
			var lugar = $(inputs[4]).val();
			var destacado = '0';
			if ( inputs[5].checked ) {
				var destacado = '1';
			};
			var orden = $(inputs[6]).val();
			if ( orden == '' ) {
				orden = 0;
			}

			if ( titulo == '' ) {
				$(msj).html('El título no puede estar vacío');
				return;
			}
			
			//la url no puede estar vacía
			if ( slug == '' ) {
				slug = getCleanedString(titulo);
				$(inputs[1]).val(slug);
			}

			data = {
	            	titulo: titulo,
	            	slug: slug,
	            	resumen: resumen,
	            	metodologia: metodologia,
	            	objGeneral: objGeneral,
	            	objEspecifico: objEspecifico,
	            	requisitos: requisitos,
	            	imagen: imagen,
	            	destinatario: destinatario,
	            	certificado: certificado,
	            	cursada: cursada,
	            	horarios: horarios,
	            	lugar: lugar,
	            	destacado: destacado,
	            	orden: orden,
	            	newArticle: newArticle,
	            	idItem: idItem,
	            	post_type: post_type,
				}
				
        } else if (post_type == 'no_formal') {
        	var inputs = $(article).find('input');
			var titulo = $(article).find('input[name="cursos_titulo"]').val();
			var orden = $(article).find('input[name="cursos_orden"]').val();
			var resumen = $(article).find('.tinyeditorcursos').val();
			var imagen = $(article).find('.imagen-curso').attr('data-href');
			var archivo = $(article).find('.archivo-curso').attr('data-href');
			
			if ( orden == '' ) {
				orden = 0;
			}
			
			if ( titulo == '' ) {
				$(msj).html('El título no puede estar vacío');
				return;
			}
        	data = {
	            	titulo: titulo,
	            	objEspecifico: resumen,
	            	orden: orden,
	            	newArticle: newArticle,
					idItem: idItem,
					imagen:imagen,
					archivo:archivo,
	            	post_type: post_type,
				}
				
        } else if (post_type == 'universitarios') {
			var inputs = $(article).find('input');
			var titulo = $(article).find('input[name="cursos_titulo"]').val();
			var slug = $(article).find('input[name="cursos_slug"]').val();
			var orden = $(article).find('input[name="cursos_orden"]').val();
			var contenido = $(article).find('.tinyeditorcursos').val();
			var imagen = $(article).find('.imagen-curso').attr('data-href');
			var archivo = $(article).find('.archivo-curso').attr('data-href');

        	if ( orden == '' ) {
				orden = 0;
			}

			if ( titulo == '' ) {
				$(msj).html('El título no puede estar vacío');
				return;
			}

			//la url no puede estar vacía
			if ( slug == '' ) {
				slug = getCleanedString(titulo);
				$(article).find('input[name="cursos_slug"]').val(slug);
			}

        	data = {
					titulo: titulo,
					slug: slug,
	            	objEspecifico: contenido,
					orden: orden,
					imagen:imagen,
					archivo:archivo,
	            	newArticle: newArticle,
					idItem: idItem,
	            	post_type: post_type,
				}
				
        } else if (post_type == 'instituto') {
        	var inputs = $(article).find('input');
			var textareas = $(article).find('textarea');
			var orden = '0';
			var titulo = $(inputs[0]).val();
			var ramaConocimiento = $(inputs[1]).val();
			var duracion = $(inputs[2]).val();
			var modalidad = $(inputs[3]).val();
			var dependencia = $(inputs[4]).val();
			var titulacion = $(inputs[5]).val();
			var lugar = $(inputs[6]).val();
			var historia = $(textareas[0]).val();
			var mision = $(textareas[1]).val();
			var practicasProfesionales = $(textareas[2]).val();
			var autoridades = $(textareas[3]).val();
			var cuerpoDocente = $(textareas[4]).val();
			var frase = $(textareas[5]).val();
			var horarios = $(textareas[6]).val();
			var inscripciones = $(textareas[7]).val();
			var imagen = $(article).find('.imagen-curso').attr('data-href');
			var planEstudios = $(article).find('.archivo-curso').attr('data-href');

        	
        	data = {
	            	titulo: titulo,
	            	slug: ramaConocimiento,
	            	resumen: titulacion,
	            	metodologia: historia,
	            	objGeneral: mision,
	            	objEspecifico: cuerpoDocente,
	            	requisitos: practicasProfesionales,
	            	imagen: imagen,
	            	archivo: planEstudios,
	            	destinatario: inscripciones,
	            	certificado: autoridades,
	            	cursada: frase,
	            	horarios: horarios,
	            	lugar: lugar,
	            	dataextra1: duracion,
	            	dataextra2: modalidad,
	            	dataextra3: dependencia,
	            	destacado: '0',
	            	orden: orden,
	            	newArticle: newArticle,
	            	idItem: idItem,
	            	post_type: post_type,
	            }
        }

		$.ajax( {
            type: 'POST',
            url: 'inc/save-cursos.php',
            data: data,
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios
	

	//borrar curso
	$(document).on('click', '.btn-curso-del-item', function(){
		var idItem = $(this).attr('data-id');
		var li = this.closest('.curso');
		var msj = $(li).find('.msj-cursos-saved');

		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(li).remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-cursos.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(li).remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-curso-del-item

	//cambiar o agregar imagen curso
	$(document).on('click', '.btn-change-image-curso', function(){
		var div = this.closest('div');
		var img = $(div).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar imagen

	$('.btn-new-curso').click(function(){
		var tipo = $(this).attr('data-tipo');
		if ( tipo == 'formacion-tecnica' ) {
			var contenedor = $('#contenedor-formacion-tecnica');
			var html = '<div class="curso"><article><div class="row"><div class="col-sm-6"><label>Título:<br><input class="cursos_input_titulo" type="text" name="cursos_titulo" value=""></label><label>Slug:<br><input class="cursos_input_slug" type="text" name="cursos_orden" value=""></label></div><div class="col-sm-6"><label>Resumen:<br><textarea name="cursos_resumen"></textarea></label></div></div><div class="row"><div class="col-sm-6"><label>Imagen:<br><img data-href="" class="img-responsive imagen-curso" src=""><button class="btn btn-xs btn-change-image-curso">agregar imagen</button></label></div><div class="col-sm-6"><label>Certificado:<br><input type="text" name="cursos_titulo" value=""></label><label>Cursada:<br><textarea name="cursos_orden"></textarea></label><label>Horarios:<br><input type="text" name="cursos_orden" value=""></label><label>Lugar:<br><input type="text" name="cursos_orden" value=""></label></div></div><div class="row"><div class="col-sm-6"><label>Metodología:<br><textarea name="curso_metodologia"></textarea></label></div><div class="col-sm-6"><label>Objetivo General:<br><textarea name="curso_objgeneral"></textarea></label></div><div class="col-sm-6"><label>Requisitos:<br><textarea name="curso_requisitos"></textarea></label></div><div class="col-sm-6"><label>Destinatario:<br><textarea name="curso_destinatario"></textarea></label></div></div><div class="row"><div class="col-sm-8"><label>Objetivo Específico:<br><textarea class="tinyeditorcursos" name="curso_objespecifico"></textarea></label></div><div class="col-sm-4"><div class="row"><div class="col-sm-8"><label>Destacado:<br><input type="checkbox" name="cursos_destacado"></label></div><div class="col-sm-4"><label>Orden:<br><input type="number" name="cursos_orden" value=""></label></div></div></div></div><div class="btn-cursos-wrapper"><span class="msj-cursos-saved"></span><button class="btn btn-danger btn-curso-save-item" data-tipo="formacion_tecnica" data-id="new">Guardar Cambios</button>&nbsp;<button class="btn btn-success btn-curso-del-item" data-tipo="formacion_tecnica" data-id="new">Borrar curso</button></div></article></div>';
		} else if ( tipo == 'no-formal' ) {
			var contenedor = $('#contenedor-no-formal');
			var html = '<div class="curso"><article><div class="row"><div class="col-sm-8"><label>Título:<br><input type="text" name="cursos_titulo" value=""></label></div><div class="col-sm-4"><label>Orden:<br><input type="number" name="cursos_orden" value=""></label></div></div><div class="row"><div class="col-sm-6"><label>Duración:<br><input type="text" name="cursos_titulo" value=""></label></div><div class="col-sm-6"><label>Horarios:<br><input type="text" name="cursos_orden" value=""></label></div></div><div class="row"><div class="col-sm-12"><label>Resumen:<br><textarea name="cursos_orden"></textarea></label></div></div><div class="btn-cursos-wrapper"><span class="msj-cursos-saved"></span><button class="btn btn-danger btn-curso-save-item" data-tipo="no_formal" data-id="new">Guardar Cambios</button>&nbsp;<button class="btn btn-success btn-curso-del-item" data-tipo="no_formal" data-id="new">Borrar curso</button></div></article></div>';
		} else {
			var contenedor = $('#contenedor-universitarios');
			var html = '<div class="curso"><article><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="cursos_titulo" value=""></label><label>Slug: (url)<br><input class="cursos_input_slug" type="text" name="cursos_slug" value=""></label></div><div class="col-sm-2"><label>Orden:<br><input type="number" name="cursos_orden" value=""></label></div></div><div class="row"><div class="col-sm-4"><label>Imagen:<br><img data-href="" class="img-responsive imagen-curso" src=""><button class="btn btn-xs btn-change-image-curso">Cambiar imagen</button></label></div><div class="col-sm-8"><label>Contenido:<br><textarea class="tinyeditorcursos" name="cursos_contenido"></textarea></label></div><div class="col-sm-12"><h4>Plan De estudios (opcional)</h4><a href="" target="_blank" data-href="" class="archivo-curso"></a><button class="btn btn-xs btn-change-archivo-curso">Cambiar/cargar archivo</button></div></div><div class="btn-cursos-wrapper"><span class="msj-cursos-saved"></span><button class="btn btn-danger btn-curso-save-item" data-tipo="universitarios" data-id="new">Guardar Cambios</button>&nbsp;<button class="btn btn-success btn-curso-del-item" data-tipo="universitarios" data-id="new">Borrar Convenio</button></div></article></div>';
		}
		if ( $($(contenedor).find('div')).length == 0 ) {
			contenedor.empty();
		}
		contenedor.prepend(html);
		tinyEditor();
	});//click new-item-curso
	

	//cambiar o agregar archivo plan de estudios
	$(document).on('click', '.btn-change-archivo-curso', function(){
		
		var div = this.closest('div');
		var file = $(div).find('.archivo-curso');
		var url = 'https://' + window.location.host + '/uploads/pdfs/'

		$( "#dialog" ).dialog({
				title: 'Biblioteca de archivos',
				autoOpen: false,
				appendTo: '.contenido-modulo',
				height: 600,
				width:768,
				modal: true,
				buttons: [
			    {
			    	text: "Cerrar",
			      	class: 'btn btn-default',
			      	click: function() {
			        $( this ).dialog( "close" );
			      }
			    },
			    {
			    	text: 'Insertar archivo',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		//se toma el nombre de la imagen
			    		var newFile = $('.previewAtachment').val();
			    		if ( newFile.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		$(file).attr('href', url+newFile);
			    		$(file).attr('data-href', newFile);
			    		$(file).html(newFile);
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );

	});//cambiar archivo curso

	$(document).on('click', '.btn-clear-archivo-curso', function(){
		
		var div = this.closest('div');
		var file = $(div).find('.archivo-curso');
		$(file).attr('href', '');
		$(file).attr('data-href', '');
		$(file).html('');


	});//clear archivo curso

})//ready cursos

/*
BENEFICIOS
*/
$(document).ready(function(){
	$( "#beneficiosAdmin" ).accordion({
			heightStyle: "content",
			active: false,
			collapsible: true,
		});	
	
	
	tinyEditorBeneficios();

	function tinyEditorBeneficios() {
		tinyMCE.init({
		selector: '.tinymce-beneficios',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		//media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
		});
	}

	//cambiar imagen
	$(document).on('click', '.btn-change-image-beneficio', function(){
		var div = this.closest('div');
		var img = $(div).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar image 

	//agregar un beneficio
	$('.new-beneficios-btn').click(function(){
		var contenedor = $('#beneficiosAdmin');
		var titulo = prompt('Inserte el título del beneficio');
		var orden = 0;
		if ( titulo == '' ) {
			titulo = 'Titulo beneficio'
		}

		var html = '<h3 class="beneficio-item-titulo">'+titulo+'</h3><div class="beneficio-item"><div class="row"><div class="col-sm-4"><img data-herf="" class="img-responsive"><button class="btn btn-xs btn-primary btn-change-image-beneficio">Cambiar imagen</button></div><div class="col-sm-8"><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="beneficio_titulo" value="'+titulo+'"></label><label>Incluye:<br><input type="text" name="beneficio_incluye" value=""></label></div><div class="col-sm-2"><label>Orden:<br><input type="text" name="beneficio_orden" value="'+orden+'"></label></div><div class="col-sm-12"><label>Requisitos:<br><textarea class="tinymce-beneficios" name="beneficio_texto"></textarea></label></div></div></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-beneficio-saved"></span><button class="btn btn-sm btn-success btn-save-beneficios-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-beneficios-item" data-id="new">Borrar elemento</button></p></div></div></div>';
		contenedor.prepend(html);
		tinyEditorBeneficios();
	});//click new-item-curso

	//borrar beneficio
	$(document).on('click', '.btn-del-beneficios-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('.beneficio-item');
		var tituloContenedor = $(contenedor).prev();
		var msj = $(contenedor).find('.msj-beneficio-saved');
		
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(contenedor).remove();
				tituloContenedor.remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-beneficio.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(contenedor).remove();
		            	tituloContenedor.remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-curso-del-item


	//guardar cambios beneficios
	$(document).on('click', '.btn-save-beneficios-item', function(){
		var idItem = $(this).attr('data-id');
		//var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('.beneficio-item');
		var msj = $(article).find('.msj-beneficio-saved');
		var btnDel = $(article).find('.btn-del-beneficios-item');
		var inputs = $(article).find('input')
		var titulo = $(inputs[0]).val();
		var orden = $(inputs[2]).val();;
		var incluye = $(inputs[1]).val();;
		var imagen = $($(article).find('img')).attr('data-href');
		var texto = $(article).find('textarea').val();

		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}
			
		$.ajax( {
            type: 'POST',
            url: 'inc/save-beneficios.php',
            data: {
            	idItem: idItem,
            	titulo: titulo,
            	orden: orden,
            	incluye: incluye,
            	imagen: imagen,
            	texto: texto,
            	newArticle: newArticle,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios

});//ready beneficios


/*
EDITAR PAGINAS
*/
$(document).ready(function(){
	$( "#beneficiosAdmin" ).accordion({
			heightStyle: "content",
			active: false,
			collapsible: true,
		});	
	
	
	tinyMCE.init({
		selector: '#textoPrincipal',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});

	//guardar cambios
	$(document).on('click', '.btn-save-page', function(){
		var idItem = $(this).attr('data-id');
		var btn = $(this);
		var contenedor = this.closest('.page-admin-wrapper');
		var titulo = $(contenedor).find('input[name="page_titulo"]').val();
		var extra = $(contenedor).find('input[name="page_extra"]').val();
		var imagen = $(contenedor).find('img').attr('data-href');
		var contenido = $(contenedor).find('textarea').val();
		var msj = $(contenedor).find('.msj-page-saved');
		
		$.ajax( {
            type: 'POST',
            url: 'inc/save-page.php',
            data: {
            	idItem: idItem,
            	titulo: titulo,
				imagen: imagen,
				extra: extra,
            	contenido: contenido,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response == 'ok' ) {
            		$(msj).html('Cambios guardados');
            	} else {
            		$(msj).html('No se pudo guardar');	
            	}
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax

	});


	//cambiar imagen
	$(document).on('click', '.btn-change-imagen', function(){
		var div = this.closest('div');
		var img = $(div).find('img');
		var btn = $(this);

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					btn.text('Cambiar Imagen');
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar image 

})//ready edit page


/*
PREGUNTAS
*/

$(document).ready(function(){
	$( "#preguntasAcorddion" ).accordion({
			heightStyle: "content",
			active: false,
			collapsible: true,
		});	
	
	
	tinyEditorPregunta();

	function tinyEditorPregunta() {
		tinyMCE.init({
		selector: '.tinymce-pregunta',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		//media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
		});
	}

	//cambiar imagen
	$(document).on('click', '.btn-change-image-pregunta', function(){
		var div = this.closest('div');
		var img = $(div).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar image 

	//agregar una pregunta
	$('.new-pregunta-btn').click(function(){
		var contenedor = $('#preguntasAcorddion');
		var titulo = prompt('Escriba la pregunta');
		var orden = 0;
		if ( titulo == '' ) {
			titulo = 'Nueva Pregunta'
		}

		var html = '<h3 class="pregunta-item-titulo">'+titulo+'</h3><div class="pregunta-item"><div class="row"><div class="col-sm-2"><img src="" data-href="" class="img-responsive"><button class="btn btn-xs btn-primary btn-change-image-pregunta">Agregar imagen</button></div><div class="col-sm-10"><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="pregunta_titulo" value="'+titulo+'"></label></div><div class="col-sm-2"><label>Orden:<br><input type="text" name="pregunta_orden" value="'+orden+'"></label></div><div class="col-sm-12"><label>Contenido:<br><textarea class="tinymce-pregunta" name="pregunta_texto"></textarea></label></div></div></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-preguntas-saved"></span><button class="btn btn-sm btn-success btn-save-pregunta-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-pregunta-item" data-id="new">Borrar elemento</button></p></div></div></div>';
		contenedor.prepend(html);
		tinyEditorPregunta();
	});//click new-item-curso

	//borrar pregunta
	$(document).on('click', '.btn-del-pregunta-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('.pregunta-item');
		var tituloContenedor = $(contenedor).prev();
		var msj = $(contenedor).find('.msj-preguntas-saved');
		
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(contenedor).remove();
				tituloContenedor.remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-pregunta.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(contenedor).remove();
		            	tituloContenedor.remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-pregunta-del-item


	//guardar cambios preguntas
	$(document).on('click', '.btn-save-pregunta-item', function(){
		var idItem = $(this).attr('data-id');
		//var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('.pregunta-item');
		var msj = $(article).find('.msj-preguntas-saved');
		var btnDel = $(article).find('.btn-del-pregunta-item');
		var inputs = $(article).find('input')
		var titulo = $(inputs[0]).val();
		var orden = $(inputs[1]).val();
		var imagen = $($(article).find('img')).attr('data-href');
		var texto = $(article).find('textarea').val();

		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}
			
		$.ajax( {
            type: 'POST',
            url: 'inc/save-pregunta.php',
            data: {
            	idItem: idItem,
            	titulo: titulo,
            	orden: orden,
            	imagen: imagen,
            	texto: texto,
            	newArticle: newArticle,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios

});//ready preguntas



/*
PROGRAMAS DE PREVENCION
*/
$(document).ready(function(){
	$( "#prevencionAcorddion" ).accordion({
			heightStyle: "content",
			active: false,
			collapsible: true,
		});	
	
	
	tinyEditorPrevencion();

	function tinyEditorPrevencion() {
		tinyMCE.init({
		selector: '.tinymce-prevencion',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		//media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
		});
	}

	//agregar un programa
	$('.new-prevencion-btn').click(function(){
		var contenedor = $('#prevencionAcorddion');
		var titulo = prompt('Escriba el título del programa');
		var orden = 0;
		if ( titulo == '' ) {
			titulo = 'Programa Nuevo'
		}

		var html = '<h3 class="prevencion-item-titulo">'+titulo+'</h3><div class="prevencion-item"><div class="row"><div class="col-sm-1"><label>Orden:<br><input type="text" name="prevencion_orden" value="0"></label></div><div class="col-sm-11"><label>Título:<br><input type="text" name="prevencion_titulo" value="'+titulo+'"></label><label>Contenido:<br><textarea class="tinymce-prevencion" name="prevencion_texto"></textarea></label></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-prevencion-saved"></span><button class="btn btn-sm btn-success btn-save-prevencion-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-prevencion-item" data-id="new">Borrar elemento</button></p></div></div></div>';
		contenedor.prepend(html);
		tinyEditorPrevencion();
	});//click new-item-curso

	//borrar programa
	$(document).on('click', '.btn-del-prevencion-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('.prevencion-item');
		var tituloContenedor = $(contenedor).prev();
		var msj = $(contenedor).find('.msj-prevencion-saved');
		
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(contenedor).remove();
				tituloContenedor.remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-prevencion.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(contenedor).remove();
		            	tituloContenedor.remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-pregunta-del-item


	//guardar cambios programas
	$(document).on('click', '.btn-save-prevencion-item', function(){
		var idItem = $(this).attr('data-id');
		//var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('.prevencion-item');
		var msj = $(article).find('.msj-prevencion-saved');
		var btnDel = $(article).find('.btn-del-prevencion-item');
		var inputs = $(article).find('input')
		var titulo = $(inputs[1]).val();
		var orden = $(inputs[0]).val();
		var texto = $(article).find('textarea').val();

		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}
			
		$.ajax( {
            type: 'POST',
            url: 'inc/save-prevencion.php',
            data: {
            	idItem: idItem,
            	titulo: titulo,
            	orden: orden,
            	texto: texto,
            	newArticle: newArticle,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios

});//ready preguntas


/*
LABORATORIO DE SIMULACION
*/

$(document).ready(function(){
	$( "#laboratorioAcorddion" ).accordion({
			heightStyle: "content",
			active: false,
			collapsible: true,
		});	
	
	
	tinyEditorLaboratorio();

	function tinyEditorLaboratorio() {
		tinyMCE.init({
		selector: '.tinymce-laboratorio',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		//media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
		});
	}

	//cambiar imagen
	$(document).on('click', '.btn-change-image-laboratorio', function(){
		var div = this.closest('div');
		var img = $(div).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar image 

	//agregar una pregunta
	$('.new-laboratorio-btn').click(function(){
		var contenedor = $('#laboratorioAcorddion');
		var titulo = prompt('Escriba el título');
		var orden = 0;
		if ( titulo == '' ) {
			titulo = 'Nuevo Item'
		}

		var html = '<h3 class="laboratorio-item-titulo">'+titulo+'</h3><div class="laboratorio-item"><div class="row"><div class="col-sm-4"><img src="" data-href="" class="img-responsive"><button class="btn btn-xs btn-primary btn-change-image-laboratorio">Cambiar imagen</button></div><div class="col-sm-8"><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="laboratorio_titulo" value="'+titulo+'"></label></div><div class="col-sm-2"><label>Orden:<br><input type="text" name="laboratorio_orden" value="'+orden+'"></label></div><div class="col-sm-12"><label>Contenido:<br><textarea class="tinymce-laboratorio" name="laboratorio_texto"></textarea></label></div></div></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-laboratorio-saved"></span><button class="btn btn-sm btn-success btn-save-laboratorio-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-laboratorio-item" data-id="new">Borrar elemento</button></p></div></div></div>';
		contenedor.prepend(html);
		tinyEditorLaboratorio();
	});//click new-item-laboratorio

	//borrar pregunta
	$(document).on('click', '.btn-del-laboratorio-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('.laboratorio-item');
		var tituloContenedor = $(contenedor).prev();
		var msj = $(contenedor).find('.msj-laboratorio-saved');
		
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(contenedor).remove();
				tituloContenedor.remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-laboratorio.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(contenedor).remove();
		            	tituloContenedor.remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-pregunta-del-item


	//guardar cambios preguntas
	$(document).on('click', '.btn-save-laboratorio-item', function(){
		var idItem = $(this).attr('data-id');
		//var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('.laboratorio-item');
		var msj = $(article).find('.msj-laboratorio-saved');
		var btnDel = $(article).find('.btn-del-laboratorio-item');
		var inputs = $(article).find('input')
		var titulo = $(inputs[0]).val();
		var orden = $(inputs[1]).val();
		var imagen = $($(article).find('img')).attr('data-href');
		var texto = $(article).find('textarea').val();

		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}
			
		$.ajax( {
            type: 'POST',
            url: 'inc/save-laboratorio.php',
            data: {
            	idItem: idItem,
            	titulo: titulo,
            	orden: orden,
            	imagen: imagen,
            	texto: texto,
            	newArticle: newArticle,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios

});//ready laboratorio


/*
HOMEPAGE
*/

$(document).ready(function(){

	/*
	 Editor de texto by tinyMCE
	*/
	tinyMCE.init({
		selector: '#conectados_texto',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});


	//cambiar imagenes
	$(document).on('click', '.change-image', function(){

		contenedor = this.closest('div');
		img = $(contenedor).find('img');
		input = $(contenedor).find('input');

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
		      	class: 'btn btn-default',
		      	click: function() {
		        $( this ).dialog( "close" );
		      }
		    },
		    {
		    	text: 'Insertar imagen',
		    	class: 'btn btn-success',
		    	click: function () {
		    		newImage = $('.previewAtachment').val();
		    		//funcion que inserta la imagen en el lugar
		    		input.val(newImage);
		    		img.attr('src', '/uploads/images/' + newImage);
		    		//cierra dialogo de carga
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});

		$( "#dialog" ).dialog( 'open' )
		.load( 'inc/templates/media-browser.php' );
	});//clic cambiar imagen


	//guardar cambios
	$('#homepage_form').submit(function( e ){
		e.preventDefault();
		var mensaje = $('.mensaje-guardado');
		var formulario = $( this );
		var formData = new FormData( formulario[0] );
		
		$.ajax({
			type: 'POST',
			url: 'inc/save-home-page.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            },
			success: function ( response ) {
				console.log(response)
				
				mensaje.html(response)
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax

	});

});//ready homepage


/*
VIVO PAGE
*/
$(document).ready(function(){
	//guardar cambios
	$('#video_vivo_formulario').submit(function( e ){
		e.preventDefault();
		var mensaje = $('.mensaje-guardado');
		var formulario = $( this );
		var formData = new FormData( formulario[0] );
		
		$.ajax({
			type: 'POST',
			url: 'inc/save-video-vivo.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            },
			success: function ( response ) {
				console.log(response)
				
				mensaje.html(response);
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax

	});
});


/*
PETICION
*/

$(document).ready(function(){

	/*
	 Editor de texto by tinyMCE
	*/
	tinyMCE.init({
		selector: '#texto',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});

	tinyMCE.init({
		selector: '#texto_gracias',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});


	//cambiar imagenes
	$(document).on('click', '.change-image', function(){

		contenedor = this.closest('div');
		img = $(contenedor).find('img');
		input = $(contenedor).find('input');

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
		      	class: 'btn btn-default',
		      	click: function() {
		        $( this ).dialog( "close" );
		      }
		    },
		    {
		    	text: 'Insertar imagen',
		    	class: 'btn btn-success',
		    	click: function () {
		    		newImage = $('.previewAtachment').val();
		    		//funcion que inserta la imagen en el lugar
		    		input.val(newImage);
		    		img.attr('src', '/uploads/images/' + newImage);
		    		//cierra dialogo de carga
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});

		$( "#dialog" ).dialog( 'open' )
		.load( 'inc/templates/media-browser.php' );
	});//clic cambiar imagen


	//guardar cambios
	$('#peticion_form').submit(function( e ){
		e.preventDefault();
		var mensaje = $('.mensaje-guardado');
		var formulario = $( this );
		var formData = new FormData( formulario[0] );
		
		$.ajax({
			type: 'POST',
			url: 'inc/save-peticion-page.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            },
			success: function ( response ) {
				console.log(response)
				
				mensaje.html(response)
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax

	});

});//ready peticion


/*
 CONTENIDO DELEGADOS
*/

$(document).ready(function(){
	$( "#laboratorioDelegados" ).accordion({
		heightStyle: "content",
		active: false,
		collapsible: true,
	});	


	//cambiar imagen
	$(document).on('click', '.btn-change-image-delegado', function(){
		var div = this.closest('div');
		var img = $(div).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar image 


	//agregar un ITEM
	$('.new-item-btn').click(function(){
		var type = $(this).attr('data-type');
		var contenedor = $('#laboratorioDelegados');
		var titulo = prompt('Escriba el título');
		var orden = 0;
		if ( titulo == '' ) {
			titulo = 'Escriba el título'
		}


		if ( type == 'video') {
			var html = '<h3 class="delegados-item-titulo">'+titulo+'</h3><div class="delegados-item"  data-type="'+type+'"><div class="row"><div class="col-sm-4"></div><div class="col-sm-8"><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="titulo" value="'+titulo+'"></label></div><div class="col-sm-2"><label>Orden:<br><input type="text" name="orden" value="'+orden+'"></label></div><div class="col-sm-12"><label>url:<br><input type="text" name="url" value=""></label></div></div></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-delegados-saved"></span><button class="btn btn-sm btn-success btn-save-delegado-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-delegado-item" data-id="new">Borrar elemento</button></p></div></div></div>';
		contenedor.prepend(html);
		} else {
			var html = '<h3 class="delegados-item-titulo">'+titulo+'</h3><div class="delegados-item"  data-type="'+type+'"><div class="row"><div class="col-sm-4"><img src="" data-href="" class="img-responsive"><button class="btn btn-xs btn-primary btn-change-image-delegado">Cambiar imagen</button></div><div class="col-sm-8"><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="titulo" value="'+titulo+'"></label></div><div class="col-sm-2"><label>Orden:<br><input type="text" name="orden" value="'+orden+'"></label></div><div class="col-sm-12"><label>url:<br><input type="text" name="url" value=""></label></div></div></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-delegados-saved"></span><button class="btn btn-sm btn-success btn-save-delegado-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-delegado-item" data-id="new">Borrar elemento</button></p></div></div></div>';
		contenedor.prepend(html);
		}

		
		
	});//click new-item-dlegados


	//borrar item
	$(document).on('click', '.btn-del-delegado-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('.delegados-item');
		var tituloContenedor = $(contenedor).prev();
		var msj = $(contenedor).find('.msj-delegados-saved');
		
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(contenedor).remove();
				tituloContenedor.remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-delegados.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(contenedor).remove();
		            	tituloContenedor.remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-pregunta-del-item


	//guardar cambios preguntas
	$(document).on('click', '.btn-save-delegado-item', function(){
		var fecha = '', texto = '';
		var idItem = $(this).attr('data-id');
		//var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('.delegados-item');
		var type = $(article).attr('data-type');
		var msj = $(article).find('.msj-delegados-saved');
		var btnDel = $(article).find('.btn-del-delegado-item');
		var titulo = $(article).find('input[name="titulo"]').val();
		var orden = $(article).find('input[name="orden"]').val();
		var imagen = $($(article).find('img')).attr('data-href');
		var link = $(article).find('input[name="url"]').val();

		if (type != 'menu') {
			fecha = $(article).find('input[name="fecha"]').val();
			texto = $(article).find('textarea[name="texto"]').val();
		}

		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}
			
		$.ajax( {
            type: 'POST',
            url: 'inc/save-delegados.php',
            data: {
            	idItem: idItem,
            	titulo: titulo,
            	orden: orden,
            	imagen: imagen,
            	link: link,
				newArticle: newArticle,
				fecha: fecha,
				texto: texto,
				type: type,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios

	//editor enriquecido de videos delegados
	tinyMCE.init({
		selector: '.tinymce-delegados',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});

});


/*
MUJERES Q HICIERON HISTORIA
*/
$(document).ready(function(){
	$( "#mujeresAdmin" ).accordion({
			heightStyle: "content",
			active: false,
			collapsible: true,
		});	
	
	
	tinyEditorMujeres();

	function tinyEditorMujeres() {
		tinyMCE.init({
		selector: '.tinymce-mujeres',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		//media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
		});
	}

	//cambiar imagen
	$(document).on('click', '.btn-change-image-mujeres', function(){
		var div = this.closest('div');
		var img = $(div).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar image 

	//agregar uno
	$('.new-mujeres-btn').click(function(){
		var contenedor = $('#mujeresAdmin');
		var titulo = prompt('Inserte el nombre');
		var orden = 0;
		if ( titulo == '' ) {
			titulo = 'Ingrese un nombre'
		}

		var html = '<h3 class="mujeres-item-titulo">'+titulo+'</h3><div class="mujeres-item"><div class="row"><div class="col-sm-4"><img data-herf="" class="img-responsive"><button class="btn btn-xs btn-primary btn-change-image-mujeres">Cambiar imagen</button></div><div class="col-sm-8"><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="mujeres_titulo" value="'+titulo+'"></label><label>Fecha:<br><input type="text" name="mujeres_fecha" value=""></label></div><div class="col-sm-2"><label>Orden:<br><input type="text" name="mujeres_orden" value="'+orden+'"></label></div><div class="col-sm-12"><label>Texto:<br><textarea class="tinymce-mujeres" name="mujeres_texto"></textarea></label></div></div></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-mujeres-saved"></span><button class="btn btn-sm btn-success btn-save-mujeres-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-mujeres-item" data-id="new">Borrar elemento</button></p></div></div></div>';

		contenedor.prepend(html);
		tinyEditorMujeres();
	});//click new-item-curso

	//borrar 
	$(document).on('click', '.btn-del-mujeres-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('.mujeres-item');
		var tituloContenedor = $(contenedor).prev();
		var msj = $(contenedor).find('.msj-mujeres-saved');
		
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(contenedor).remove();
				tituloContenedor.remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-mujeres.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(contenedor).remove();
		            	tituloContenedor.remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-curso-del-item


	//guardar cambios
	$(document).on('click', '.btn-save-mujeres-item', function(){
		var idItem = $(this).attr('data-id');
		//var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('.mujeres-item');
		var msj = $(article).find('.msj-mujeres-saved');
		var btnDel = $(article).find('.btn-del-mujeres-item');
		var inputs = $(article).find('input')
		var titulo = $($(article).find('input[name="mujeres_titulo"]')).val();
		var orden = $($(article).find('input[name="mujeres_orden"]')).val();
		var fecha = $($(article).find('input[name="mujeres_fecha"]')).val();
		var imagen = $($(article).find('img')).attr('data-href');
		var texto = $($(article).find('input[name="mujeres_texto"]')).val();

		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}
			
		$.ajax( {
            type: 'POST',
            url: 'inc/save-mujeres.php',
            data: {
            	idItem: idItem,
				titulo: titulo,
				fecha: fecha,
            	orden: orden,
            	imagen: imagen,
            	texto: texto,
            	newArticle: newArticle,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios

});//ready mujeres


/*
VIAJES
*/
$(document).ready(function(){
	$( "#viajesAdmin" ).accordion({
			heightStyle: "content",
			active: false,
			collapsible: true,
		});	
	
	
	tinyEditorviajes();

	function tinyEditorviajes() {
		tinyMCE.init({
		selector: '.tinymce-viajes',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height:100,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		//media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
		});
	}

	//cambiar imagen
	$(document).on('click', '.btn-change-image-viajes', function(){
		var div = this.closest('div');
		var img = $(div).find('img');

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
		      	class: 'btn btn-default',
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
		    		}
		    		//se incluye el nombre de la imagen como data para guardar en base de datos, solo nombre
					$(img).attr('data-href', newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'https://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					$(img).attr('src', urlimg);
					
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//cambiar image 

	//agregar uno
	$('.new-viajes-btn').click(function(){
		var contenedor = $('#viajesAdmin');
		var titulo = prompt('Inserte el nombre');
		var orden = 0;
		if ( titulo == '' ) {
			titulo = 'Ingrese un nombre'
		}

		var html = '<h3 class="viajes-item-titulo">'+titulo+'</h3><div class="viajes-item"><div class="row"><div class="col-sm-4"><img data-herf="" class="img-responsive"><button class="btn btn-xs btn-primary btn-change-image-viajes">Cambiar imagen</button></div><div class="col-sm-8"><div class="row"><div class="col-sm-10"><label>Título:<br><input type="text" name="viajes_titulo" value="'+titulo+'"></label></div><div class="col-sm-2"><label>Orden:<br><input type="text" name="viajes_orden" value="'+orden+'"></label></div><div class="col-sm-12"><label>Texto:<br><textarea class="tinymce-viajes" name="viajes_texto"></textarea></label></div></div></div></div><div class="row"><div class="col-sm-12"><p class="btns-item-footer"><span class="msj-viajes-saved"></span><button class="btn btn-sm btn-success btn-save-viajes-item" data-id="new">Guardar cambios</button>&nbsp;<button class="btn btn-sm btn-danger btn-del-viajes-item" data-id="new">Borrar elemento</button></p></div></div></div>';

		contenedor.prepend(html);
		tinyEditorviajes();
	});//click new-item-curso

	//borrar 
	$(document).on('click', '.btn-del-viajes-item', function(){
		var idItem = $(this).attr('data-id');
		var contenedor = this.closest('.viajes-item');
		var tituloContenedor = $(contenedor).prev();
		var msj = $(contenedor).find('.msj-viajes-saved');
		
		var confirmar = confirm('¿Está seguro?');
		if (confirmar) {
			//si el elemento es nuevo no está guardado en la bd
			if ( idItem == 'new' ) {
				$(contenedor).remove();
				tituloContenedor.remove();
				return;
			} else {
				$.ajax( {
		            type: 'POST',
		            url: 'inc/delete-item-viajes.php',
		            data: {
		                idItem: idItem,
		            },
		            beforeSend: function() {
		            	$(msj).html('borrando, espere');
		        	},
		            success: function ( response ) {
		            	$(contenedor).remove();
		            	tituloContenedor.remove();
		            },
		            error: function ( ) {
		                console.log('error');
		                $(msj).html('No se pudo borrar');
		            },
		        });//cierre ajax
			}
		}//if confirmar
	});//click btn-curso-del-item


	//guardar cambios
	$(document).on('click', '.btn-save-viajes-item', function(){
		var idItem = $(this).attr('data-id');
		//var post_type = $(this).attr('data-tipo');
		var btn = $(this);
		var article = this.closest('.viajes-item');
		var msj = $(article).find('.msj-viajes-saved');
		var btnDel = $(article).find('.btn-del-viajes-item');
		var inputs = $(article).find('input');
		var titulo = $($(article).find('input[name="viajes_titulo"]')).val();
		var orden =  $($(article).find('input[name="viajes_orden"]')).val();
		var imagen = $($(article).find('img')).attr('data-href');
		var texto = $(article).find('textarea').val();

		var newArticle = false;
		if ( idItem == 'new' ) {
				newArticle = true;
			}
			
		$.ajax( {
            type: 'POST',
            url: 'inc/save-viajes.php',
            data: {
            	idItem: idItem,
            	titulo: titulo,
            	orden: orden,
            	imagen: imagen,
            	texto: texto,
            	newArticle: newArticle,
            },
            beforeSend: function() {
            	$(msj).html('guardando, espere');
        	},
            success: function ( response ) {
            	console.log(response)
            	if ( response != 'ok' ) {
            		$(msj).html('Cambios guardados');
            		$(btnDel).attr('data-id', response);
            		btn.attr('data-id', response);
            	} 
            	$(msj).html('Cambios guardados');
            },
            error: function ( ) {
                console.log('error');
                $(msj).html('No se pudo guardar');
            },
        });//cierre ajax
	});//click guardar cambios

});//ready viajes