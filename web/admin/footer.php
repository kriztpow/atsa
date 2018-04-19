<?php
//chequea que no se acceda directo
if(!defined("SECUREACCESS"))
{
    die("El acceso directo a este archivo no está permitido.");
}
?>
</main><!--//main -->
<!------- pie ------>
<footer class="navbar-fixed-bottom">
	<div class="container">
	    Módulo de administración. <?php echo SITENAME; ?> - <?php echo DATEPUBLISHED; ?>
	</div>
	<div style="position: absolute; bottom: 20px;right: 15px;"><a href="http://lacueva.tv" title="Agencia de desarrollo web" style="color: #444;text-decoration: none;">LaCueva.tv</a></div>
</footer>
<!------- // fin contenido ------>
<!------- scripts ------>
<!------- jquery 3.1.1 ------>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<!------- jquery UI ------>
<script src="assets/js/jquery-ui.min.js"></script>
<!------- TinyMce ------>
<script src="assets/lib/tinymce/tinymce.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<!------- admin scripts ------>
<script src="assets/js/admin-script.js?version=4"></script>
</body>
</html>