<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>MoviePass</title>
	<link href="https://fonts.googleapis.com/css?family=Lato|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../Views/css/tarjeta.css">
	
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
</head>
<body>

<div class="header-area header-transparrent ">
       <div class="main-header header-sticky">
           <div class="container">
               <div class="row align-items-center" style="padding:20px;">
                   <!-- Logo -->
                   <div class="col-xl-2 col-lg-3 col-md-2">
                       <div class="logo">
                      		MOVIEPASS
                       </div>
                   </div>
                   
                    <div class="col-xl-10 col-lg-3 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Cancelar Compra</a>
                        </div>
                    </div> 
				</div>
			</div>
		</div>
</div>
	<!-- Total de la compra -->
	
	<div class="contenedor">
		<div>
			<h2>El total de la compra es: $<?= $_SESSION['total'];?></h2>
			<h3>Cantidad de entradas a comprar: <?= $_SESSION['cantidadEntradas'];?></h3>
			<?php if($_SESSION['descuento'] > 0){
				echo '<h3>Se le han descontado: $'. $_SESSION['descuento'] .'</h3>';
				}?>
			
		</div>
		<!-- Tarjeta -->
		<section class="tarjeta" id="tarjeta" style="padding: 30px;">
			<div class="delantera">
				<div class="logo-marca" id="logo-marca">
					<!-- <img src="img/logos/visa.png" alt=""> -->
				</div>
				<img src="../Views/img/chip-tarjeta.png" class="chip" alt="">
				<div class="datos">
					<div class="grupo" id="numero">
						<p class="label">Número Tarjeta</p>
						<p class="numero">#### #### #### ####</p>
					</div>
					<div class="flexbox">
						<div class="grupo" id="nombre">
							<p class="label">Nombre Tarjeta</p>
							<p class="nombre">Jhon Doe</p>
						</div>

						<div class="grupo" id="expiracion">
							<p class="label">Expiracion</p>
							<p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
						</div>
					</div>
				</div>
			</div>

			<div class="trasera">
				<div class="barra-magnetica"></div>
				<div class="datos">
					<div class="grupo" id="firma">
						<p class="label">Firma</p>
						<div class="firma"><p></p></div>
					</div>
					<div class="grupo" id="ccv">
						<p class="label">CCV</p>
						<p class="ccv"></p>
					</div>
				</div>
				<p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
				<a href="#" class="link-banco">www.moviepass.com</a>
			</div>
		</section>

		<!-- Contenedor Boton Abrir Formulario -->
		<div class="contenedor-btn">
			<button class="btn-abrir-formulario" id="btn-abrir-formulario">
				<i class="fas fa-plus"></i>
			</button>
		</div>

		<!-- HAY QUE PONER UN DIV QUE DIGA EL TOTAL DE LA COMPRA -->

		<!-- Formulario -->
		<form action="<?php echo FRONT_ROOT?>User/finalizarCompra" method="POST" id="formulario-tarjeta" class="formulario-tarjeta">
			<div class="grupo">
				<label for="inputNumero">Número Tarjeta</label>

				<input type="text" id="inputNumero" maxlength="19" autocomplete="off"  name="numeroTarjeta" required name="numeroTarjeta">
			</div>
			<div class="grupo">
				<label for="inputNombre">Nombre</label>
				<input type="text" id="inputNombre" maxlength="19" autocomplete="off" name="nombre" required name="inputNombre">
			</div>
			<div class="flexbox">
				<div class="grupo expira">
					<label for="selectMes">Expiracion</label>
					<div class="flexbox">
						<div class="grupo-select">
							<select name="mes" id="selectMes" name="mes">
								<option disabled selected>Mes</option>
							</select>
							<i class="fas fa-angle-down"></i>
						</div>
						<div class="grupo-select">
							<select name="year" id="selectYear" name="year">
								<option disabled selected>Año</option>
							</select>
							<i class="fas fa-angle-down"></i>
						</div>
					</div>
				</div>

				<div class="grupo ccv">
					<label for="inputCCV">CCV</label>
					<input type="text" id="inputCCV" maxlength="3" name="ccv"  required name="inputCCV">
				</div>
			</div>
			<button type="submit" class="btn-enviar">Enviar</button>
		</form>
	</div>

	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="../Views/js/tarjeta.js"></script>
</body>
</html>