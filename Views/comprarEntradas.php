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
                        <p>MOVIEPASS</p>
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

              
 <!-------------------------------------------------------# PELICULA #---------------------------------------------------------------------------------------->


            <div class="what-we-do we-padding">
            <div class="container">


                    <div class="row">
                       <div class="col-lg-12 col-md-6">
                           <div class="single-do text-center mb-30">
                                <div class="div-imagen">
                                    <img class="col-lg-10 col-md-6"  src="<?php echo IMAGE_ROOT . $pelicula->getPosterHorizontal();?>"  style="width:90%; weight:90%; position:relative;" />
                                </div>
                                
                               

                                   <div class="do-caption">
                                       <h4  style="font-weight: bold; padding: 30px;"><?= $pelicula->getTitle();?></h4>
                                       <p  style="font-weight: bold;">Estreno: <?=$pelicula->getReleaseDate();?></p> 
                                       <p  style="font-weight: bold;">Duracion: <?php echo $pelicula->getRuntime(); ?> minutos</p>
                                       <p  style="font-weight: bold;">Descripcion: <?php echo   $pelicula->getOverview(); ?></p>
                                   </div>
                                   <iframe width="500" height="250" src="https://www.youtube.com/embed/<?=$pelicula->getVideo();?>"></iframe>
                           </div>
                       </div>
                    </div>

                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <h2>Lista de Funciones</h2>
                        </div>
                    </div>
                </div>

 <!-------------------------------------------------------# FUNCIONES #---------------------------------------------------------------------------------------->

<script>
    function selectCiudades(str){

    }
</script>



    <div class="row">
        <?php foreach($listaFunciones as $funcion){?>
        <form action="<?php echo FRONT_ROOT?>User/FuncionElegida" method="post">
            <div class="col-lg-12 col-md-6">
                <div class="single-do text-center mb-30">
                    <div class="do-icon">
                         <span  class="flaticon-tasks"></span>
                    </div>
                    <div class="do-caption">
                            <h4><?= $funcion->getDia();?></h4>
                            <h4><?= $funcion->getHora();?></h4>
                            <p>Ciudad:  <?= $funcion->getClassCine()->getCiudad();?></p>
                            <p>Cine:  <?= $funcion->getClassCine()->getNombre();?></p>
                            <p>Tipo de sala:  <?= $funcion->getClassSala()->getTipoSala();?></p>
                            <p>Precio:  <?= $funcion->getClassSala()->getPrecio();?></p>
                            <p>Descuento:  <?php  if($funcion->getDescuento() == 1){ echo PORCENTAJE_DESCUENTO;} else { echo "NO"; }?> </p>
                            
                            <div class="form-group">
                                    <p for="cantidadEntradas">Cantidad de entradas: </p>
                                    <input class="form-control" required name="cantidadEntradas" name="cantidadEntradas" id="cantidadEntradas" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder="Cuantas entradas quiere?" min="1" max="15" ">
                                    <input name='funcion' value="<?= $funcion->getId(); ?>" type="hidden">
                            </div>
                    </div>
                    <div class="do-btn">
                        <button type="submit"  class='btn btn-danger'> Comprar entradas </button>
                    </div>
                </div>
            </div>
            </form>    
        <?php } ?>
    </div>


    </main>
