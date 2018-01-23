$(document).ready(function () {

	/*
	CLIC EN BOTON BORRAR EVENTO
	*/
	$(document).on('click', '.btn-delete-evento', function(){
		
		var li = this.closest('li');
		var id = $(li).find('.agenda_id').val();
		
		if ( confirm( '¿Está seguro de querer BORRAR este evento?' ) ) {

			if ( id == 'new') {

				$(li).remove();

			} else {
				$.ajax( {
		            type: 'POST',
		            url: ajaxFunctionDir + '/delete-evento.php',
		            data: {
		                evento: id,
		            },
		            success: function ( response ) {
		            	if (response == 'deleted') {
		            	//borra el slider del front
		                	$(li).remove();
		                } else {
		                	$(li).find('.error-msj-list').text('Hubo un error');
		                }
		            },
		            error: function ( ) {
		                console.log('error');
		            },
		        });//cierre ajax
			}//else

		}//if
	});


	/*
	CLIC EN GUARDAR EVENTO
	*/
	$(document).on('click', '.btn-save-evento', function(){
	
		var li = this.closest('li');
		var id = $(li).find('.agenda_id').val();
		var titulo = $(li).find('.agenda_titulo').val();
		var descripcion = $(li).find('.agenda_descripcion').val();
		var url = $(li).find('.agenda_url').val();
		var categoria = $(li).find('.agenda_categoria').val();
		var fechaIn = $(li).find('.agenda_fecha_in').val();
		var fechaOut = $(li).find('.agenda_fecha_out').val();
		var horaInicio = $(li).find('.agenda_hora_in').val();
		var horaFinal = $(li).find('.agenda_hora_out').val();

		if ( fechaIn == '' ) {
			return;
		}

		if ( horaInicio == '' ) {
			return;
		}

		if ( url == '' ) {
			url = getCleanedString(titulo);
			$(li).find('.agenda_url').val(url);
		}

		$.ajax( {
            type: 'POST',
            url: ajaxFunctionDir + '/save-evento.php',
            data: {
                id: id,
                titulo: titulo,
                descripcion: descripcion,
                url: url,
                fechaIn: fechaIn,
                fechaOut: fechaOut,
                horaInicio: horaInicio,
                horaFinal: horaFinal,
                categoria: categoria,
            },
            success: function ( response ) {
            	console.log(response);
            	if ( response == 'ok' ) {
            		$(li).find('.error-msj-list').text('Elemento guardado');
            	} else if ( response == 'nuevo' ) {
            		location.reload();
            	} else {
            		$(li).find('.error-msj-list').text('Hubo un error, intente más tarde');
            	}
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax
		
	});


	/*
	CLIC EN BOTON CREAR EVENTO
	*/
	$(document).on('click', '#new-evento', function(){

		var contenedor = $('.lista-eventos');
		
		var hoy = new Date();
		var dd = hoy.getDate();
		var mm = hoy.getMonth()+1;
		var yyyy = hoy.getFullYear();
		
		if(mm<10) {
		    mm='0'+mm
		} 

		var fechaIn = yyyy+'-'+mm+'-'+dd;
		var horaDefault = '19:00:00';
		var horaDefaultOut = '19:00:00';
		
		var html = '<li class="evento"><input type="hidden" name="agenda_id" value="new" class="agenda_id"><div class="row"><div class="col-40"><div class="form-group"><label for="agenda_titulo">Título evento:</label><input type="text" name="agenda_titulo" value="" class="agenda_titulo"></div><div class="form-group"><label for="agenda_descripcion">Descripción evento:</label><textarea name="agenda_descripcion" class="agenda_descripcion"></textarea></div></div><div class="col-60"><div class="row"><div class="col-30"><div class="form-group"><label for="agenda_fecha_in">Fecha In:</label><input type="date" name="agenda_fecha_in" value="'+fechaIn+'" class="agenda_fecha_in"></div><div class="form-group"><label for="hora_inicio">Hora inicio:</label><input type="time" name="hora_inicio" value="'+horaDefault+'" class="agenda_hora_in"></div></div><div class="col-30"><div class="form-group"><label for="agenda_fecha_out">Fecha Out:</label><input type="date" name="agenda_fecha_out" value="'+fechaIn+'" class="agenda_fecha_out"></div><div class="form-group"><label for="hora_inicio">Hora final:</label><input type="time" name="hora_final" value="'+horaDefaultOut+'" class="agenda_hora_out"></div></div><div class="col-40"><div class="form-group"><label for="agenda_categoria">Categoría</label><select name="agenda_categoria" class="agenda_categoria"><option value="muestras">Cursos, muestras y Talleres</option><option value="musica">Peñas</option><option value="espectaculos">Espectáculos</option></select></div><div class="form-group"><label for="agenda_url">Slug:</label><input type="text" name="agenda_url" value="" class="agenda_url"></div><div class="form-group"><button class="btn btn-primary btn-save-evento">Guardar</button>&nbsp<button class="btn btn-danger btn-delete-evento">Borrar</button></div><div class="error-msj-list"></div></div></div></div></div></li>';

		$(contenedor).prepend($(html));

	});


	/*
	AL CAMBIAR FECHA IN
	*/
	$(document).on('change', '.agenda_fecha_in', function(){
		fecha = $(this).val()
		var contenedor = $(this.closest('li')).find('.agenda_fecha_out');
		$(contenedor).val(fecha)

	});

	/*
	AL CAMBIAR HORA IN
	*/
	$(document).on('change', '.agenda_hora_in', function(){
		hora = $(this).val()
		var contenedor = $(this.closest('li')).find('.agenda_hora_out');
		$(contenedor).val(hora)
	});

	/*

	*/

	$(document).on('focusout', '.agenda_titulo' , function(){
		//primero chequea que no tenga ya un url, si lo tiene se anula
		var newTitulo = $(this).val();
		var li = this.closest('li');
		var inputUrl = $(li).find('.agenda_url')

		if ($(inputUrl).val() == '') {
			newTitulo = getCleanedString(newTitulo);
			$(inputUrl).val(newTitulo)
		}
	});


});// ready