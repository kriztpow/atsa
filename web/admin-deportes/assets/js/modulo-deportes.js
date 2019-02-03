/*
 * Este modulo fue agregado para deportes y maneja directamente todos los scripts
*/

/*
* LIGA
*/

$(document).ready(function(){
    
    /*
    * FILTRA POR DEPORTE
    */
   $('#post_categoria').change(function(){
        var categoria = $(this).val();//deporte
        if (categoria == 'todas') {
            categoria = '';
        }
    
        var contenedorNews = $('.loop-noticias-backend');
        $.ajax( {
            type: 'POST',
            url: ajaxFunctionDir + '/filtro-deportes.php',
            data: {
                categoria: categoria,
            },
            beforeSend: function() {
                contenedorNews.empty(); 
                $('.info-resumen').remove();       
            },
            success: function ( response ) {
                contenedorNews.append(response);
                currentPage = 1;
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
    });//change

    /*
    * BORRAR POST
    */
    $(document).on('click', '.btn-delete-post', function( event ){
        var deletePost = false;
        event.preventDefault();
        var postToDelete = $(this).attr('href');
        var itemToDelete = this.closest('li');
        if ( confirm( '¿Está seguro de querer BORRAR la liga?' ) ) {
            if ( confirm( '¿REALMENTE Está seguro? Se van a borrar todas las zonas y partidos' ) ) {
                deletePost = true;
            }
            
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    post_id: postToDelete,
                    action: 'delete-liga'
                },
                success: function ( response ) {
                    console.log(response);
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

});//READY LIGA


/*
* EDITAR LIGA
*/

$(document).ready(function(){

    /*
    * coloca url automaticamente con el título
    */
   $('#post_title').focusout(function(){
        //primero chequea que no tenga ya un url, si lo tiene se anula
        var titulo = $(this).val();
        var url = $('#post_url');

        if (url.val() == '') {
            var newTitulo = getCleanedString(titulo);
            url.val(newTitulo);
        }
    });

    /*
     * agregar zona
    */
    $(document).on('click', '#agregar-zona-btn', function(e){
        var contenedor = $('.zonas');
        var ligaId = $('input[name="post_ID"]').val();
        var zonasIdInput =$('input[name="zonas_id"]');
        var zonasVal = $(zonasIdInput).val();

        $.ajax({
            type: 'POST',
            url: ajaxFunctionDir + '/editar-deportes-ajax.php',
            data: {
                action: 'nueva-zona',
                ligaId: ligaId,
            },
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                
                var respuesta = JSON.parse(response)
                //console.log(respuesta);
                if ( respuesta.error == '' ) {
                    //agrega el template
                    $(contenedor).append(respuesta.html);
                   
                    //agrega las zonas id
                    zonasVal += ',' + respuesta.msj;
                    $(zonasIdInput).val(zonasVal);
                }

            },
            error: function ( error ) {
                console.log(error);
            },
        });//cierre ajax

    });//on clic crear zona


    /*
    * BORRAR ZONA
    */
    $(document).on('click', '.borrar-zona-btn', function( event ){
        var deletePost = false;
        event.preventDefault();
        var postToDelete = $(this).attr('data-id');
        var itemToDelete = this.closest('.zona');

        if ( confirm( '¿Está seguro de querer BORRAR la zona?' ) ) {
            if ( confirm( '¿REALMENTE Está seguro? Se van a borrar todos los partidos' ) ) {
                deletePost = true;
            }
            
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    post_id: postToDelete,
                    action: 'delete-zona'
                },
                success: function ( response ) {
                    console.log(response);
                    if (response == 'ok') {
                    
                        //myFunctionNoticias();
                        window.location.reload();
                    }
                },
                error: function ( ) {
                    console.log('error');
                },
            });//cierre ajax
        }
    });//click .btn-delete-post


    /*
     * SUBMIT FORMULARIO GRAL DEL TEMPLATE
    */
    $(document).on('submit', '#editar-liga-form', function(e){
        e.preventDefault();
        var error = $('.error-msj-list');
        
        //primero revalidamos que el titulo y el url esten,sino estan hay un error
        //el título no puede estar vacío
        if ( $('#post_title').val() == '' ) {
            error.append( '<li class="error-msj-list-item-danger">El título no puede estar vacío</li>');
            return;
        }
        //la url no puede estar vacía
        if ( $('#post_url').val() == '' ) {
            error.append( '<li class="error-msj-list-item-danger">La URL no puede estar vacía</li>');
            return;
        }

        //datos del formulario:
        var formulario = $( this );
        var formData = new FormData( formulario[0] );

        //envia el formulario
        $.ajax({
            type: 'POST',
            url: ajaxFunctionDir + '/editar-deportes-ajax.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                console.log(response);
                switch(response) {

                    case 'error-url':
                        error.append( '<li class="error-msj-list-item-danger">Ya existe una entrada con ese URL</li>');
                    break;

                    case 'updated':
                        error.append( '<li class="error-msj-list-item-danger">Los Cambios fueron guardados</li>');
                        scrollHaciaArriba();
                    break;

                    case 'error-zona':
                    case 'error-liga':
                        error.append( '<li class="error-msj-list-item-danger">Hubo un pequeño error</li>');
                    break;
                        
                    //devuelve id para reload
                    default :
                        var url = window.location.href;
                        url += '&id=';
                        url += response;
                        window.location.href = url;
                    break;
                }
            },
            error: function ( error ) {
                console.log(error);
            },
        });//cierre ajax
        
    });//submit


});//READY EDITAR LIGA