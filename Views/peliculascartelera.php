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
						
						<img src="<?php echo IMAGE_ROOT . $arrayCartelera[0]->getPosterHorizontal(); ?>">
						<div class="caption">
							<div class="captioninside">
								<h3><?php echo $arrayCartelera[3]->getTitle(); ?></h3>
								<p>Lorem ipsum dolor siamet</p>
								<a href="single.html" class="playbutton">Play</a>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<img src="<?php echo IMAGE_ROOT . $arrayCartelera[1]->getPosterHorizontal(); ?>">
						<div class="caption">
							<div class="captioninside">
								<h3><?php echo $arrayCartelera[3]->getTitle(); ?></h3>
								<p>Lorem ipsum dolor siamet</p>
								<a href="single.html" class="playbutton">Play</a>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<img src="<?php echo IMAGE_ROOT . $arrayCartelera[2]->getPosterHorizontal(); ?>">
						<div class="caption">
							<div class="captioninside">
								<h3><?php echo $arrayCartelera[3]->getTitle(); ?></h3>
								<p>Lorem ipsum dolor siamet</p>
								<a href="single.html" class="playbutton">Play</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
			</div>
		</div>

	
	

	<main class="content">
			<section class="panel">
				<h2>Recently Added</h2>
				<div class="recentslider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/8.jpg"><h3 class="hometitle">Space Betwen Us</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/2.jpg"><h3 class="hometitle">John Wick</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/3.jpg"><h3 class="hometitle">Spider-Man Homecoming</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/4.jpg"><h3 class="hometitle">Beauty and the Beast</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/5.jpg"><h3 class="hometitle">Pirates of the Caribbean: Dead Men Tell No Tales</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/6.jpg"><h3 class="hometitle">Fifty Shades Darker</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/7.jpg"><h3 class="hometitle">Transformers: The Last Knight</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/8.jpg"><h3 class="hometitle">xXx: Return of Xander Cage</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/9.jpg"><h3 class="hometitle">Space Betwen Us</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/2.jpg"><h3 class="hometitle">John Wick</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/3.jpg"><h3 class="hometitle">Spider-Man Homecoming</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/4.jpg"><h3 class="hometitle">Beauty and the Beast</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/5.jpg"><h3 class="hometitle">Pirates of the Caribbean: Dead Men Tell No Tales</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/6.jpg"><h3 class="hometitle">Fifty Shades Darker</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/7.jpg"><h3 class="hometitle">Transformers: The Last Knight</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="images/8.jpg"><h3 class="hometitle">xXx: Return of Xander Cage</h3></a></div>

							<div class="swiper-slide"><a href="mostwatched.html"><img src="Views/img/others.png"></a></div>
						</div>
						<div class="nextdirection recent-next"><img src="Views/img/right-arrow.svg"> </div>
						<div class="leftdirection recent-prev"><img src="Views/img/left-arrow.svg"> </div>
					</div>
				</div>
			</section>
		</main>




		<main class="content">
		<section class="panel">
			<h2>Peliculas en Cartelera </h2>
			<div class="recentslider">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<!-- 							<div class="swiper-slide"><a href="single.html"><img src="<?php echo IMAGE_ROOT . $arrayCartelera[1]->getPoster(); ?>"><h3 class="hometitle"><?php echo $value->getTitle();?></h3></a></div>-->
						<div class="swiper-slide"><a href="single.html"><img src="images/9.jpg"><h3 class="hometitle">Space Betwen Us</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/2.jpg"><h3 class="hometitle">John Wick</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/3.jpg"><h3 class="hometitle">Spider-Man Homecoming</h3></a></div>
							<div class="swiper-slide"><a href="single.html"><img src="Views/images/4.jpg"><h3 class="hometitle">Beauty and the Beast</h3></a></div>
						<div class="swiper-slide"><a href="mostwatched.html"><img src="Views/img/others.png"></a></div>
					</div>
					<div class="nextdirection recent-next"><img src="img/right-arrow.svg"> </div>
					<div class="leftdirection recent-prev"><img src="img/left-arrow.svg"> </div>
				</div>
			</div>
		</section>
	</main>

</body>