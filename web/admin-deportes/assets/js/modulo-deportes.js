/*
 * Este modulo fue agregado para deportes y maneja directamente todos los scripts
*/

/*
* LIGA
*/

$(document).ready(function(){
    
    /*
    * FILTRA POR DEPORTE U OTROS
    * la variable buscar que esta en el atributo data-filtro del selec le indica que buscar en el php
    */
   $('#post_categoria').change(function(){
        var categoria = $(this).val();//deporte
        if (categoria == 'todas') {
            categoria = '';
        }
        
        var buscar = $(this).attr('data-filtro');
        var contenedorNews = $('.loop-noticias-backend');
        
        $.ajax( {
            type: 'POST',
            url: ajaxFunctionDir + '/filtro-deportes.php',
            data: {
                categoria: categoria,
                buscar: buscar,
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
    * BORRAR LIGA
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

    /*
    * borrar equipo
    */
    $(document).on('click', '.btn-delete-equipo', function(e){
        e.preventDefault();
            
        var deletePost = false;
        var postToDelete = $(this).attr('href');
        var itemToDelete = $(this).closest('li');

        if ( confirm( '¿Está seguro de querer BORRAR el equipo?' ) ) {
            if ( confirm( '¿REALMENTE Está seguro de querer BORRAR el equipo? Se borrarán todos los jugadores' ) ) {
                deletePost = true; 
            }  
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    post_id: postToDelete,
                    action: 'delete-equipo'
                },
                success: function ( response ) {
                    console.log(response);
                    if (response == 'ok') {
                        $(itemToDelete).remove()
                    }
                },
                error: function ( ) {
                    console.log('error');
                },
            });//cierre ajax
        }
    });

});//READY LOOP INDEX


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

        if (ligaId == 'new' ) {
            alert('ATENCION, para crear una zona primero tiene que guardar los cambios');
            return true;
        }

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
        event.preventDefault();
        
        var deletePost = false;
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
                    
                        //se actualiza la ventana así trae los cambios hechos
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
     * CAMBIAR NOMBRE DE ZONA
    */
    function escribirZona( zona ) {
        
        var zonaId =$(zona).find('input[name="zona_id"]').val();
        var valor = $(zona).find('input[name="nombre_zona"]').val();
        var partidos = $(zona).find('input[name="partidos_id"]').val();
        var equipos = $(zona).find('input[name="equipos_id"]').val();
        var ligaId = $('input[name="post_ID"]').val();
        console.log(zonaId,valor,partidos,equipos,ligaId);

        $.ajax({
            type: 'POST',
            url: ajaxFunctionDir + '/editar-deportes-ajax.php',
            data: {
                action: 'escribir-zona',
                liga_id: ligaId,
                zona_id: zonaId,
                nombre_zona:valor,
                partidos_id:partidos,
                equipos_id:equipos,
            },
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                
                console.log(response);

            },
            error: function ( error ) {
                console.log(error);
            },
        });//cierre ajax
    }

    var intervalZonaId;
    var editandoZona = false;
    $(document).on('keyup', '.nombre_zona', function(e){

        var zona = $(this).closest('.zona');

        //chequea si esta creando o no
        if ( editandoZona ) {
            clearInterval(intervalZonaId);
            intervalZonaId = setTimeout(function(){
                escribirZona( zona );
            },1500);
        } else {
            editandoZona = true;
            intervalZonaId = setTimeout(function(){
                escribirZona( zona );
            },1500);
        }

    });//on clic crear zona

    //al hacer clic fuera del input del nombre de la zona
    $(document).on('blur', '.nombre_zona', function(e){

        var zona = $(this).closest('.zona');

        if ( editandoZona ) {
            clearInterval(intervalZonaId);
            escribirZona( zona );
        } else {
            escribirZona( zona );
        }
        
    });//on clic crear zona
    

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


/*
* EDITAR EQUIPOS
*/

$(document).ready(function(){

    /*
     * al cambiar la liga se actualizan las zonas
    */
    $(document).on('change', '#liga_id', function(e){
        var contenedor = $('#zona_id');
        var liga_id = $('#liga_id').val();

        if ( liga_id == '') {
            $(contenedor).empty();
            $(contenedor).append( $('<option>Elija una liga</option>') );
        } else {

            $.ajax({
                type: 'POST',
                url: ajaxFunctionDir + '/filtro-deportes.php',
                data: {
                    buscar: 'zonas-by-liga',
                    categoria: liga_id,
                },
                //funcion antes de enviar
                beforeSend: function() {
                    console.log('enviando formulario');
                },
                success: function ( response ) {
                    console.log(response)
                    $(contenedor).empty()
                    .append( response );
                },
                error: function ( error ) {
                    console.log(error);
                },
            });//cierre ajax
        }
    });

    /*
     * agregar jugador
    */
    $(document).on('click', '#agregar-jugador-btn', function(e){
        var equipoID = $('input[name="post_ID"]').val();
        if (equipoID == 'new' ) {
            alert('ATENCION, para crear un jugador primero tiene que guardar los cambios del equipo');
            return true;
        }

        var contenedor = $('.tabla-jugadores');
        var jugadores_input =$('input[name="jugadores_id"]');
        var jugadores_val = $(jugadores_input).val();

        $.ajax({
            type: 'POST',
            url: ajaxFunctionDir + '/editar-deportes-ajax.php',
            data: {
                action: 'nuevo-jugador',
                equipo_id: equipoID,
            },
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                //console.log(response);
                var respuesta = JSON.parse(response)
                
                if ( respuesta.error == '' ) {
                    //agrega el template
                    $(contenedor).append(respuesta.html);
                
                    //agrega las zonas id
                    if (jugadores_val == '') {
                        jugadores_val = respuesta.msj;
                    } else {
                        jugadores_val += ',' + respuesta.msj;
                    }
                    
                    $(jugadores_input).val(jugadores_val);
                }

            },
            error: function ( error ) {
                console.log(error);
            },
        });//cierre ajax

    });//on clic crear jugador


    /*
     * borrar jugador
    */
    $(document).on('click', '.borrar-jugador-btn', function(e){
        e.preventDefault();
            
        var deletePost = false;
        var postToDelete = $(this).attr('data-id');
        var itemToDelete = $(this).closest('tr');

        if ( confirm( '¿Está seguro de querer BORRAR el jugador?' ) ) {
            deletePost = true; 
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    post_id: postToDelete,
                    action: 'delete-jugador'
                },
                success: function ( response ) {
                    console.log(response);
                    if (response == 'ok') {
                        //se actualiza la ventana así trae los cambios hechos
                        window.location.reload();
                    }
                },
                error: function ( ) {
                    console.log('error');
                },
            });//cierre ajax
        }
    });

    /*
     * CAMBIAR NOMBRE DE ZONA
    */
    function escribirZona( zona ) {
        
        var zonaId =$(zona).find('input[name="zona_id"]').val();
        var valor = $(zona).find('input[name="nombre_zona"]').val();
        var partidos = $(zona).find('input[name="partidos_id"]').val();
        var equipos = $(zona).find('input[name="equipos_id"]').val();
        var ligaId = $('input[name="post_ID"]').val();
        console.log(zonaId,valor,partidos,equipos,ligaId);

        $.ajax({
            type: 'POST',
            url: ajaxFunctionDir + '/editar-deportes-ajax.php',
            data: {
                action: 'escribir-zona',
                liga_id: ligaId,
                zona_id: zonaId,
                nombre_zona:valor,
                partidos_id:partidos,
                equipos_id:equipos,
            },
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                
                console.log(response);

            },
            error: function ( error ) {
                console.log(error);
            },
        });//cierre ajax
    }

    /*
     * CAMBIAR NOMBRE JUGADOR
    */
    function escribirJugador( jugador, id ) {
        
        var id = $(jugador).find('.imagen-jugador-btn').attr('data-id');
        var nombre = $(jugador).find('input[name="nombre_jugador"]').val();
        var imagen = $(jugador).find('input[name="imagen_jugador"]').val();
        var equipo = $('input[name="post_ID"]').val();

        $.ajax({
            type: 'POST',
            url: ajaxFunctionDir + '/editar-deportes-ajax.php',
            data: {
                action: 'escribir-jugador',
                id:id,
                nombre:nombre,
                imagen:imagen,
                equipo:equipo,
            },
            //funcion antes de enviar
            beforeSend: function() {
                console.log('enviando formulario');
            },
            success: function ( response ) {
                
                console.log(response);

            },
            error: function ( error ) {
                console.log(error);
            },
        });//cierre ajax
    }
    var intervalJugadorId;
    var editandoJugador = false;
    $(document).on('keyup', 'input[name="nombre_jugador"]', function(e){

        var jugador = $(this).closest('tr');

        //chequea si esta creando o no
        if ( editandoJugador ) {
            clearInterval(intervalJugadorId);
            intervalJugadorId = setTimeout(function(){
                escribirJugador( jugador );
            },1500);
        } else {
            editandoJugador = true;
            intervalJugadorId = setTimeout(function(){
                escribirJugador( jugador );
            },1500);
        }

    });//on clic crear zona

    //al hacer clic fuera del input del nombre de la zona
    $(document).on('blur', 'input[name="nombre_jugador"]', function(e){

        var jugador = $(this).closest('tr');

        if ( editandoJugador ) {
            clearInterval(intervalJugadorId);
            
            escribirJugador( jugador );
           
        } else {
            
            escribirJugador( jugador );
            
        }

    });//on clic crear zona

    /*
     * al borrar zona se borra en la tabla de zonas el equipo
     * esto se realiza porque si había una zona seleccionada y se cambia a otra, al guardar los cambios, se guardara este equipo en la nueva zona, pero no se borrara de la antigua zona, por lo tanto, esta función corrige ese error, al cambiar la zona, borra al equipo de la zona original.
     * Luego, al guardar los cambios del equipo se lo guardará en la zona nueva indicada o en ninguna, como sea.
    */
    var zonaOriginal = $('#zona_id').val();
    
    $(document).on('change', '#zona_id', function(e){
        
        if ( zonaOriginal == '' ) {
            return true;
        }

        var zonaChange = $('#zona_id').val();
        if ( zonaOriginal != zonaChange ) {
            var equipo = $('input[name="post_ID"]').val();
            $.ajax({
                type: 'POST',
                url: ajaxFunctionDir + '/editar-deportes-ajax.php',
                data: {
                    action: 'borrar-zona-de-equipo',
                    zona:zonaOriginal,
                    equipo: equipo,
                },
                //funcion antes de enviar
                beforeSend: function() {
                    console.log('enviando formulario');
                },
                success: function ( response ) {
                    
                    console.log(response);
    
                },
                error: function ( error ) {
                    console.log(error);
                },
            });//cierre ajax
        }
        
    });


    /*
    * SUBIR IMAGEN LOGO EQUIPO
    */
    $(document).on('click','.btn-change-logo-equipos',function(){
        var imagen = $('.logo-equipos');

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
                        $('#logo').val(newImage);
                        //se genera url completo de la imagen para mostrar ahora
                        urlimg = uploadsDir + '/images/' + newImage;
                        //se imprime el html con el url de la imagen
                        $(imagen).attr( 'src', urlimg );
                        
                        //se cierra el dialogo
                        $( this ).dialog( "close" );
                    }
                },
            ],
        });
        $( "#dialog" ).dialog( 'open' ).load( templatesDir + '/media-browser.php' );
    });
    /*
     * cambiar imagen jugador
    */
   
    $(document).on('click','.imagen-jugador-btn',function(){
        var contenedor = $(this).closest('tr');
        var inputImagen = $(contenedor).find('input[name="imagen_jugador"]');
        var imagen = $(contenedor).find('.imagen-jugador');

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
                        $(inputImagen).val(newImage);
                        //se genera url completo de la imagen para mostrar ahora
                        urlimg = uploadsDir + '/images/' + newImage;
                        //se imprime el html con el url de la imagen
                        $(imagen).attr( 'src', urlimg );
                        //se guarda al jugador
                        escribirJugador( contenedor );
                        
                        //se cierra el dialogo
                        $( this ).dialog( "close" );
                    }
                },
            ],
        });
        $( "#dialog" ).dialog( 'open' ).load( templatesDir + '/media-browser.php' );
    });

    /*
     * SUBMIT FORMULARIO GRAL DEL TEMPLATE
    */
    $(document).on('submit', '#editar-equipo-form', function(e){
        e.preventDefault();
        var error = $('.error-msj-list');
        
        //reconfigura la zonaorignal para que no hay conflictos
        zonaOriginal = $('#zona_id').val();

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

                    case 'error-equipo':
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
});