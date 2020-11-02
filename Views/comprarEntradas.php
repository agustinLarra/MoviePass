<?php namespace Views;


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
                       <!-- L    <a>MOVIEPASS</a> -->
                       </div>
                   </div>
               
                </div> 
                   <div class="col-xl-2 col-lg-2 col-md-3">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>User/logout" class="btn header-btn">Home</a>
                               </div>
                           </div>   
                   <?php if(!isset($_SESSION['userLog'])) { ?>
                           <div class="col-xl-2 col-lg-2 col-md-3">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Login</a>
                               </div>
                           </div>
                           <div class="col-xl-2 col-lg-2 col-md-3">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>Home/viewSignUp" class="btn header-btn">Sign Up</a>
                               </div>
                           </div>
                        <?php	} ?>
                        <?php if(isset($_SESSION['userLog'])) { ?>
                           <div class="col-xl-2 col-lg-2 col-md-3">
                               <div class="header-right-btn f-right d-none d-lg-block">
                                   <a href="<?= FRONT_ROOT?>User/logout" class="btn header-btn">Logout</a>
                               </div>
                           </div>
                        <?php	} ?>
               </div>
           </div>
       </div>
   </div>
   <main> 

              


            <div class="what-we-do we-padding">
            <div class="container">


                    <div class="row">
                       <div class="col-lg-4 col-md-6">
                           <div class="single-do text-center mb-30">
                                   <img class="col-lg-4 col-md-6"  src="<?php echo IMAGE_ROOT . $pelicula->getPosterHorizontal();?>"  style="width:500px; weight:300px; position:relative;" />
                                   <div class="do-icon">
                                       <span  class="flaticon-tasks"></span>
                                   </div>
                                   <div class="do-caption">
                                       <h4><?= $pelicula->getTitle();?></h4>
                                       <!--<p>Release Date:         </p> --> 
                                   <!-- <p>Duration: <?php  //ACA DURACION ?></p> --> 
                                       <p>Descripcion: <?php echo   $pelicula->getOverview(); ?></p>
                                   </div>
                           </div>
                       </div>
                    </div>

                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de Funciones</h2>
                        </div>
                    </div>
                </div>

                                                                                            <!-- FUNCIONES -->
                <div class="row">
                <?php foreach($listaFunciones as $funcion){?>


                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <h4><?= $funcion->getDia();?></h4>
                                <h4><?= $funcion->getHora();?></h4>
                                <p>Pelicula:  <?= $funcion->getTitlePelicula();?></p>
                                <p>Cine:  <?= $funcion->getNombreCine();?></p>
                                <p>Sala:  <?= $funcion->getNombreSala();?></p>
                                <p>Descuento:  <?php  if($funcion->getDescuento() == 1){
                                                            echo PORCENTAJE_DESCUENTO;
                                                        }else{
                                                            echo "No";
                                                        }?></p>
                            </div>
                         


                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>

    </main>
