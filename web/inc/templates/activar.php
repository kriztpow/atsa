<?php 
$pagina = getPageData(4);
$titulo = $pagina['page_titulo'];
$texto = $pagina['page_text'];

if ( $pagina['page_imagen'] != '') {
    $src = urlBase() . '/uploads/images/' . $pagina['page_imagen'];
} else {
    $src = urlBase() . '/assets/images/activar.png';
}
?>
<article id="activar" class="wrapper-home">
    <header class="wrapper-image-header">
        
        <figure>
            <img src="<?php echo $src; ?>" alt="Activar">
        </figure>

    </header>

    <div class="wrapper-activar">
        <div class="title-wrapper">
            <div class="container">
                <h1>
                    <?php echo $titulo; ?>
                </h1>
            </div>
        </div>

        <div class="wrapper-form">
            <div class="container">
                <div class="contenido-texto">
                    <?php echo $texto; ?>
                </div>

                <form method="POST" name="activar_formulario" id="activar_formulario">
                    <label for="nombre">
                        <span class="sr-only">Nombre</span>
	    				<input type="text" name="nombre" placeholder="Nombre">
                    </label>
                    <label for="apellido">
                        <span class="sr-only">Apellido</span>
	    				<input type="text" name="apellido" placeholder="Apellido">
                    </label>
                    <label for="dni">
                        <span class="sr-only">Dni</span>
	    				<input type="text" name="dni" placeholder="DNI">
                    </label>
                    <label for="email">
                        <span class="sr-only">Email</span>
	    				<input type="email" name="email" placeholder="Email" required>
                    </label>
                    <label for="telefono">
                        <span class="sr-only">Teléfono</span>
	    				<input type="text" name="telefono" placeholder="Teléfono">
                    </label>
                    <label for="mensaje">
                        <span class="sr-only">Mensaje</span>
	    				<textarea name="mensaje" rows="5" placeholder="Mensaje"></textarea>
                    </label>
                    
                    <div class="wrapper-submit">
                        <button type="submit">Enviar</button>
                    </div>

                    <div class="msj-exito">Mensaje enviado con éxito</div>
	    	        <div class="msj-error">Falló al enviar su mensaje, intente de nuevo</div>
                </form>
            </div>
        </div>
    </div>
</article>