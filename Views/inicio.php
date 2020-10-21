<?php 
namespace Views;

if(!isset($_SESSION)) session_start(); 
?>

<body class="body-home">
	<h1 class="h1-home">WELCOME TO MOVIE PASS</h1>
	<div class="div-home">
		<a class="a-home" href="<?=FRONT_ROOT ?>Home/Index">HOME</a>
		<a class="a-home" href="<?=FRONT_ROOT ?>Home/viewCartelera">CARTELERA</a>
		<?php if(!isset($_SESSION['userLog'])) { ?>
		<a class="a-home" href="<?=FRONT_ROOT?>Home/viewLogin">LOGIN</a>
		<?php	} ?>
		<?php if(!isset($_SESSION['userLog'])) { ?>
		<a class="a-home" href="<?=FRONT_ROOT?>Home/viewSignup">SIGNUP</a>
		<?php	} ?>

		<div id="indicator"></div>
	</div>
	


<!-- Swiper
<body>
<div class="homeslider">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<img src="//FRONT_ROOT . VIEWS_PATH images/cineWall-E.jpg">
						<div class="caption">
							<div class="captioninside">
								<h3>Comentario extra</h3>	
									<a href="single.html" class="playbutton">Play</a><BOTON PLAY
							</div>
						</div>
					</div>
				</div>
				<!-- Add Pagination  BUSCAR PARA AGREGAR EL FOOTER ACA
				<div class="swiper-pagination"></div>
			</div>
		</div>

</body>
-->


