<?php
if(!isset($_SESSION)) session_start(); 

?>
<body class="body-nav">
	<figure class="logo"><a href="<?= FRONT_ROOT ?>Home/Index"><img src="../Views/img/movie2.png" alt="Logo"  /></figure></a>
	<nav class="nav-nav">
		<a class="a-nav" href="<?=FRONT_ROOT ?>Home/Index">Home</a>
		<!--<li><a>Lista desplegable</a>
			<ul>
				<li><a href="genre.html">Action</a></li>
				<li><a href="genre.html">Comedy</a></li>
				<li><a href="genre.html">Drama</a></li>
				<li><a href="genre.html">Romance</a></li>
			</ul>
		</li>-->


		<?php if(!isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" href="<?=FRONT_ROOT?>Home/viewLogin">Login</a></li>
			<?php	} ?>
		

		<a class="a-nav" href="<?php  echo FRONT_ROOT ?>Home/viewCartelera">Cartelera</a>
			<!--
			<ul>
				<li><a href="language.html">English</a></li>
				<li><a href="language.html">Spanish</a></li>
			</ul>
			-->
		
		<?php if(isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" >Welcome  <?=$_SESSION['userLog']->getEmail();?> </a>
			<?php	} ?>
		<?php if(!isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" href="<?=FRONT_ROOT?>Home/viewSignup">Sign Up</a>
			<?php	} ?>

		<?php if(isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" href="<?=FRONT_ROOT?>User/logout">Logout</a>
			<?php	} ?>

	</nav>
			