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
                
                <div class="wrapper-videos-delegados">

                <?php 
                $items = showItemsDelegados('video');

                if ( $items != null ) :
                    $contador = 1;

                    foreach ($items as $item ) {

                        if ($contador == 1) :
                            
                            if ( $item['url'] != '' ) :
                                $video = explode('=', $item['url']);
                            
                                ?>
                                
                                <div class="video-wrapper video-wrapper-destacado" data-id="<?php echo $item['id']; ?>">
                                    <iframe width="100%" height="450px" src="https://www.youtube.com/embed/<?php echo $video[1]; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>   
                                    <div class="video-text">
                                        <h2 class="video-tittle">
                                            <?php echo $item['titulo']; ?>
                                        </h2>
                                    
                                        <h5 class="date">
                                            <?php if ($item['fecha'] != '') {
                                                echo $item['fecha'];
                                            }
                                            ?>
                                        </h5>
                                        <div class="texto-video">
                                            <?php if ($item['texto'] != '') {
                                            echo $item['texto'];
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endif;    

                        else : 
                            
                            if ( $item['url'] != '' ) :
                                $video = explode('=', $item['url']);
                            ?>

                            <div data-id="<?php echo $item['id']; ?>" class="video-wrapper togle-video" data-video="https://www.youtube.com/embed/<?php echo $video[1]; ?>">
                                <div class="video-protect">
                                    <iframe width="100%" height="250px" src="https://www.youtube.com/embed/<?php echo $video[1]; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>   

                                    <div class="shutter"></div>
                                </div>
                                <h3 class="video-tittle">
                                    <?php echo $item['titulo']; ?>
                                    <?php if ($item['fecha'] != '') {
                                        echo ' - <span class="fecha-video">' . $item['fecha'] . '</span>';
                                    }
                                    ?>
                                </h3>
                                <div class="video-text">
                                    <?php if ($item['texto'] != '') {
                                        echo $item['texto'];
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                            endif;

                        endif;
                        
                        $contador++;
                    }
                
                endif; ?>
                </div>
            </div>
        </div>

    <?php else : 
    
        getTemplate( 'login' );

    endif; ?>

</article>