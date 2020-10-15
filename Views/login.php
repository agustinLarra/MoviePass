<!DOCTYPE html>
<html>

		<!-- Cabecera -->
<head>
	<title>Login</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="template/css/login.css">
</head>
		
<body>

	<div class="contenedor">
			<h4> Login </h4>
			<form action = "<?php echo FRONT_ROOT ?>User/login" method="POST">  Iniciar Sesion 
				<label>Email</label>
				<input type = "email" placeholder="Ingrese email" required name="email" maxlength="<20"/>
				<br>
				<label>Password </label>
				<input type = "password" placeholder="Ingrese contraseña"required name="password" maxlength="20"/>
				<br>

				<button class="submit"> Sign in <span class="icon-users"></span> </button>
			</form>
			<a href="Home/viewSignUp">You don't have an account? Register here</a>
	</div>
</body> 
</html>
