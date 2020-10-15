<?php
if(!isset($_SESSION)) session_start(); 
?>
<body>
	<div class="wrapper">

		<header class="header">
			<figure class="logo"><a href="<?= FRONT_ROOT ?>Home/Index"><img src="../Views/img/movie2.png" alt="Logo"  /></figure></a>
			<nav class="menu">
				<ul>
					<li><a href="<?=FRONT_ROOT ?>Home/Index">Home</a></li>
					<!--<li><a>Lista desplegable</a>
						<ul>
							<li><a href="genre.html">Action</a></li>
							<li><a href="genre.html">Comedy</a></li>
							<li><a href="genre.html">Drama</a></li>
							<li><a href="genre.html">Romance</a></li>
						</ul>
					</li>-->
					<li><a href="<?=FRONT_ROOT?>User/viewLogin">Login</a>

					<li><a href="<?php  echo FRONT_ROOT ?>Home/viewCartelera">Cartelera</a>
					<!--	<ul>
							<li><a href="language.html">English</a></li>
							<li><a href="language.html">German</a></li>
						</ul>-->
					</li>
					<?php if(isset($_SESSION['userLog'])) { ?>
						<li><a>Bienvenido <?=$_SESSION['userLog']->getEmail();?> </a></li>
						<?php	} ?>
					<li><a href="<?=FRONT_ROOT?>User/viewSignup">Resgistrarse</a></li>
					<li class="mobsearch">
						<form class="mobform">
							<input type="text" name="s" class="mobsearchfield" placeholder="Search...">
							<input type="submit" value="" class="mobsearchsubmit">
						</form>
					</li>
				</ul>
			</nav>