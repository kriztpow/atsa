<article id="leyes-laborales" class="wrapper-page">
	<div class="container">
    	<h1 class="main-tittle-page">Convenios Colectivos y acuerdos Salariales</h1>


    	<div id="accordion">

    	<?php showLinksConvenios(); ?>

		</div><!-- //.acordeon -->

    </div><!-- //.container -->
</article>

<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion" ).accordion({
    		collapsible: true,
    		active : false
    	}
    	);
		iconCrossOpener();
		
    	$('.ui-accordion-header').click(iconCrossOpener);//click
    	
    });//ready

function iconCrossOpener () {
	$('.ui-accordion-header').each(function(){
    		
		if ($(this).hasClass('ui-accordion-header-active')) {
			$('.icon-cross', this).addClass('icon-cross-open');
		} else {
			$('.icon-cross', this).removeClass('icon-cross-open');
		}
	});
}
	
</script>

