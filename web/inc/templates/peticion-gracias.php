<?php 
$data = showpeticionData();
$imagenGracias = $data['gracias_imagen'];
$textoGracias = $data['texto_gracias'];
?>
<style>
.wraper-image-header {
    background-color: #333;
    background-image: url(uploads/images/<?php echo $imagenGracias; ?>);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 45px 0 0;
    margin: 0;
    width: 100%;
    height:100%;
    position: relative;
}

.wraper-image-header img {
    position: relative;
    display: block;
    width: 100%;
    height: auto;
    margin: 0;
    padding: 0;
}

.wraper-image-header .texto-gracias {
    position: relative;
    display: flex;
    display: -o-flex;
    display: -ms-flex;
    display: -moz-flex;
    display: -webkit-flex;
    -webkit-align-items: center;
    -moz-align-items: center;
    -ms-align-items: center;
    -o-align-items: center;
    align-items: center;
    -webkit-justify-content: space-around;
    -moz-justify-content: space-around;
    -ms-justify-content: space-around;
    -o-justify-content: space-around;
    justify-content: space-around;
    -webkit-flex-direction:column;
    -moz-flex-direction:column;
    -ms-flex-direction:column;
    -o-flex-direction:column;
    flex-direction:column;
    color: #fff;
    width: 100%;
    height: 100%;
    background-color: rgba(42,74,122,0.8);
    text-align: center;
    padding: 15% 5% 10%;
}

.wraper-image-header .texto-gracias h1 {
    text-transform: uppercase;
    font-size: 250%;
    line-height: 110%;
    font-weight: bold;
    margin:20px 0 40px; 
}

.wraper-image-header .texto-gracias p {
    font-size: 150%;
    line-height: 110%;
    margin:20px 0; 
}

.wraper-image-header .texto-gracias h5 {
    font-size: 200%;
    line-height: 110%;
    font-weight: bold;
    margin:40px 0 20px; 
}

.wraper-image-header .texto-gracias .compartir {
    position: relative;
    display: flex;
    display: -o-flex;
    display: -ms-flex;
    display: -moz-flex;
    display: -webkit-flex;
    -webkit-align-items: center;
    -moz-align-items: center;
    -ms-align-items: center;
    -o-align-items: center;
    align-items: center;
    -webkit-justify-content: space-between;
    -moz-justify-content: space-between;
    -ms-justify-content: space-between;
    -o-justify-content: space-between;
    justify-content: space-between;
    width: 100%;
    position: absolute;
    bottom: 0;
    background: rgba(43,157,255,0.4);
    height: 70px;
    padding: 0 20px;
}

.wraper-image-header .texto-gracias .compartir > li > a {
    background-color: rgba(0,0,0,0.5);
    color: #fff;
    padding: 10px 20px;
    padding-left: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    -o-border-radius: 10px;
    border-radius: 10px;
}

.wraper-image-header .texto-gracias .compartir > li > a:hover {
    opacity: 0.7;
}

.wraper-image-header .texto-gracias .compartir > li > a > .icon-facebok {
    display: inline-block;
    width: 25px;
    height: 25px;
    vertical-align: bottom;
    background-size: cover;
    background-repeat: no-repeat;
    background-image: url(../assets/images/facebook-icon.png);
    margin-right: 10px;
}

.wraper-image-header .texto-gracias .compartir > li > a > .icon-twitter {
    display: inline-block;
    width: 25px;
    height: 25px;
    vertical-align: bottom;
    background-image: url(../assets/images/twitter-icon.png);
    background-size: cover;
    background-repeat: no-repeat;
    margin-right: 10px;
}

@media (max-width: 768px) {
    .wraper-image-header {
        margin: 0;
        padding: 0;
    }

    .wraper-image-header .texto-gracias h1 {
        font-size: 200%;
    }

    .wraper-image-header .texto-gracias .compartir {
        position: relative;
        padding: 20px;
        height:120px;
        -webkit-flex-direction:column;
        -moz-flex-direction:column;
        -ms-flex-direction:column;
        -o-flex-direction:column;
        flex-direction:column;
    }
}
</style>
<article id="peticion-gracias" class="wrapper-home">
    <div class="wraper-image-header">
        
        <div class="texto-gracias">
            <?php echo $textoGracias; ?>

            <ul class="compartir">
                <li>
                    <a href="javascript:void(0);" onclick="shareFacebook()">
                        <span class="icon-facebok"></span>Compartí en Facebook
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="shareTwitter()">
                        <span class="icon-twitter"></span>Compartí en Twitter
                    </a>
                </li>
            </ul>

        </div>

	</div>
</article>
<script>
function shareFacebook () {
    
    window.open('https://www.facebook.com/sharer/sharer.php?u=https://atsa.org.ar/nosomospresos');
}
function shareTwitter () {
    
    window.open('https://twitter.com/intent/tweet?url=https://atsa.org.ar/nosomospresos&text=%23NoAlasPulserasEnEnfermeria');
}


</script>