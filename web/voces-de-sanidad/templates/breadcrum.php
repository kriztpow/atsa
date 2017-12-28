<!-- Breadcrum -->
<div class="section-block pt-50 pb-0">
	<div class="row">
		<div class="column width-12">
			<ul class="breadcrumb center mb-50">
				<li>
					<a href="<?php echo MAINSURL; ?>">Voces de sanidad</a>
				</li>
				<li>
					<a href="<?php echo MAINSURL; ?>/publicaciones">Publicaciones</a>
				</li>
			<?php if ( $data != '' ) : ?>
				<li>
					<a href="<?php echo MAINSURL; ?>/publicaciones/<?php echo $data; ?>">
						<?php echo $data; ?>
					</a>
				</li>
			<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
<!-- Breadcrum End -->