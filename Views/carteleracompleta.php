<?php namespace Views;
use Models\Pelicula as pelicula;
?>

  <body class="bodyCartelera" style: "background-color: #000">  
	
				<section class="centered">
					<h3>Peliculas en cartelera </h3>
					<form action="<?=FRONT_ROOT?>home/viewGenero" method="post">
						<h3>Seleccione Genero</h3>
						<select name="genero">
							<?php foreach($arrayGeneros as $generos)
							{?>
								<option value="<?=$generos->getId();?>"><?=$generos->getTipo()?></option>
							<?php } ?>
						</select>
						<button type="submit">Buscar</button>
					</form>
					<div class="movies">
						<?php foreach($arrayCartelera as $values)
							{ ?>
						<div class="mov">
							<a href="<?=FRONT_ROOT?>Home/viewCartelera">
								<img src="<?=IMAGE_ROOT .  $values->getPoster();?>">
								<h2 class="movietitle"><?= $values->getTitle();?></h2>
							</a>
						</div>
						<?php }?>

					</div>
				<!--<nav class="pagination"> ELIMINAR DE NO SER NECESARIO
						<ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#" class="menuactive">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">...</a></li>
							<li><a href="#">20</a></li>
							<li><a href="#">21</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</nav>-->
				</section>

