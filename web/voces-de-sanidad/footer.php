<?php
/*
 * Sitio web: Voces de Sanidad
 * @LaCueva.tv
 * Since 1.0
 * FOOTER
 * 
*/
?>
        </div>
            <!-- Content End -->

            <!-- Footer -->
            <footer class="footer">
                <div class="footer-top">
                    <div class="row flex">
                        <div class="column width-12">
                            <div class="widget">
                                <h3 class="widget-title">Voces de Sanidad.</h3>
                            </div>
                        </div>
                        <div class="column width-6">
                            <div class="widget">
                                <p><?php echo ABOUTUS; ?></p>
                            </div>
                        </div>
                        
                        <div class="column width-4 offset-2 right left-on-mobile">
                            <div class="widget">
                                <a data-content="inline" data-aux-classes="tml-newsletter-modal rounded" data-toolbar="" data-modal-mode data-modal-width="600" data-lightbox-animation="fadeIn" href="#subscribe-modal" class="lightbox-link button rounded medium bkg-theme bkg-hover-green color-white color-hover-white mb-10 left">
                                    <span class="icon-email medium left"></span>
                                    <span class="button-content">
                                        <small>Hace Clic!</small>Suscribirte
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- Subscribe Modal Simple -->
                        <div id="subscribe-modal" class="pt-70 pb-50 hide">
                            <div class="row">
                                <div class="column width-12 center">

                                    <!-- Info -->
                                    <h3 class="mb-10">Suscribite</h3>
                                    <p class="mb-30">Para mantenerte al tanto de las novedades.</p>
                                    <!-- Info End -->

                                    <!-- Signup -->
                                    <div class="signup-form-container">
                                        <form id="formulario-registro-footer" class=" merged-form-elements" method="post">
                                            <div class="row">
                                                <div class="column width-8">
                                                    <div class="field-wrapper">
                                                        <input type="email" name="email" class="form-email form-element rounded large left" placeholder="Correo electrónico*" tabindex="2" required>
                                                    </div>
                                                </div>
                                                <div class="column width-4">
                                                    <input type="submit" value="Subscribirse" class="form-submit button rounded large bkg-theme bkg-hover-green color-white color-hover-white">
                                                </div>
                                            </div>
                                            <input type="text" name="honeypot" class="form-honeypot form-element">
                                        </form>
                                        <div class="response-msj-footer form-response show"></div>
                                    </div>
                                    <!-- Signup End -->

                                </div>
                            </div>
                        </div>
                        <!-- Subscribe Modal Simple -->
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="row">
                        <div class="column width-12">
                            <div class="footer-bottom-inner">
                                <p class="copyright pull-left clear-float-on-mobile">&copy; ATSA BsAs. <a href="\" class="scroll-to-top" data-no-hide>Volver arriba</a></p>
                                <ul class="social-list list-horizontal pull-right clear-float-on-mobile left">
                                    <li><a href="<?php echo LINK_TWITTER; ?>" target="_blank"><span class="icon-twitter-with-circle medium"></span></a></li>
                                    <li><a href="<?php echo LINK_FACEBOOK; ?>" target="_blank"><span class="icon-facebook-with-circle medium"></span></a></li>
                                    <li><a href="http://atsa.org.ar" target="_blank"><img style="width: 25px;height: 25px;vertical-align: sub;opacity: 0.6;" src="<?php echo MAINSURL; ?>/atsa.png" alt="ATSA"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer End -->

        </div><!-- //.wrapper-inner -->
    </div><!-- //.wrapper -->

    <!-- Js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--<script src="http://maps.googleapis.com/maps/api/js?v=3"></script>-->
    <script src="<?php echo MAINSURL; ?>/js/timber.master.min.js"></script>
    <script src="<?php echo MAINSURL; ?>/js/script.js"></script>
   <script>
        /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-102775844-1', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');*/

    </script>
</body>
</html>
