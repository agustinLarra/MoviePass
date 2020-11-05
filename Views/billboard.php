<?php namespace Views;

    if(!isset($_SESSION)) session_start(); 
?>

<body>
   

<div class="header-area header-transparrent ">
       <div class="main-header header-sticky">
           <div class="container">
               <div class="row align-items-center" style="padding:20px;">
                   <!-- Logo -->
                   <div class="col-xl-3 col-lg-3 col-md-2">
                       <div class="logo">
                      MOVIEPASS
                       </div>
                   </div>
                   
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Home</a>
                        </div>
                    </div> 

                    <?php if(!isset($_SESSION['userLog'])) { ?>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Login</a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/viewSignUp" class="btn header-btn">Sign Up</a>
                        </div>
                    </div>
                    <?php	} ?>

                    <?php if(isset($_SESSION['userLog'])) { ?>
                    <div class="col-xl-3 col-lg-3 col-md-3">
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
                   <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>CARTELERA</h2>
                        </div>
                    </div>
                </div>

                        <
                        <div style="float:left;">
                               <!---------------------FILTRO POR FECHA------------------>             
                               <form action="<?=FRONT_ROOT?>Home/viewFechas" method="post">
                                    <h3>Seleccione Fecha</h3>
                                    <select name="Id_funcion">
                                        <?php foreach($lista_dias as $values)
                                        {?>
                                            <option value="<?=$values?>"><?=$values?></option>
                                        <?php } ?>
                                    </select>
                                    <br> <br>
                                    <div class="header-left-btn f-left d-none d-lg-block">
                                    <button type="submit" class="btn header-btn">Buscar</button>
                                    </div>
                                </form>
                        </div>            


                        <div style="float:right">     
                                <!---------------------FILTRO POR GENERO------------------>      
                               <form action="<?=FRONT_ROOT?>Home/viewGenero" method="post">
                                <h3>Seleccione Generos</h3>
                                <select name="Id_genero">
                                <?php foreach($arrayGeneros as $generos){?>

                                    <option value="<?=$generos->getID() . "-" .$generos->getTipo();?>"><?=$generos->getTipo()?></option>
                                    <?php } ?>
                                </select>
                                <br> <br>
                                <div class="header-left-btn f-left d-none d-lg-block">
                                   <button type="submit" class="btn header-btn">Buscar</button>
                               </div>
                                </form>
                            
                        </div>              
                             

                <div class="row">
               <?php if((isset($nombre))){ ?>       
                     <h3>Genero:<?=$nombre?><h/3>
                    <?php } ?>
                   
                        <?php foreach($array_peliculas as $values){ ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="single-do text-center mb-30">
                                    <form action="<?php echo FRONT_ROOT?>Home/Comprar" method="POST">
                                        <img class="col-lg-4 col-md-6"  src="<?php echo IMAGE_ROOT . $values->getPosterHorizontal();?>"  style="width:500px; weight:300px; position:relative;" />
                                        <div class="do-icon">
                                            <span  class="flaticon-tasks"></span>
                                        </div>
                                        <div class="do-caption">
                                            <h4><?= $values->getTitle();?></h4>
                                            <p>Fecha de Estreno: <?=$values->getReleaseDate();?></p>
                                            <p>Duracion: <?=$values->getRuntime();?> Minutos</p> 
                                        </div>

                                            <input name='id' value="<?php echo $values->getId();?>" type="hidden">
                                            <input name='title' value="<?php echo $values->getTitle();?>" type="hidden">
                                            
                                            <input name='overview' value="<?php echo $values->getOverview();?>" type="hidden">
                                             <!--   Hacer uno para duracion y otro para el trailer --> 
                                             
                                             <div class="do-btn" style="padding: 10px;">
                                            <!-- ACA VA EL BOTON DE ELIMINAR CAMBIARLO A COMPRAR   Admin/Comprar/  -->
                                            <button type="submit"class='btn btn-primary'>Comprar entrada</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                   
              
                </div>
                   
            </div>
        </div>


    </main>
