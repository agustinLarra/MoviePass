<?php namespace Views;


    if(!isset($_SESSION)) session_start(); 
?>

<body>
   
 <!-------------------------------------------------------# HEADER #---------------------------------------------------------------------------------------->

   <div class="header-area header-transparrent ">
       <div class="main-header header-sticky">
           <div class="container">
               <div class="row align-items-center">
                   <!-- Logo -->
                   <div class="col-xl-2 col-lg-2 col-md-1">
                       <div class="logo">
                       <!-- L    <a>MOVIEPASS</a> -->
                       </div>
                   </div>
               
             


    <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-do text-center mb-30">
                    <div class="do-icon">
                         <span  class="flaticon-tasks"></span>
                    </div>
                     <h3> Felicitaciones, su compra se registro correctamente! </h3>
                     <h5> Sus entradas se encuentran disponibles en el mail registrado en esta cuenta</h5>
                     <h5> Muchas gracias vuelva prontus!</h5>

                     <div class="col-xl-2 col-lg-2 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/viewCartelera" class="btn header-btn">Home</a>
                        </div>
                    </div>  
                </div>
            </div>
    </div>


    </main>
