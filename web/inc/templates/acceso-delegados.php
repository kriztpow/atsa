<?php 
$now = time();
$mostrar = false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['user_status']) && $now < $_SESSION['expire'] ) {
    $mostrar = true;

    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['username'];
    $avatar = $_SESSION['user_image'];

    if ($avatar == '') {
        $avatarURL = urlBase() . '/assets/images/default-avatar.png';
    } else {
        $avatarURL = urlBase() . '/uploads/images/' . $avatar;
    }

} else {
    session_destroy();
    $mostrar = false;
}
?>

 <article id="page" class="wrapper-delegados">
    
    <?php if ($mostrar) : ?>    

        <header class="header-delegados">
            <h1 class="sr-only">Acceso a delegados</h1>

            <div class="usuario-wrapper">
                <div class="data-usuario">
                    <h2>
                        <?php echo $nombre; ?>
                    </h2>
                    <h4>
                        <?php echo $email; ?>
                    </h4>
                </div>
                <figure>
                    <img src="<?php echo $avatarURL; ?>" class="usuario">
                </figure>
            </div>

        </header>
        <div class="inner-wrapper">
            <div class="container">
                
                <div class="wrapper-menu-delegados">

                <?php 
                $items = showItemsDelegados('menu');

                if ( $items != null ) :
                    
                    foreach ($items as $item ) {
                        
                        
                        ?>
                        
                        <a href="<?php echo $item['url']; ?>">
                            <div class="item-menu-content">
                                <figure>
                                    <img src="<?php echo urlBase() . '/uploads/images/' . $item['imagen']; ?>">
                                </figure>
                                <h3 class="title-menu">
                                    <?php echo $item['titulo']; ?>
                                </h3> 
                            </div>
                        </a>

                    <?php }
                
                endif; ?>
                </div>
            </div>
        </div>

    <?php else : 
    
        getTemplate( 'login' );

    endif; ?>

</article>
