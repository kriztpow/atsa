<article id="contacto" class="wrapper-page">
	<div class="container">
	    <h1 class="contact-title">Contactate con Nosotros.</h1>

	    <form id="main-form" name="main-form" method="post" class="formulario-principal">

	    	<div class="row">
	    		<div class="col-sm-4">
	    			<label for="name">Nombre *<br>
	    				<input type="text" name="name" id="name" required>
	    			</label>
	    		</div><!-- //.col -->

	    		<div class="col-sm-4">
	    			<label for="email">Email *<br>
	    				<input type="email" name="email" id="email" required>
	    			</label>
	    		</div><!-- //.col -->

	    		<div class="col-sm-4">
	    			<label for="email-confirm">Confirmar Email *<br>
	    				<input type="email" name="email-confirm" id="email-confirm" required>
	    				<span class="error-msj">Los email deben ser iguales</span>
	    			</label>
	    		</div><!-- //.col -->

	    	</div><!-- //.row -->

	    	<div class="row">
	    		<div class="col-sm-6">
	    			<label for="subjet">Asunto<br>
	    				<input type="text" name="subjet" id="subjet">
	    			</label>
	    		</div><!-- //.col -->

	    		<div class="col-sm-6">
	    			<label for="section">Sector<br>
	    				<select name="section" id="section">
	    					<option value="NoSelect">Seleccioná un sector</option>
	    					<option value="gremiales">Gremiales</option>
	    					<option value="cultura">Cultura</option>
	    					<option value="deporte">Deporte</option>
	    					<option value="turismo">Turismo</option>
	    					<option value="prensa_y_Difusión">Prensa y Difusión</option>
	    					<option value="accion_social">Acción Social</option>
	    					<option value="genero">Género</option>
	    					<option value="asistencia_social">Asistencia Social</option>
	    					<option value="legales">Legales</option>
	    					<option value="finanzas">Finanzas</option>
	    					<option value="vitalicios">Vitalicios</option>
							<option value="complejo_cultural">Complejo Cultural</option>
							<option value="sanidad_solidaria">Sanidad Solidaria</option>
	    				</select>
	    			</label>
	    		</div><!-- //.col -->

	    	</div><!-- //.row -->

	    	<div class="row">
	    		<div class="col-md-12">
	    			<label for="msj">Mensaje<br>
	    				<textarea id="msj" name="msj"></textarea>
	    			</label>
	    		</div><!-- //.col -->
	    	</div><!-- //.row -->

	    	<div class="row">
	    		<div class="col-md-3 col-sm-6 col-xs-12">
	    			<input type="submit" value="enviar comentario">
	    		</div><!-- //.col -->
	    	</div><!-- //.row -->

	    	<div class="msj-exito">Mensaje enviado con éxito</div>
	    	<div class="msj-error">Falló al enviar su mensaje, intente de nuevo</div>
	    </form>


	    <aside>
	    	<ul class="row">
	    		<li class="col-md-4 col-sm-6 col-xs-12">
    				<div class="contact-boxes contact-boxes-small contact-boxes-icon-loc">
    					<span>Dónde estamos</span><br>
    					Saavedra 166
    				</div>
    			</li>
    			<li class="col-md-4 col-sm-6 col-xs-12">
    				<div class="contact-boxes contact-boxes-small contact-boxes-icon-tel">
    					<span>Habla con nosotros</span><br>
    					4959-7100 int. 38/39
    				</div>
    			</li>
    			
    			<li class="col-md-4 col-sm-6 col-xs-12">
    				<div class="contact-boxes contact-boxes-small contact-boxes-icon-email">
    					<span>Escribinos</span><br>
    					web@atsa.or.ar
    				</div>
    			</li>
    		</ul>
	    </aside>

	</div>
</article>
