<?php
/*
 * Sitio web: Voces de sanidad
 * @LaCueva.tv
 * Since 1.0
 * SIDEBAR TEMPLATE
 * Cada widget es un template también
*/
?>
<aside class="column width-3 pull-9 sidebar left">
	<div class="sidebar-inner">
		<div class="widget">
			<div class="box bkg-grey-ultralight mb-50">
				<h3 class="widget-title">Acerca de nosotros</h3>
				<p>
					<?php echo ABOUTUS; ?>
				<p>
			</div>
		</div>
		<div class="widget">
			<h3 class="widget-title">Secciones</h3>
			<ul>
				<li><a href="<?php echo MAINSURL; ?>/publicaciones/editorial">Editorial</a></li>
				<li><a href="<?php echo MAINSURL; ?>/publicaciones/nacional">Nacional</a></li>
				<li><a href="<?php echo MAINSURL; ?>/publicaciones/internacional">Internacional</a></li>
			</ul>
		</div>
		
		<div class="widget">
			<h3 class="widget-title">Noticias recientes</h3>
			<ul class="list-group">

			<?php 
			$posts = getPosts( 'none', 5, $data );

			for ($i=0; $i < count($posts); $i++) { ?>
				<li>
					<span class="post-info"><span class="post-date">
						<?php echo tuneandoFecha( $posts[$i]['post_fecha'] ); ?>
					</span></span>
					<a href="<?php echo MAINSURL . '/publicaciones/' . $posts[$i]['post_categoria'] . '/' . $posts[$i]['post_url']; ?>">
						<?php echo $posts[$i]['post_titulo']; ?>
					</a>
				</li>					
			<?php } ?>

			</ul>
		</div>
		
	</div>
</aside>