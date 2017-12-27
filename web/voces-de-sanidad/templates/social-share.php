<?php 
	if ( dispositivo() != 'pc') {
?>
<li class="icon-share-wa">
	<a href="whatsapp://send?text=<?php echo MAINSURL . '/' . $data['post_categoria'] .  '/' . $data['post_url']; ?>" data-action="share/whatsapp/share">
		<span class="icon-wata"></span>
		WhatsApp
	</a>
</li>
<?php } ?>
<li class="twitter-arreglo">
	<a target="_blank" class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo $data['post_titulo']; ?>&url=<?php echo MAINSURL . '/' . $data['post_categoria'] .  '/' . $data['post_url']; ?>&via=ColegioBuenosAires" >
		Tweet
	</a>
</li>
<li class="facebook-arreglo">
	<div class="fb-share-button" data-href="<?php echo MAINSURL . '/' . $data['post_categoria'] .  '/' . $data['post_url']; ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo MAINSURL . '/' . $data['post_categoria'] .  '/' . $data['post_url']; ?>&amp;src=sdkpreparse">Facebook</a></div>
</li>
<?php 
	if ( dispositivo() == 'pc') {
?>
<li class="print-share-btn">
	<a href="#" onclick="window.print();">
		<span class="icon-print"></span>
		Imprimir
	</a>
</li>
<?php } ?>