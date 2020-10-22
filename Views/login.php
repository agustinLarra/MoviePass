<?php
	namespace Views;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../Views/css/main.css">
	<link rel="stylesheet" type="text/css" href="../Views/css/util.css">
</head>

<body class="bodyLogin">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form action="<?= FRONT_ROOT ?> User/login" method="post" class="login100-form validate-form p-b-33 p-t-5">

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="email" name="email" required name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" required name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button type = "submit" class="button-login login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>

	<footer>
	<!--===============================================================================================-->
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/bootstrap/js/popper.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/daterangepicker/moment.min.js"></script>
		<script src="../vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
		<script src="../js/main.js"></script>

	</footer>
</body>
</html>

	