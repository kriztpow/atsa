<div class="contenido-modulo">
	<div class="container">
		<h2>Nuevo usuario</h2>
		<form method="POST" id="register" name="register">
			<span class="error-tag">&nbsp;</span>
		<!------ usuario ---------->
			<div class="form-group">
				<label for="userid">Usuario (email)</label>
				<input type="email" id="userid" name="userid" required>
			</div>
		
		<!------ contraseña ---------->
			<div class="form-group">
				<label for="password">Contraseña</label>
				<input type="password" id="password" name="password" required>
			</div>

		<!------ nombre ---------->
			<div class="form-group">
				<label for="username">Nombre</label>
				<input type="text" id="username" name="username">
			</div>

		<!------ GUARDAR ---------->
			<div class="form-group">
				<input type="submit" value="Registrar" class="btn">
			</div>
		</form>
	</div>
</div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>