<?php 
namespace Views;

if(!isset($_SESSION)) session_start(); 
?>

   
   <body>


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
                           <div class="col-xl-6 col-lg-6 col-md-6">
                               <!-- Main-menu -->
                               <div class="main-menu f-right d-none d-lg-block">
                                   <nav> 
                                       <ul id="navigation">    
                                           <li><a href="<?php echo FRONT_ROOT?>Home/Index"> Inicio</a></li>
                                           <!-- ACA REDIRECCIONAR BIEN-->
                                           <li><a href="<?php echo FRONT_ROOT?>Home/viewCartelera">Cartelera</a></li>
                                           <?php if(isset($_SESSION['userLog'])) { ?>
                                                <li><a href="<?php echo FRONT_ROOT?>Home/viewEntradasAdquiridas">Entradas Adquiridas</a></li>
                                            <?php	} ?>
                                           <!-- <a href="destino.php?variable1=valor1&variable2=valor2">Mi enlace</a>-->
       
       
                                       </ul>
                                   </nav>
                               </div>
                           </div>     
                           
                   <?php if(!isset($_SESSION['userLog'])) { ?>
                           <div class="col-xl-2 col-lg-1 col-md-2">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>Home/viewLogin" class="btn header-btn">Iniciar Sesion</a>
                               </div>
                           </div>
                           <div class="col-xl-2 col-lg-1 col-md-2">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>Home/viewSignUp" class="btn header-btn">Registrarse</a>
                               </div>
                           </div>
                        <?php	} ?>
                        <?php if(isset($_SESSION['userLog'])) { ?>
                           <div class="col-xl-2 col-lg-1 col-md-2">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>User/logout" class="btn header-btn">Cerrar Sesion</a>
                               </div>
                           </div>
                        <?php	} ?>
                       </div>
                   </div>
               </div>
          </div>
           <main>
       
               <!-- Slider Area Start-->
               <div class="slider-area ">
                   <div class="slider-active">
                       <div class="single-slider slider-height d-flex align-items-center" >
                           <div class="container">
                               <div class="row d-flex align-items-center">
                                   <div class="col-lg-7 col-md-9 ">
                                       <div class="hero__caption">
                                           <h1 data-animation="fadeInLeft" data-delay=".4s">Movie Pass</h1>
                                           <p data-animation="fadeInLeft" data-delay=".6s">Bienvenido a MoviePass</p>
                                       </div>
                                   </div>
                                   <div class="col-lg-5">
                                       <div class="hero__img d-none d-lg-block" data-animation="fadeInRight" data-delay="1s">
                                           <img src="../Views/images/cineWall-e.jpg" alt="">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                 