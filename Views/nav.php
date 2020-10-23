<?php
if(!isset($_SESSION)) session_start(); 

?>

<body class="body-nav">
	
	<nav class="nav-nav">
		<a class="a-nav" href="<?=FRONT_ROOT ?>Home/Index">Home</a>
		<!--  -
		<li><a>Lista desplegable</a>
			<ul>
				<li><a href="genre.html">Action</a></li>
				<li><a href="genre.html">Comedy</a></li>
				<li><a href="genre.html">Drama</a></li>
				<li><a href="genre.html">Romance</a></li>
			</ul>
		</li>
-->

		<?php if(!isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" href="<?=FRONT_ROOT?>Home/viewLogin">Login</a></li>
			<?php	} ?>
		

		<a class="a-nav" href="<?php  echo FRONT_ROOT ?>Home/viewCartelera">Cartelera</a>
			<!--
			<ul>
				<li><a href="language.html">English</a></li>
				<li><a href="language.html">Spanish</a></li>
			</ul>
		
		-->
		<?php if(isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" >Welcome  <?=$_SESSION['userLog']->getEmail();?> </a>
			<?php	} ?>
		<?php if(!isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" href="<?=FRONT_ROOT?>Home/viewSignup">Sign Up</a>
			<?php	} ?>

		<?php if(isset($_SESSION['userLog'])) { ?>
			<a class="a-nav" href="<?=FRONT_ROOT?>User/logout">Logout</a>
			<?php	} ?>

<?php /*
			<div class="header-area header-transparrent ">
        <div class="main-header header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo">
                            <a>MOVIEPASS</a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <!-- Main-menu -->
                        <div class="main-menu f-right d-none d-lg-block">
                            <nav> 
                                <ul id="navigation">    
                                    <li><a href="<?php echo FRONT_ROOT?>Admin/Index"> Home Admin</a></li>
                                    <!-- ACA REDIRECCIONAR BIEN-->
                                    <li><a href="contact.html">Cines</a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo FRONT_ROOT?>Admin/showAddCine">Agregar Cines</a></li>
                                               <!-- ACA EDITAR CINE -->
                                                <!-- ACA ELIMINAR CINE -->
                                            <li><a href="<?php echo FRONT_ROOT?>Admin/showListCine">Lista de cines</a></li>

                                         </ul>
                                     </li>
                                      <!-- ACA REDIRECCIONAR BIEN-->
                                     <li><a href="contact.html">Salas</a>
                                        <ul class="submenu">
                                        <li><a href="<?php echo FRONT_ROOT?>Admin/showAddSalas">Agregar Salas</a></li>
                                           <!-- ACA EDITAR SALA -->
                                                <!-- ACA ELIMINAR SALA -->
                                                 <!-- ACA LISTAR SALAS -->
                                         </ul>
                                     </li>
                                </ul>
                            </nav>
                        </div>
                    </div>             
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>

	</nav>
   */