<?php namespace Views;
use DAO\PeliculaDAO as PeliculaDAO;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviePass</title>
    <link rel="stylesheet" href="../Views/css/styleBillboard.css">
      <!-- CSS 

      <link rel="stylesheet" href="../ViewsAdmin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/slicknav.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/animate.min.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/themify-icons.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/themify-icons.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/slick.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/nice-select.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/style.css">
    <link rel="stylesheet" href="../ViewsAdmin/assets/css/responsive.css">
-->
</head>
<body>
    
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
    <?php $contador = 0;
        foreach($array_peliculas as $values){
        ?>
    <div class="movie_card" id="movie".<?php $contador++; ?>>
    <div class="info_section">
        <div class="movie_header">
        <img class="locandina" src="<?=IMAGE_ROOT .  $values->getPosterPath();?>"/>
        <h1 class="h1"><?= $values->getTitle();?></h1>
        <h4> Aca release date </h4>
        <span class="minutes">Aca duracion</span>
        <p class="type">Genero</p>
        </div>
        <div class="movie_desc">
        <p class="text">
       <?php echo  $values->getOverview(); ?> 
        </p>
        </div>
        <div class="movie_social">
        <ul>
            <li><i class="material-icons">ACA AGREGAR A COMPRA</i></li>
        </ul>
        </div>
    </div>
    <div class="blur_back movie_back"><img src="<?=IMAGE_ROOT .  $values->getPosterHorizontal();?>"></div>
    </div>
    <?php } ?>
</body>

</html>