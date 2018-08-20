<?php 
$linkVideoVivo = frontgetVideoVivo();
$textVideoVivo = frontgetTextVivo();

if ( $textVideoVivo == '' || $textVideoVivo == null ){
	$textVideoVivo = 'Enviá tus preguntas a preguntaenvivo@gmail.com o escribinos al chat online ahora y se contestarán en el momento.';	
}

if ($linkVideoVivo == '' || $linkVideoVivo == null){
	

	$linkVideoVivo = '';	
} else {
	$linkVideoVivo = explode('=', $linkVideoVivo);	
}



?>

<article id="vivo" class="wrapper-page less-padding">

	<h1 class="main-title-beneficios">Vivo</h1>

	<div style="width: 100%;max-width: 960px;margin: 50px auto;">
		<!--<iframe width="100%" height="550px" src="https://www.youtube.com/embed/K6_1WlzzAXs?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>-->
		<iframe width="100%" height="550px" src="https://www.youtube.com/embed/<?php echo $linkVideoVivo[1]; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	</div>

	<div style="width: 80%;margin: 0 auto;text-align: center;font-size: 150%;line-height: 120%;">
        Enviá tus preguntas a preguntaenvivo@gmail.com o escribinos al chat online ahora y se contestarán en el momento.
    </div>

	<script>
		if ( innerWidth < 960 ) {
    		iframe = document.getElementsByTagName('iframe')[0];
    		iframe.height = '480px';
		}

		if ( innerWidth < 550 ) {
    		iframe = document.getElementsByTagName('iframe')[0];
    		iframe.height = '315px';
		}
	</script>
</article>