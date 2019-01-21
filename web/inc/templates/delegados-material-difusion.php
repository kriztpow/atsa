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

            <div class="title-material-difusion">
                <div class="container">
                    <h2>
                        Material de difusión
                    </h2>
                </div>
            </div>

            
                
            <div class="material-difusion-wrapper">
                <div class="container">
                    <ul class="material-difusion-categorias">
                        <li>
                            Material Privado
                        </li>

                        <li>
                            Material Público
                        </li>
                    </ul>
                </div>    
            </div>

        </div>

    <?php else : 
    
        getTemplate( 'login' );

    endif; ?>

</article>