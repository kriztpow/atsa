<div class="container wrapper-modulos">
  <div class="row">
<?php 
global $menuModulos;

foreach ($menuModulos as $menu) {
  $url = 'index.php';
  if ( $menu['template'] != '' ) {
    $url .= '?admin='.$menu['template'];
  }
  if ( $menu['slug'] != '' ) {
    $url .= '&slug='.$menu['slug'];
  } 
  ?>
  
  <div class="col-30">
      <section>
        <div class="modulo-wrapper">
          <h2><?php echo $menu['titulo']; ?></h2>
          <p><?php echo $menu['texto']; ?></p>
          <p><a class="btn btn-primary" href="<?php echo $url; ?>" role="button">Ver</a></p>
        </div>
      </section>
    </div>

<?php } ?>

  </div>
</div>