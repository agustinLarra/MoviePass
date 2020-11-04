<?php 
namespace ViewsAdmin;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOVIEPASS</title>

    <!-- Header Start -->


   <!-- CSS -->

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


		 <!-- NO BORRAR (ESTO HACE EL SELECT DINAMICO)-->
		 <script type="text/javascript">
		function selectCiudadFuncion(str ){ //funcion para crear la conexion asincronica
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
					document.getElementById("funciones").innerHTML=conexion.responseText; 
				}
			}
			//abrimos una conexion asincronica usando el metodo GET y le enviamos la variable c
			var idPelicula = document.getElementById('idPelicula').value;

			conexion.open("GET", "selectDinamicoCiudades?ciudad="+str+"?idPelicula="+idPelicula, true);
			//po ultimo enviamos la conexion
			conexion.send();

		}
			
	</script>


</head>


