<?php
/*
 * Sitio web: BAXTTER
 * @LaCueva.tv
 * Since 1.5
 * FOOTER
 * Contenido: footer html del sitio
*/
?>
<footer id="main-footer">
    
    <!------- footer screen ---------->
    <div class="container-fluid">
        <div class="row">
        <!------- col half:  mapa & form ---------->
            <div class="col-md-7 col-sm-12">
                <div class="row">
                    <div class="location">
                        <p class="address">
                            Saavedra 166 - C1083ACD - Ciudad Autónoma de BS AS<br>
                            Personería gremial 274 - Adherida a F.A.T.S.A - C.G.T
                        </p>
                        <div class="g-map-wrapper">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1641.854152500074!2d-58.40618224989514!3d-34.61153687237484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x71eabe9a423d5f3e!2sAsociaci%C3%B3n+de+Trabajadores+de+la+Sanidad+Argentina+-+Filial+Buenos+Aires!5e0!3m2!1ses!2sar!4v1497864347302" width="100%" height="160" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                        <h6 class="footer-phone"><span class="sr-only">Teléfono de contacto</span>4959-7100</h6>

                        <figure class="footer-logos logos-sanidad">
                            <img src="assets/images/logos/logo-sanidad.png">
                        </figure>
                    </div>

                    <div class="form-wrapper">
                        <h4>¿Tenés dudas?</h4>
                        <form method="POST" name="footer-form" id="footer-form">
                            <label for="name"></label>
                            <input type="text" id="name" name="name" placeholder="Tu nombre">
                            <label for="email"></label>
                            <input type="text" id="email" name="email" placeholder="Tu email" required>
                            <textarea id="msj" name="msj" placeholder="mensaje"></textarea>
                            <input type="submit" value="Enviar Mensaje">
                            <div class="contact-footer-msj-exito">
                                Mensaje enviado con éxito
                            </div>
                            <div class="contact-footer-msj-error">
                                Falló al enviar su mensaje, intente de nuevo más tarde
                            </div>
                        </form>
                    </div>
                </div><!-- //.row -->
            </div><!-- //.col-md-6 -->
            <!------- col half: menu & redes ---------->
            <div class="col-md-5 col-sm-12">
                <div class="row">
                    <div class="footer-menu-wrapper">
                        <nav>
                            <ul class="footer-menu">
                                <li><a href="noticias">Noticias</a></li>
                                <li><a href="#">Acción Gremial</a></li>
                                <li><a href="/beneficios">Acción Social</a></li>
                                <li><a href="#">Deporte y Turismo</a></li>
                                <li><a href="#">Cultura</a></li>
                                <li><a href="preguntas-frecuentes">Preguntas Frecuentes</a></li>
                            </ul>
                        </nav>

                        <figure class="footer-logos logo-cyb">
                            <img src="assets/images/logos/logo-cyb.png" alt="Celeste y Blanca">
                        </figure>
                    </div>

                    <div class="conectados">

                        <div class="redes-sociales-footer-wrapper">
                            <h4 class="sr-only">Redes Sociales</h4>
                            <ul class="redes-sociales-footer">
                                <li>
                                    <a class="red-social red-social-facebook-footer" href="http://www.facebook.com/pages/ATSA-Bs-As/116874221683810" target="_blank" rel="external">
                                        <span class="sr-only">Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="red-social red-social-instagram-footer" href="https://www.instagram.com/AtsaBsAs/" target="_blank" rel="external">
                                        <span class="sr-only">Instagram</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="red-social red-social-youtube-footer" href="http://www.youtube.com/user/atsabsas" target="_blank" rel="external">
                                        <span class="sr-only">Youtube</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="red-social red-social-twitter-footer" href="http://twitter.com/AtsaBsAs" target="_blank" rel="external">
                                        <span class="sr-only">Twitter</span>
                                    </a>
                                </li>
                            </ul>

                        </div>

                        <p class="emergencias-footer">
                            Obra social del Personal de la Sanidad Argentina<br>
                            Saavedra 159 - C1083ACD - Ciudad Autónoma de Buenos Aires<br>
                            <strong>Urgencia y Emergencias 0800 999 7264</strong>
                        </p>
                    </div>
                </div><!-- //.row -->
            </div><!-- //.col-md-6 -->
        </div><!-- //.row -->
    </div><!-- //.container-fluid -->
    <!------- // .footer-screen --------->
</footer>