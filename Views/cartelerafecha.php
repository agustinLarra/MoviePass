<?php namespace Views;
use Models\Pelicula as pelicula;
use Models\Genero as Genero;
require_once("header.php");
require_once("nav.php");
?>
<body>

		<?php $contador = 0; //PARA DESPUES: SI NO HAY NINGUNA PELICULA PARA 'X' GENERO, QUE APAREZCA UN CARTELITO
		foreach($peliculas_cartelera as $values)
		{	?>
    <div class="movie_card" id="movie".<?php $contador++; ?>>
   		<div class="info_section">
			<?php //if($values->getUngenre()==$tipo)
				//{
					?>
					<div class="movie_header">
						<img class="locandina" src="<?=IMAGE_ROOT .  $values->getPosterPath();?>"/>
						<h1 class="h1"><?= $values->getTitle();?></h1>
						<h4> Aca release date </h4>
						<span class="minutes">Aca duracion</span>
						<p class="type"></p>
					</div>
					<div class="movie_desc">
						<p class="text">
							<?=$values->getOverview();?>
						</p>
					</div>
					<div class="movie_social">
						<ul>
							<li><i class="material-icons">ACA AGREGAR A COMPRA</i></li>
						</ul>
					</div>
   		</div>
    			<!--<div class="blur_back movie_back"><img src="<?//=IMAGE_ROOT .  $values->getPosterHorizontal();?>"></div>-->
	</div>
			<?php } ?>
    <?php// } ?>
</body>