<article id="autoridades" class="wrapper-page">
    
	<div class="container">
    	<h1 class="main-tittle-page">Comisión directiva</h1>

    	<div class="row staff-lista-principal">
    		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">

    			<?php showStaff( 'secretario_general', 'unique' ); ?>
    			
			</div>
    	</div>
    
	    <ul class="row staff-lista staff-lista-picture">	
    			
			<?php showStaff( 'comision_directiva' ); ?>

	    </ul><!-- // row -->
	</div><!-- // container -->


    <section id="vocales-titulares">
    <div class="deco-linea-celeste"><span></span></div>
    	<div class="container">
	    	<h2 class="vocales-title">Vocales Titulares</h2>
	    	
	    	<ul class="row staff-lista">
    		
    			<?php showStaff( 'vocales_titulares' ); ?>
    		
	    	</ul><!-- // row -->

	    </div>
    </section>

    <section id="vocales-suplentes">
    <div class="deco-linea-celeste"><span></span></div>
    	<div class="container">
	    	<h2 class="vocales-title">Vocales suplentes</h2>
	    	
	    	<ul class="row staff-lista">
    		
    			<?php showStaff( 'vocales_suplentes' ); ?>
    		
	    	</ul><!-- // row -->

	    </div>
    </section>

    <section id="revisores-cuenta">
    <div class="deco-linea-celeste"><span></span></div>
    	<div class="container">
	    	<h2 class="vocales-title">Revisores de Cuenta</h2>
	    	
	    	<ul class="row staff-lista">
    		
    			<?php showStaff( 'revisores_de_cuenta' ); ?>
    		
	    	</ul><!-- // row -->

	    </div>
    </section>

</article>
