<?php 
namespace Views;
use Models\Pelicula as Peliculas;

?>

<div class="homeslider">
			<div class="swiper-container">

				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<img src="<?php echo IMAGE_ROOT . $arrayCartelera[0]->getPoster()  ?>">
						<div class="caption">
							<div class="captioninside">
                                
								<h3><?php echo  $arrayCartelera[0]->getTitle();?></h3>
								<p>Aca va el resumen</p>
								<!--<a href="single.html" class="playbutton">Play</a>-->
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<img src="<?php echo IMAGE_ROOT . $arrayCartelera[1]->getPoster();?>">
						<div class="caption">
							<div class="captioninside">
								<h3><?php echo  $arrayCartelera[1]->getTitle();?></h3>
								<p>Aca va el resumen</p>
								<!--<a href="single.html" class="playbutton">Play</a> ESTO ENVIA A OTRA PAGINA DONDE ESTA LA PELICULA-->
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<img src="<?php echo IMAGE_ROOT . $arrayCartelera[2]->getPoster();?>">
						<div class="caption">
							<div class="captioninside">
								<h3><?php echo  $arrayCartelera[2]->getTitle();?></h3>
								<p>Lorem ipsum dolor siamet</p>
								<!--<a href="single.html" class="playbutton">Play</a>-->
							</div>
						</div>
					</div>
				</div>
				<!-- Swiper JS -->
		<script src="Views/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
	$(document).ready(function(){


		var swiper = new Swiper('.homeslider > .swiper-container', {
			pagination: '.swiper-pagination',
			paginationClickable: true,
			preventClicks:false,
			preventClicksPropagation:false,
			effect:'fade',
			breakpoints: {
				320: {
					height:200
				},

				480: {
					height:300
				},

				768: {
					height:400
				},
				1024: {
					height:500
				}
			}
		});

		var recentswiper = new Swiper('.recentslider > .swiper-container', {
			nextButton: '.recent-next',
			prevButton: '.recent-prev',
			slidesPerView: 8,
			paginationClickable: true,
			preventClicks:false,
			preventClicksPropagation:false,
			spaceBetween: 10,
			breakpoints: {
				320: {
					slidesPerView: 3,
					spaceBetween: 5
				},

				480: {
					slidesPerView: 3,
					spaceBetween: 5
				},

				768: {
					slidesPerView: 5,
					spaceBetween: 5
				},
				1024: {
					slidesPerView: 6,
					spaceBetween: 10
				}
			}
		});

		var mostswiper = new Swiper('.mostslider > .swiper-container', {
			nextButton: '.most-next',
			prevButton: '.most-prev',
			slidesPerView: 8,
			paginationClickable: true,
			preventClicks:false,
			preventClicksPropagation:false,
			spaceBetween: 10,
			breakpoints: {
				320: {
					slidesPerView: 3,
					spaceBetween: 5
				},

				480: {
					slidesPerView: 3,
					spaceBetween: 5
				},

				768: {
					slidesPerView: 5,
					spaceBetween: 5
				},
				1024: {
					slidesPerView: 6,
					spaceBetween: 10
				}
			}
		});

		var topswiper = new Swiper('.topslider > .swiper-container', {
			nextButton: '.top-next',
			prevButton: '.top-prev',
			slidesPerView: 8,
			paginationClickable: true,
			preventClicks:false,
			preventClicksPropagation:false,
			spaceBetween: 10,
			breakpoints: {
				320: {
					slidesPerView: 3,
					spaceBetween: 5
				},

				480: {
					slidesPerView: 3,
					spaceBetween: 5
				},

				768: {
					slidesPerView: 5,
					spaceBetween: 5
				},
				1024: {
					slidesPerView: 6,
					spaceBetween: 10
				}
			}
		});

	});

	
</script>
</body>