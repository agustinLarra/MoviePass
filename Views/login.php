<!DOCTYPE html>
<html>

		<!-- Cabecera -->
<head>
	<title>Login</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Template/css/login.css">
</head>
		
<body>

<div class="contenedor">
		<h4> Iniciar Sesion </h4>
        <form action = "<?php echo FRONT_ROOT ?>User/login" method="POST">  Iniciar Sesion 
				<label>Correo</label>
					<input type = "email" placeholder="Ingrese email" required name="email" maxlength="<20"/>
					<br>
				<label>Contraseña </label>
					<input type = "password" placeholder="Ingrese contraseña"required name="password" maxlength="20"/>
					<br>

					<button class="submit"> Ingresar <span class="icon-users"></span> </button>

		</form>
		<button ></button>
</div>

</body> 
</html>