<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
	<form action="<?php echo FRONT_ROOT;?>User/login" method="post">

		<label for="">Email</label>
		<input type="email" placeholder="Ingrese email" name="email">
		<label for="">Password</label>
		<input type="password" placeholder="Ingrese password" name="password">
	
		<button type="submit"> Enviar </button>
	</form>


</body>
</html>