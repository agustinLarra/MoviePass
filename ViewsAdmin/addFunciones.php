<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Aca va una tabla con todas las peliculas que tenemos en la base de datos, estan adentro de $listaPeliculas  </h1>

    <form action="<?php echo FRONT_ROOT?>Admin/addFuncion" method="POST" >
    <label for=""> Pelicula  </label>
    <br>
        <select name="idPelicula">
            <?php   foreach($peliculasList as $value){      ?>

                 <option value="<?php echo $value->getId();?>"><?php echo $value->getTitle(); ?></option> 

            <?php }      ?>   
        </select>
    <br>        
        <label for="horario">Horario de la funcion </label>
        <input type="datetime-local" name="horario" id="horario">
    <br>
        <label for=""> Sala  </label>        
        <select name="idSalas">
            <?php   foreach($salasList as $value){      ?>

                 <option value="<?php echo $value->getId();?>"><?php echo $value->getNombre(); ?></option> 

            <?php }      ?>   
        </select>
    <br> <br>         
        <button type="submit">Enviar</button>    
    </form>
        
</body>
</html>