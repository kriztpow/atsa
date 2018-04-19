<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Iniciar sesión</title>

<!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<!-- jQquery UI css -->
  <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
<!-- Custom CSS -->
  <link href="assets/css/admin-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<main>
	<article>
		<div class="container">
			<h1>Iniciar Sesión</h1>
			<form action="inc/sesion.php" method="POST" id="login" name="login">
				<span class="error-tag">&nbsp;</span>
			<!------ usuario ---------->
				<div class="form-group">
					<label for="userid">Usuario</label>
					<input type="email" id="userid" name="userid" required>
				</div>
			
			<!------ contraseña ---------->
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" id="password" name="password" required>
				</div>

			<!------ GUARDAR ---------->
				<div class="form-group">
					<input type="submit" value="Iniciar sesión" class="btn">
				</div>
			</form>
		</div>
	</article>
</main>
<!------- // fin contenido ------>
<!------- scripts ------>
<!------- jquery 3.1.1 ------>
	<script src="assets/js/jquery-3.1.1.min.js"></script>
	<script>
		$(document).ready(function (){
			$('#login').submit(function(event){
				event.preventDefault();
				var formulario = this;
				var data = $(this).serialize();
				var msj = $('.error-tag');

				$.ajax( {
					type: 'POST',
					url: 'inc/sesion.php',
					data: data,
		            //funcion antes de enviar
		            beforeSend: function() {
		            	console.log('a ver a ver');
		            },
					success: function ( response ) {
						console.log(response)
						if ( response == 1 ) {
							window.setTimeout('location.reload()', 1000);
						} else {
							msj.html('hubo un pequeño error, sus datos no son correctos');
						}
					},
					error: function ( error ) {
						console.log(error);
					},
				});//cierre ajax
			});//submit
		});//ready
	</script>
</body>
</html>