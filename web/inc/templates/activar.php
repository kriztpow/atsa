<?php 
$pagina = getPageData(4);
$titulo = $pagina['page_titulo'];
$texto = $pagina['page_text'];

?>
<article id="activar" class="wrapper-home">
    <header class="wrapper-image-header">
        <?php 
        if ( $pagina['page_imagen'] != '') { ?>
            <figure>
                <img src="<?php echo 'uploads/images/' . $pagina['page_imagen']; ?>" alt="Activar">
            </figure>    
        <?php } else { ?>
            <div class="title-wrapper">
                <div class="container">
                    <h1>
                        <?php echo $titulo; ?>
                    </h1>
                </div>
            </div>
        <?php } ?>
    </header>

    <div class="wrapper-activar">
        

        <div class="wrapper-form">
            <div class="container">
                <div class="contenido-texto">
                    <?php echo $texto; ?>
                </div>
            </div>
            <form method="POST" name="activar_formulario" id="activar_formulario">
                <div class="container">
                    <label for="nombre">
                        <span class="label">Nombre:</span>
                        <input type="text" name="nombre">
                    </label>
                    <label for="apellido">
                        <span class="label">Apellido:</span>
                        <input type="text" name="apellido">
                    </label>
                    <label for="dni">
                        <span class="label">DNI:</span>
                        <input type="text" name="dni">
                    </label>
                    <label for="email">
                        <span class="label">Email:</span>
                        <input type="email" name="email">
                    </label>
                    <label for="telefono">
                        <span class="label">Teléfono:</span>
                        <input type="text" name="telefono">
                    </label>
                    <label for="mensaje">
                        <span class="label">Mensaje:</span>
                        <input type="text" name="mensaje">
                    </label>
                    
                    <div class="wrapper-submit">
                        <button type="submit">Enviar</button>
                    </div>

                    <div class="msj-exito">Mensaje enviado con éxito</div>
                    <div class="msj-error">Falló al enviar su mensaje, intente de nuevo</div>
                </div>
            </form>
            
        </div>
    </div>
</article>