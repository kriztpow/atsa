<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		Deportes
	</h1>
	<div class="container">
		<div class="row">
            <div class="col-20">
                <table class="tabla-categorias">
                    <thead>
                        <tr>
                            <td>Agregar nuevo</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <form name="nueva-categoria-form" id="nueva-categoria-form" method="POST">
                                    <div class="form-group">
                                        <label for="nombre_nueva_categoria">Nombre</label>
                                        <input type="text" name="nombre_nueva_categoria">
                                    
                                        <label for="slug_nueva_categoria">slug</label>
                                        <input type="text" name="slug_nueva_categoria">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-add-category">
                                        Agregar Nuevo deporte
                                    </button>

                                    <span class="error-msj"></span>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
			<div class="col-40">

                <table class="tabla-categorias">
                    <thead>
                        <tr>
                            <td>
                                Deportes
                            </td>
                            <td>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="categorias-wrapper categorias-posts">

                    <?php 
                    $deportes = getDeportesList( );

                    if ($deportes != null ) {
                    
                        foreach ($deportes as $deporte ) { ?>

                        <tr>
                            <td>
                                <input type="hidden" name="categoria_id" value="<?php echo $deporte['id']; ?>">
                                <input type="hidden" name="categoria_slug" value="<?php echo $deporte['slug']; ?>">
                                <input type="text" name="categoria_name" value="<?php echo $deporte['nombre']; ?>">
                            </td>
                            <td>
                                <button data-id="<?php echo $deporte['id']; ?>" class="btn btn-primary btn-sm btn-change-category">
                                    Guardar
                                </button>
                                <button data-id="<?php echo $deporte['id']; ?>" class="btn btn-danger btn-sm btn-del-category">
                                    Borrar
                                </button>
                                <span class="error-msj"></span>
                            </td>
                        </tr>

                        <?php }
                    } ?>
                    </tbody>
                </table>

            </div><!-- // col -->

            <div class="col-40">

                
                    
            </div><!-- // col -->

        </div><!-- // row gral modulo -->
	</div><!-- // container gral modulo -->
</div><!-- // wrapper interno modulo -->
<div id="dialog"></div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>