/*
 * Este modulo fue agregado para deportes y maneja directamente todos los scripts
*/

/*
* LIGA
*/

$(document).ready(function(){
    var currentPage = 0;
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
    $(document).on('click', '.btn-delete-liga', function( event ){
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

    /*
    * borrar partido
    */
    $(document).on('click', '.btn-delete-partido', function(e){
        e.preventDefault();
            
        var deletePost = false;
        var postToDelete = $(this).attr('href');
        var itemToDelete = $(this).closest('li');

        if ( confirm( '¿Está seguro de querer BORRAR el partido?' ) ) {
            if ( confirm( '¿REALMENTE Está seguro de querer BORRAR el partido? Se borrarán todos los goles, amonestaciones y contenidos.' ) ) {
                deletePost = true; 
            }  
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    post_id: postToDelete,
                    action: 'delete-partido'
                },
                success: function ( response ) {
                    console.log(response);
                    var respuesta = JSON.parse(response);
                    if (respuesta.status == 'ok') {
                        $(itemToDelete).remove()
                    } else {
                        alert('Hubo un error, no se pudo borrar');
                    }
                },
                error: function ( ) {
                    console.log('error');
                },
            });//cierre ajax
        }
    });

    
    /*
     * al cambiar la liga se actualizan las zonas
    */
    $(document).on('change', '#post_liga', function(e){
        var contenedor = $('#post_zona');
        var liga_id = $('#post_liga').val();

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
                    //console.log(response)
                    $(contenedor).empty()
                    .append( response );

                    recargarPartidos();
                },
                error: function ( error ) {
                    console.log(error);
                },
            });//cierre ajax
        }
    });


    /*
     * cambio select zona
    */
   $('#post_zona').change(function(){
        var categoria = $(this).val();//deporte
        if (categoria == 'todas') {
            categoria = '';
        }
        
        recargarPartidos();
        
    });//change

    /*
     * cambio deportes
    */
    $('#post_deportes').change(function(){
        var categoria = $(this).val();//deporte
        if (categoria == 'todas') {
            categoria = '';
        }
        
        recargarPartidos();
        
    });//change

    function recargarPartidos() {
        
        var deporte = $('#post_deportes').val();
        var liga =  $('#post_liga').val();
        var zona =  $('#post_zona').val();

        if ( deporte == 'todas' ) {
            deporte = '';
        }

        if ( liga == 'todas' ) {
            liga = '';
        }


        var buscar = 'filtro-partidos';
        var contenedorNews = $('.loop-noticias-backend');

        $.ajax( {
            type: 'POST',
            url: ajaxFunctionDir + '/filtro-deportes.php',
            data: {
                deporte: deporte,
                liga: liga,
                zona: zona,
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
        });//cierre ajax*/
    }

    /*
    * CLIC BOTON POSICIONESs
    */
    $(document).on('click', '#btn-posiciones', function(){
        var liga = $('select[name="post_liga"]').val();
        var zona = $('select[name="post_zona"]').val();

        if ( liga == 'todas' ) {
            alert('Debe seleccionar una liga');
            return true;
        }

        var buscar = 'posiciones';
        var contenedor = $('.wrapper-tabla-posiciones');

        $.ajax( {
            type: 'POST',
            url: ajaxFunctionDir + '/filtro-deportes.php',
            data: {
                liga: liga,
                zona: zona,
                buscar: buscar,
            },
            beforeSend: function() {
                contenedor.empty(); 
                contenedor.append($('<p>Cargando...</p>'));
            },
            success: function ( response ) {
                //console.log(response);
                var respuesta = JSON.parse(response);
                contenedor.empty().append(respuesta.html);
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax*/
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
                    //console.log(response)
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
                    
                    //console.log(response);
    
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
                //console.log(response);
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


/*
 * EDITAR PARTIDO
*/
$(document).ready(function(){
    //calcula la puntuacion
    calcularPuntuaciondeVoley();

    /*
     * calcula la puntuacion en voley
    */
    function calcularPuntuaciondeVoley() {
        var deporte = $('select[name="post_categoria"]').val();
        if ( deporte != 3 ) {
            //sino es voley no se aplica
            return true;
        }

        var score = $('.score');
        var score1 = 0;
        var score2 = 0;
        var input = $('input[name="sets1"]').val();
        var input2 = $('input[name="sets2"]').val();
        
        if ( input == '' && input2 == '' ) {

            $(score[0]).text(score1);
            $(score[1]).text(score2);

        } else {

            input = input.split(',');
            input2 = input2.split(',');

            var recorrido = input.length;
            if (input.length < input2.length) {
                recorrido = input2.length;
            }

            
            for (var i = 0; i < recorrido; i++) {
               
                if ( input[i] == undefined ){
                    input[i] = 0;
                }
                if ( input2[i] == undefined ){
                    input2[i] = 0;
                }

                if ( input[i] < input2[i] ) {
                    score2++;
                } 
                if ( input[i] > input2[i] ) {
                    score1++;
                }
                
            }
            
            $(score[0]).text(score1);
            $(score[1]).text(score2);
        }
    }

    //si es voley muestra agregar set, si es futbol agregar gol
    $('select[name="post_categoria"]').change(function(){
        var deporte = $(this).val();

        $('.campo-especial').toggleClass('campo-oculto');

        if (deporte == 3 ) {
            $('.campo-especial-voley').removeClass('campo-oculto');
            $('.campo-especial-futbol').addClass('campo-oculto');
            
            calcularPuntuaciondeVoley();

        } else {
            $('.campo-especial-voley').addClass('campo-oculto');
            $('.campo-especial-futbol').removeClass('campo-oculto');
        }
    });

    //hacer clic en agregar set
    $(document).on('click', '.btn-add-set', function(e){
        var wrapper = $(this).closest('.wrapper-goles');
        var input = $('input[name="sets1"]');
        
        var ul = $(wrapper).find('.sets');

        var index = $(ul).find('li').length;

        if ( $(ul).hasClass('equipo-data-der') ) {
            input = $('input[name="sets2"]');
        }

        var set = prompt('Ingrese los puntos de este set');

        if (set == null || set == undefined || set == ''){
            return true;
        }

        var html = '<li data-index="'+index+'">'+set+'<button class="btn del-set" type="button"><img class="img-responsive" src="'+administradorUrl+'/assets/images/ios-trash.png" alt="del-icon"></button></li>'

        $(ul).append( $(html) );

        //grabamos en el input
        var valores = $(input).val();
        if (valores == '') {
            $(input).val(set);
        } else {
            valores = valores.split(',');
            valores.push(set);
            valores = valores.join();
            $(input).val(valores);
        }

        calcularPuntuaciondeVoley();
    });

    //borra el set
    $(document).on('click', '.del-set', function(e){
        var input = $('input[name="sets1"]');
        var li = $(this).closest('li');
        var ul = $(this).closest('.sets');
        var index = $(li).attr('data-index');
       

        if ( $(ul).hasClass('equipo-data-der') ) {
            input = $('input[name="sets2"]');
        }

        $(li).remove();
        
        //borro del input
        var valores = $(input).val();
        valores = valores.split(',');

        if (valores.length == 1) {
            $(input).val('');
        } else {
            valores.splice(index, 1);
            valores = valores.join();
            $(input).val(valores);
        }

        var newLis = $(ul).find('li');
        var count=0;
        newLis.each(function(){
            $(this).attr('data-index', count);
            count++;
        });

        calcularPuntuaciondeVoley();

    });

    //cambiar equipo
    $(document).on('click', '.btn-edit-equipo', function(e){
        e.preventDefault();
        var oldequiposid = $( 'input[name="equipos_id"]' ).val();

        //contenedor del equipo
        var equiposWrapper = $('.equipo-wrapper');
        var zonaId = $('select[name="zona_id"]').val();
        var equipo1 = $(equiposWrapper[0]).attr('data-id');
        var equipo2 = $(equiposWrapper[1]).attr('data-id');
        var dataToLoad = {
            zona:zonaId,
            equipos:[equipo1, equipo2]
        }
        
        $( "#dialog" ).dialog({
            title: 'Elegir equipos',
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
                text: 'Agregar Equipo/s',
                class: 'btn btn-success',
                click: function () {
                        equipoNuevo1 = $('input[name="data_equipo1"]').val();
                        equipoNuevo2 = $('input[name="data_equipo2"]').val();
                        var newEquiposId = oldequiposid.split(',');

                        if ( equipoNuevo1 != '' ) {
                            loadDataAjaxPartido( 'equipo', equipoNuevo1, equiposWrapper[0] ); 
                            newEquiposId[0] = equipoNuevo1;
                        }

                        if ( equipoNuevo2 != '' ) {
                            loadDataAjaxPartido( 'equipo', equipoNuevo2, equiposWrapper[1] );
                            newEquiposId[1] = equipoNuevo2;
                        }
                        
                        //guardar los datos en el input hide de equipos id
                        $( 'input[name="equipos_id"]' ).val( newEquiposId.toString() );

                        //se cierra el dialogo
                        $( this ).dialog( "close" );
                    }
                },
            ],
        });
        $( "#dialog" ).dialog( 'open' ).load( templatesDir + '/team-browser.php', dataToLoad );


    });//cambiar equipo

    
    //agregar gol
    $(document).on('click', '.btn-add-gol', function(e){
        //para agregar gol tiene que haber dos equipos
        var equiposInput = $('input[name="equipos_id"]').val().split(',');
        if ( equiposInput < 2 ) {
            alert('Para agregar un gol tiene que guardar los cambios');
            return;
        }

        var golesCargadosInput1 = $( 'input[name="goles1"]' );
        var golesCargadosInput2 = $( 'input[name="goles2"]' );

        var equiposWrapper = $('.equipo-wrapper');
        var deporte = $('select[name="post_categoria"]').val();
        var equipo1 = $(equiposWrapper[0]).attr('data-id');
        var equipo2 = $(equiposWrapper[1]).attr('data-id');
        var dataToLoad = {
            deporte:deporte,
            equipos:[equipo1, equipo2],
            faltas:0,
        }

        $( "#dialog" ).dialog({
            title: 'Elegir Jugador',
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
                text: 'Agregar',
                class: 'btn btn-success',
                click: function () {
                        jugadoresNuevos1 = $('input[name="data_jugador1"]').val();
                        jugadoresNuevos2 = $('input[name="data_jugador2"]').val();
                        
                        if ( jugadoresNuevos1 != '' ) {
                            
                            var golesCargadosInput1 = $( 'input[name="goles1"]' );
                            var contenedorGoles = $(equiposWrapper[0]).find('.goles');
                            
                            //se busca la data de los jugadores por ajax
                            jugadoresNuevos1 = jugadoresNuevos1.split(',');

                            for (var i = 0; i < jugadoresNuevos1.length; i++) {
                                loadDataAjaxPartido( 'gol-jugador', jugadoresNuevos1[i], contenedorGoles, golesCargadosInput1 );
                            }
                         
                        }

                        if ( jugadoresNuevos2 != '' ) {
                            
                            var contenedorGoles = $(equiposWrapper[1]).find('.goles');
                            var golesCargadosInput2 = $( 'input[name="goles2"]' );

                            //se busca la data de los jugadores por ajax
                            jugadoresNuevos2 = jugadoresNuevos2.split(',');
                            
                            for (var i = 0; i < jugadoresNuevos2.length; i++) {
                                loadDataAjaxPartido( 'gol-jugador', jugadoresNuevos2[i], contenedorGoles, golesCargadosInput2 );
                            }
                         
                        }

                        //se cierra el dialogo
                        $( this ).dialog( "close" );
                    }
                },
            ],
        });
        $( "#dialog" ).dialog( 'open' ).load( templatesDir + '/player-browser.php', dataToLoad );


    });//agregar gol

    //agregar amonestacion
    $(document).on('click', '.btn-add-amonestacion', function(e){
        
        //para agregar amonestacion tiene que haber dos equipos
        var equiposInput = $('input[name="equipos_id"]').val().split(',');
        if ( equiposInput < 2 ) {
            alert('Para agregar una falta tiene que guardar los cambios');
            return;
        }

        var golesCargadosInput1 = $( 'input[name="goles1"]' );
        var golesCargadosInput2 = $( 'input[name="goles2"]' );

        var equiposWrapper = $('.equipo-wrapper');
        var deporte = $('select[name="post_categoria"]').val();
        var equipo1 = $(equiposWrapper[0]).attr('data-id');
        var equipo2 = $(equiposWrapper[1]).attr('data-id');
        var dataToLoad = {
            deporte:deporte,
            equipos:[equipo1, equipo2],
            faltas:1,
        }

        $( "#dialog" ).dialog({
            title: 'Elegir Jugador',
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
                    $(this).dialog('close');
            }
            },
            {
                text: 'Agregar',
                class: 'btn btn-success',
                click: function () {
                        jugadoresNuevos1 = $('input[name="data_jugador1"]').val();
                        jugadoresNuevos2 = $('input[name="data_jugador2"]').val();
                        
                        if ( jugadoresNuevos1 != '' ) {
                            
                            var amonestacionesInput = $( 'input[name="amonestaciones1"]' );
                            var contenedorAmonestaciones = $(equiposWrapper[0]).find('.amonestaciones');
                            
                            //se busca la data de los jugadores por ajax
                            jugadoresNuevos1 = jugadoresNuevos1.split(',');

                            for (var i = 0; i < jugadoresNuevos1.length; i++) {
                                loadDataAjaxPartido( 'amonestaciones', jugadoresNuevos1[i], contenedorAmonestaciones, amonestacionesInput );
                            }
                         
                        }

                        if ( jugadoresNuevos2 != '' ) {
                            
                            var amonestacionesInput = $( 'input[name="amonestaciones2"]' );
                            var contenedorAmonestaciones = $(equiposWrapper[1]).find('.amonestaciones');
                            
                            //se busca la data de los jugadores por ajax
                            jugadoresNuevos2 = jugadoresNuevos2.split(',');

                            for (var i = 0; i < jugadoresNuevos2.length; i++) {
                                loadDataAjaxPartido( 'amonestaciones', jugadoresNuevos2[i], contenedorAmonestaciones, amonestacionesInput );
                            }
                         
                        }

                        //se cierra el dialogo
                        $(this).dialog('close');
                    }
                },
            ],
        });
        $( "#dialog" ).dialog( 'open' ).load( templatesDir + '/player-browser.php', dataToLoad );

    });//agregar amnonestacion


    
    //agregar PUNTUACION
    $(document).on('click', '.btn-add-puntuacion', function(e){
        //para agregar PUNTUACION tiene que haber dos equipos
        var equiposInput = $('input[name="equipos_id"]').val().split(',');
        if ( equiposInput < 2 ) {
            alert('Para agregar la puntuación tiene que guardar los cambios');
            return;
        }

        var score = $('.score');

        if ( confirm( 'ATENCIÓN: Al habilitar la puntuación se borra el recuento mediante goles.' )  ) {
            var equipo1 =prompt('Ingresar puntuación del equipo 1');
            var equipo2 =prompt('Ingresar puntuación del equipo 2');
            var inputPuntuacion = $( 'input[name="puntuacion"]' );

            if ( equipo1 == '' || equipo2 == '' ) {
                alert('Si se omite entrada de datos, la  puntuación se anula');
                $(inputPuntuacion).val( '' );    
                $(score[0]).text('0');
                $(score[1]).text('0');

            } else {
                $(inputPuntuacion).val( equipo1+','+equipo2 );
                $(score[0]).text(equipo1);
                $(score[1]).text(equipo2);
            }
        }
    });

    //agregar contenido
    $(document).on('click', '.add-contenido', function(e){
       //para agregar contenido tiene que tener un id el partido
        if ( $('input[name="post_ID"]').val() == 'new' ) {
            e.preventDefault();
            alert('Para agregar contenido necesita guardar los cambios primero.');
            return true;
        }
    });//agregar contenido
    

    //borrar gol
    $(document).on('click', '.del-gol', function(e){
        e.preventDefault();
        var li = $(this).closest('li');
        var id = $(li).attr('data-id-gol');
        var idjugador = $(li).attr('data-id-jugador');
        var error = $('.error-msj-list');
        var partidoId = $('input[name="post_ID"]').val();
        
        var deletePost = false;

        if ( confirm( '¿Está seguro de querer BORRAR?' ) ) {
            deletePost = true; 
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    id: id,
                    partido: partidoId,
                    action: 'delete-gol',
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
    });//del-gol

    //borrar amonestacion
    $(document).on('click', '.del-amonestacion', function(e){
        e.preventDefault();
        var li = $(this).closest('li');
        var id = $(li).attr('data-id-amonestacion');
        var idjugador = $(li).attr('data-id-jugador');
        var error = $('.error-msj-list');
        var partidoId = $('input[name="post_ID"]').val();

        var deletePost = false;

        if ( confirm( '¿Está seguro de querer BORRAR?' ) ) {
            deletePost = true; 
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    id: id,
                    partido: partidoId,
                    action: 'delete-amonestacion',
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
    });//del-amonestacion

    //borrar contenido
    $(document).on('click', '.btn-del-contenido', function(e){
        e.preventDefault();
        var id = $(this).attr('data-contenido');
        var error = $('.error-msj-list');
        var partidoId = $('input[name="post_ID"]').val();

        var deletePost = false;

        if ( confirm( '¿Está seguro de querer BORRAR?' ) ) {
            deletePost = true; 
        }

        if (deletePost) {
            $.ajax( {
                type: 'POST',
                url: ajaxFunctionDir + '/delete-deportes.php',
                data: {
                    id: id,
                    partido: partidoId,
                    action: 'delete-contenido',
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
    });//del-amonestacion

    /*
     * SUBMIT FORMULARIO PARTIDO
    */
    $(document).on('submit', '#editar-partido-form', function(e){
        e.preventDefault();
        var error = $('.error-msj-list');
        
        //controla de que haya dos equipos, sino no se puede guardar
        var equipos =$('input[name="equipos_id"]').val().split(',');
        if ( equipos < 2 ) {
            error.append( '<li class="error-msj-list-item-danger">Tiene que haber dos equipos</li>');
            return;
        }

        if ( equipos[0] == equipos[1] ) {
            error.append( '<li class="error-msj-list-item-danger">No puede haber dos equipos iguales</li>');
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
                //console.log(response);
                var respuesta = JSON.parse(response);
                switch(respuesta.status) {

                    case 'error':
                        error.append( '<li class="error-msj-list-item-danger">Hubo un error, no se pudo guardar</li>');
                    break;

                    case 'updated':
                        error.append( '<li class="error-msj-list-item-danger">Los Cambios fueron guardados</li>');
                        scrollHaciaArriba();
                    break;
                        
                    //devuelve id para reload
                    case 'post-made':
                        var url = window.location.href;
                        url += '&id=';
                        url += respuesta.id;
                        window.location.href = url;
                    break;
                }
            },
            error: function ( error ) {
                console.log(error);
            },
        });//cierre ajax
        
    });//submit
});//READY EDITAR PARTIDO

/*
 * esta funcion agrega datos al partido, por ejemplo equipo, jugador, etc
 * recibe dos parametros, el primero es que tiene que agregar (equipo, jugador, etc), el segundo el id de lo que va buscar
*/
function loadDataAjaxPartido( tipo, id, contenedor, input ) {
    var error = $('.error-msj-list');
    var partidoId = $('input[name="post_ID"]').val();

    $.ajax({
        type: 'POST',
        url: ajaxFunctionDir + '/editar-deportes-ajax.php',
        data: {
            action:'load-data-partido',
            tipo:tipo,
            id:id,
            partidoId:partidoId,
        },
        //funcion antes de enviar
        beforeSend: function() {
            console.log('enviando formulario');
        },
        success: function ( response ) {
            //console.log(response);
            var respuesta = JSON.parse(response);

            if (respuesta.error != 'ok') {
                error.append( '<li class="error-msj-list-item-danger">Hubo un error, no se pudo crear el gol</li>');
            } else {
                //esta funcion escribe el html
                WriteDataOnHTML( tipo, respuesta, contenedor );

                //si es un gol entonces se agregan al input y se guarda el partido
                if ( tipo == 'gol-jugador' ) {
                    
                    if ( $(input).val() == '' ) {
                        $(input).val(respuesta.gol);
                    } else {
                        var gvalor = $(input).val();
                        gvalor += ',' + respuesta.gol;
                        $(input).val(gvalor);
                    }

                    $('#editar-partido-form').submit();
                }

                if ( tipo == 'amonestaciones' ) {
                    
                    if ( $(input).val() == '' ) {
                        $(input).val(respuesta.falta.id);
                    } else {
                        var gvalor = $(input).val();
                        gvalor += ',' + respuesta.falta.id;
                        $(input).val(gvalor);
                    }

                    $('#editar-partido-form').submit();
                }
            }
        },
        error: function ( error ) {
            console.log(error);
        },
    });//cierre ajax
}//loadDataAjaxPartido


function WriteDataOnHTML( tipo, respuesta, contenedor ) {
    switch (tipo) {
        case 'equipo':
            var imagen = administradorUrl + '/assets/images/logo.png';
            if ( respuesta.data.logo != '' ) {
                imagen = uploadsDir + '/images/' + respuesta.data.logo;
            }
            
            $(contenedor).find('.nombre_equipo').text(respuesta.data.nombre);
            $(contenedor).find('.logo-equipos').attr('src',imagen);
            $(contenedor).attr('data-id', respuesta.data.id);

        break;

        case 'gol-jugador':
            var imagen = administradorUrl + '/assets/images/default-staff-image.png';
            if ( respuesta.data.imagen != '' ) {
                imagen = uploadsDir + '/images/' + respuesta.data.imagen;
            }
            
            var html = '<li data-id-gol="'+respuesta.gol+'" data-id-jugador="'+respuesta.data.id+'">'+respuesta.data.nombre+'<button class="btn del-gol" type="button"><img class="img-responsive" src="'+administradorUrl+'/assets/images/ios-trash.png" alt="del-icon"></button></li>';
            $(contenedor).append( $(html) );
            
            //anotar un gol en el html
            var score = $($(contenedor).closest('article')).find('.score');

            score.text( parseInt( score.text() ) + parseInt(1) );

            
        break;

        case 'amonestaciones':
            var imagen = administradorUrl + '/assets/images/default-staff-image.png';
            if ( respuesta.data.imagen != '' ) {
                imagen = uploadsDir + '/images/' + respuesta.data.imagen;
            }
            
            var html = '<li data-id-amonestacion="'+respuesta.falta.id+'" data-id-jugador="'+respuesta.data.id+'"><span class="jugador">'+respuesta.data.nombre+'</span> <span class="tipo-amonestacion '+respuesta.falta.tipo+'"></span><button class="btn del-amonestacion" type="button"><img class="img-responsive" src="'+administradorUrl+'/assets/images/ios-trash.png" alt="del-icon"></button></li>';

            $(contenedor).append( $(html) );

        break;
    }
}


