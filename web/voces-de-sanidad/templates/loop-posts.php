<?php 
/*
 * Este template funciona para las dos categorias. Recibe un post por ves armando solo el article
*/
$resumen = preparaResumen( $data );
$fecha = tuneandoFecha( $data['post_fecha'] );
?>
<article class="post-in-loop animation-element fade-in">
	
	<div class="title-post-wrapper">
		
		<h1>
			<a href="<?php echo MAINSURL .'/'. $data['post_categoria'] .'/'.$data['post_url']; ?>">
				<?php echo $data['post_titulo']; ?>
			</a>
		</h1>
		
		<h6 class="date-post">
			<?php echo $fecha; ?>
		</h6>
	</div>
	
	<a href="<?php echo MAINSURL .'/'. $data['post_categoria'] .'/'.$data['post_url']; ?>" <?php if ( $data['post_categoria'] == 'noticias' ) { echo 'class="image-wrapper-loop"'; } ?>>
		
		<img src="<?php echo UPLOADSURL . '/' . $data['post_imagen']; ?>" alt="<?php echo $data['post_titulo']; ?>">
	</a>
	
	<?php if ( $resumen != '' ) { ?>
	<p>
		<?php echo acortaTexto( $resumen ); ?>
	</p>
	<?php } ?>

	<div class="wrapper-button-more">
		<a href="<?php echo MAINSURL .'/'. $data['post_categoria'] .'/'.$data['post_url']; ?>" class="btn btn-sm btn-primary">
			Ver nota
		</a>
	</div>

</article>