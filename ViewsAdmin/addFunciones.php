<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- NO BORRAR (ESTO HACE EL SELECT DINAMICO)-->
    <script type="text/javascript">
		function muestraselect(str){ //funcion para crear la conexion asincronica
			var conexion;

			if(str==""){
				document.getElementById("txtHint").innerHTML=""; // si la variable a enviar viene vacia retornamos a nada la funcion
				return;
			}
			if (window.XMLHttpRequest){
				conexion = new XMLHttpRequest();  // creamos una nueva instacion del obejeto XMLHttpRequest
			}

			// verificamos el onreadystatechange verifando que el estado sea de 4 y el estatus 200
			conexion.onreadystatechange=function(){  
				if(conexion.readyState==4 && conexion.status==200){
					//especificamos que en el elemento HTML cuyo id esa el de "div" vacie todos los datos de la respuesta 
					document.getElementById("salas").innerHTML=conexion.responseText; 
				}
			}
			//abrimos una conexion asincronica usando el metodo GET y le enviamos la variable c
			conexion.open("GET", "selectDinamicoSalas?id_cine="+str, true);
			//po ultimo enviamos la conexion
			conexion.send();

		}
			
	</script>
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
        <label for=""> Cines  </label>        
        <select name="idCine"id="select"  onclick="muestraselect(this.value)">
            <option value="">Selecione un cine</option>
            <?php   foreach($cineList as $value){      ?>

                 <option value="<?php echo $value->getId();?>"><?php echo $value->getNombre(); ?></option> 

            <?php }      ?>   
        </select>
    <br>  
    <label for="salas"> Sala  </label>           
    <div id="salas">      
        <select name="idSalas" id="select">
            <option value="">Selecione una sala</option>  
        </select>
    </div>            
    <br> <br>         
        <button type="submit">Enviar</button>    
    </form>
        
</body>
</html>