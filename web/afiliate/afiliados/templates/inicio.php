<!---------- ACCESOS DIRECTOS A LOS MODULOS ---------------->
<div class="container wrapper-modulos">
  <div class="row">
    <div class="col-30">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Buscar afiliados</h2>
          <form method="GET" action="index.php?" class="search-afiliado-form">
            <input type="text" name="search" placeholder="inserte cuil,dni o nombre" required>
            <p><button class="btn btn-primary" type="submit" role="button">Buscar</button></p>
          </form>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    <div class="col-30">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Lista completa</h2>
          <p>Ves lista completa de afiliados.</p>
          <p><a class="btn btn-primary" href="index.php?admin=contacts" role="button">Ver lista</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    <div class="col-30">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Nuevos afiliados</h2>
          <p>Usuarios no contactados.</p>
          <p><a class="btn btn-primary" href="index.php?admin=contacts&afiliado-status=0" role="button">Ver lista</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    <div class="col-30">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Ver contactados</h2>
          <p>Ves lista completa de afiliados.</p>
          <p><a class="btn btn-primary" href="index.php?admin=contacts&afiliado-status=1" role="button">Ver lista</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    <div class="col-30">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Ver por delegados</h2>
          <p>Ves lista completa de afiliados.</p>
          <p><a class="btn btn-primary" href="index.php?admin=contacts&by=delegados" role="button">Ver lista</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    <div class="col-30">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Agregar nuevo</h2>
          <p>Agregar nuevo afiliado.</p>
          <p><a class="btn btn-danger" href="index.php?admin=edit-contacts" role="button">Agregar</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->

    

  </div><!-- //row -->
</div><!-- //containre -->