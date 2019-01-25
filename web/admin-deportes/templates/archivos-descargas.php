<?php
load_module( 'medios' );
load_module( 'otros-opciones' );
//variable define archivos para no repetir html
global $archivos;
?>
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		Archivos para descargar
	</h1>
	<div class="container">

		<div class="row">
            <div class="col">
				
				<ul class="otras-opciones">
                    <?php 
                    foreach ( $archivos as $archivo ) { ?>
                        <li data-id="<?php echo $archivo['optionName']; ?>">
                            <label>
                                <?php echo $archivo['label']; ?>:
                            </label>
                            <?php 
                            $fileLoaded = getFile( $archivo['optionName'] );
                            
                            if ( $fileLoaded != null ) { ?>
                            
                            <input type="hidden" name="file" value="<?php echo $fileLoaded['options_value']; ?>">
                            <a href="<?php echo UPLOADSURLFILES .'/'. $fileLoaded['options_value']; ?>" target="_blank">
                                <?php echo $fileLoaded['options_value']; ?>
                            </a>
                            <button class="btn-change-file-opciones" data-file="<?php echo $archivo['optionName']; ?>">Cambiar archivo</button>
                            <button class="btn-del-file-opciones" data-file="<?php echo $archivo['optionName']; ?>">Borrar</button>
                            
                            <?php } else { ?>
                                <button class="btn-new-file-opciones" data-file="<?php echo $archivo['optionName']; ?>">Agregar Archivo</button>
                            <?php } ?>
                        </li>  
                    <?php }
                    ?>
                     

				</ul>
			</div>
			
		</div><!-- //row -->
	</div><!-- // container -->
</div><!-- // wrapper interno modulo -->
<div id="dialog"></div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>