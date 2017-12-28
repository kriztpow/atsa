<?php
/*
 * TEMPLATE PAGINATION FOR SINGLE
 * recibe el id de la noticia
*/


$postsURLs = getNextPrevious( $data);

?>



<div class="section-block pagination-3 pt-40 pb-40">
	<div class="row">
		<div class="column width-12">
			<ul>
                <li>
                
                <?php if ( $postsURLs[0] != 'none' ) : ?>
                
                	<a class="pagination-previous" href="<?php echo MAINSURL . '/publicaciones/' . $postsURLs[1] . '/' . $postsURLs[0]; ?>">
                		<span class="icon-left-open-mini left"></span> Publicación anterior 
                	</a>

            	<?php endif; ?>

                </li>

				<li>

				<?php if ( $postsURLs[2] != 'none' ) : ?>

					<a class="pagination-next" href="<?php echo MAINSURL . '/publicaciones/' . $postsURLs[3] . '/' . $postsURLs[2]; ?>">
						Publicación nueva <span class="icon-right-open-mini right"></span>
					</a>

				<?php endif; ?>

				</li>
			</ul>
		</div>
	</div>
</div>