<?php 
namespace Views;

if(!isset($_SESSION)) session_start(); 
?>

<body class="body-home">
	<h1 class="h1-home">WELCOME TO MOVIE PASS</h1>
	<div class="div-home">
		<a class="a-home" href="<?=FRONT_ROOT ?>Home/viewCartelera">CARTELERA</a>
		<?php if(!isset($_SESSION['userLog'])) { ?>
		<a class="a-home" href="<?=FRONT_ROOT?>Home/viewLogin">LOGIN</a>
		<?php	} ?>
		<?php if(!isset($_SESSION['userLog'])) { ?>
		<a class="a-home" href="<?=FRONT_ROOT?>Home/viewSignup">SIGNUP</a>
		<?php	} ?>

		<div id="indicator"></div>
	</div>
	

