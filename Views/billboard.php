<?php namespace Views;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviePass</title>
    <link rel="stylesheet" href="../Views/css/styleBillboard.css">
</head>
    <?php $contador = 0;
        foreach($arrayCartelera as $values){
        ?>
    <div class="movie_card" id="movie".<?php $contador++; ?>>
    <div class="info_section">
        <div class="movie_header">
        <img class="locandina" src="<?=IMAGE_ROOT .  $values->getPoster();?>"/>
        <h1 class="h1"><?= $values->getTitle();?></h1>
        <h4> Aca release date </h4>
        <span class="minutes">Aca duracion</span>
        <p class="type">Genero</p>
        </div>
        <div class="movie_desc">
        <p class="text">
            Descripcion
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
