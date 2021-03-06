<?php 

$data = showpeticionData();
$LinkPrivacidad = $data['url_privacidad'];
$image = $data['header_imagen'];
$titulo = $data['titulo_general'];
$video = $data['video'];
$tituloFormulario = $data['titulo_formulario'];
$tituloInferior = $data['titulo_inferior'];
$hashtag = $data['hashtag'];
$textoInferior = $data['texto'];
$resumen = $data['resumen'];

if ($video == '' || $video == null){
	
	$video = '';	
} else {	
	$video = explode('=', $video);	
}

?>
<!--estilos -->
<style>
.wraper-image-header {
    background-color: #333;
    padding: 45px 0 0;
    margin: 0;
    width: 100%;
}

.wraper-image-header img {
    position: relative;
    display: block;
    width: 100%;
    height: auto;
    margin: 0;
    padding: 0;
}

.wraper-image-header h1 {
    color: #fff;
    visibility: hidden;
    height: 0;
    overflow: hidden;
}

.texto-inferior-wrapper {
    color: #737277;
    background-color: #F2F2F2;
    position: relative;
    display: block;
    width: 100%;
    height: auto;
    margin: 0;
    padding: 30px 0 60px;
    border-top: 1px solid #0094c5;
}

.texto-inferior-wrapper h3 {
    position: absolute;
    top: -20px;
    left: 0;
    background-color: #F2F2F2;
    color: #0094c5;
    padding-right: 20px;
    font-size: 26px;
    line-height: 35px;
}

.texto-inferior-wrapper .contenido p {
    margin-bottom: 10px;
}

.texto-inferior-wrapper .contenido strong {
    font-weight: bold;
}

.texto-inferior-wrapper .contenido em {
    font-style: italic;
}

.wrapper-contenido {
    position: relative;
    width: 100%;
    height: auto;
    margin: 0;
    padding: 40px 0 60px;
    display: flex;
    display: -o-flex;
    display: -ms-flex;
    display: -moz-flex;
    display: -webkit-flex;
    -webkit-justify-content: space-between;
    -moz-justify-content: space-between;
    -ms-justify-content: space-between;
    -o-justify-content: space-between;
    justify-content: space-between;
    -webkit-flex-wrap: wrap;
    -moz-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    -o-flex-wrap: wrap;
    flex-wrap: wrap;
}

.wrapper-contenido .wrapper-video {
    width: 40%;
    max-width: 960px;
    margin: 0;
    margin-bottom: 20px;
}

.wrapper-contenido .wrapper-formulario {
    width: 55%;
    margin: 0;
}

.wrapper-contenido .wrapper-formulario h2 {
    text-transform: uppercase;
    color: #0094c5;
    font-size: 127%;
    line-height: 120%;
    margin-bottom: 10px;
    padding: 0 5px;
}

#peticion-form {
    color: #666;
    position: relative;
    width: 100%;
    height: auto;
    margin: 0;
    padding: 5px 0;
}

#peticion-form input {
    display: block;
    width: 100%;
    height: 30px;
    margin: 10px 0;
    padding: 5px;
    background-color: #d8dade;
    border: 1px solid #0094c5;
    margin-left: 10px;
}

#peticion-form input[type="radio"] {
    display: inline;
    width: 15px;
    height: 15px;
    margin-right: 10px;
}

#peticion-form input[type="checkbox"] {
    display: inline;
    width: 15px;
    height: 15px;
    margin-right: 10px;
}

.privacity-link {
    font-size: 90%;
    text-align: right;
    position: absolute;
    right: 0;
    color: #0094c5;
}

#peticion-form button {
    cursor: pointer;
    background-color: #0094c5;
    color: #fff;
    text-transform: uppercase;
    font-size: 200%;
    padding: 20px 5px;
    font-weight: bold;
    width: 100%;
    border: none;
    text-shadow: 2px 2px 3px #333;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    -ms-border-radius: 40px;
    -o-border-radius: 40px;
    border-radius: 40px;
    margin: 20px 0 0;
}

#peticion-form button:hover {
    opacity: 0.7;
}

@media (max-width: 768px) {

    .wraper-image-header {
        margin: 0;
        padding: 0;
    }

    .wrapper-contenido .wrapper-video {
        width: 100%;
    }
    .wrapper-contenido .wrapper-formulario {
        width: 100%;
    }

    #peticion-form button {
        font-size: 130%;
    }
}

</style>
<article id="peticion" class="wrapper-home">

	<div class="wraper-image-header">
        <h1 class="sr-only">Firmar esta petición</h1>
		<img src="uploads/images/<?php echo $image; ?>" alt="<?php echo $titulo; ?>">
	</div>

    <div class="container">
        <div class="wrapper-contenido">
            <div class="wrapper-video">
                <iframe width="100%" height="260px" src="https://www.youtube.com/embed/<?php echo $video[1]; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <script>

                        if ( innerWidth < 600 ) {
                            iframe = document.getElementsByTagName('iframe')[0];
                            iframe.height = '240px';
                        }

                        if ( innerWidth < 480 ) {
                            iframe = document.getElementsByTagName('iframe')[0];
                            iframe.height = '200px';
                        }
                    </script>
            </div>
                    
            <div class="wrapper-formulario">
                <h2>
                    <?php echo $tituloFormulario; ?>
                </h2>
                <form METHOD="POST" id="peticion-form">
                    <input name="name" type="text" placeholder="NOMBRE Y APELLIDO" required>
                    <input type="email" name="email" placeholder="EMAIL" required>
                    <input type="text" name="dni" placeholder="DNI" required>
                    <a href="<?php echo $LinkPrivacidad; ?>" target="_blank" class="privacity-link">Política de Privacidad ATSA Bs As.</a>
                    <input type="radio" name="genero" value="varon" checked>Varón
                    <input type="radio" name="genero" value="mujer">Mujer
                    <br>
                    <input type="checkbox" name="info" checked>Recibir más información
                    <button type="submit">Firmar esta Petición</button>
                </form>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="texto-inferior-wrapper">
            <h3>
                <?php echo $tituloInferior; ?>
            </h3>

            <div class="contenido">
                <?php echo $textoInferior; ?>
            </div>

        </div>
    </div>

    <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '724703991239072'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=724703991239072&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

</article>