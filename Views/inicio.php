<?php 
namespace Views;

use Models\Pelicula as pelicula;
require_once("header.php");
require_once("nav.php");



?>



<!-- Swiper -->
<div class="homeslider">
			<div class="swiper-container">

				<div class="swiper-wrapper">
					<div class="swiper-slide">
						
						<img src="<?=FRONT_ROOT . VIEWS_PATH?>images/cineWall-E.jpg">
						<div class="caption">
							<div class="captioninside">
								<h3>Tu Lugar de Reservas</h3>
								
								<!--<a href="single.html" class="playbutton">Play</a>--><!--BOTON PLAY-->
							</div>
						</div>
					</div>
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
			</div>
		</div>

</body>