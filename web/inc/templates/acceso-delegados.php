<?php 
$now = time();
$mostrar = false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['user_status']) && $now < $_SESSION['expire'] ) {
    $mostrar = true;
} else {
    session_destroy();
    $mostrar = false;
}
?>

<article id="page" class="wrapper-page">
    <?php if ($mostrar) : ?>
        <div class="inner-wrapper">
            <div class="container">
                <h1 class="main-tittle-page">Acceso a delegados</h1>

                <div class="btn-noticia-index">
                    <a href="https://atsa.org.ar/afiliate/afiliados/">
                        Afiliá a alguien
                    </a>
                </div>
            </div>
        </div>

    <?php else : ?>
    
        <div class="container">
            <p>No tiene acceso para ver este contenido</p>
        </div>

    <?php endif; ?>

</article>