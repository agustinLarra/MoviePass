


    <div class="header-area header-transparrent ">
       <div class="main-header header-sticky">
           <div class="container">
               <div class="row align-items-center" style="padding:20px;">
                   <!-- Logo -->
                   <div class="col-xl-3 col-lg-3 col-md-2">
                       <div class="logo">MOVIEPASS</div>
                   </div>
                   
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/Index" class="btn header-btn">Home</a>
                        </div>
                    </div> 

                    <?php if(!isset($_SESSION['userLog'])) { ?>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/viewLogin" class="btn header-btn">Login</a>
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





<br><br><br><br><br>
            <div class="container">
                <!-- Section-tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-tittle text-center">
                            <h2>Lista de entradas adquiridas</h2>
                        </div>
                    </div>
                </div>
                

                
                        <!---------------------FILTRO POR FECHA------------------>             
                        <form action="<?=FRONT_ROOT?>Home/viewFechasEntradas" method="post">
                            <h3>Seleccione Fecha</h3>
                            <select name="Id_fecha">
                                <?php foreach($fechas as $values)
                                {?>
                                    <option value="<?=$values?>"><?=$values?></option>
                                <?php } ?>
                            </select>
                            <br> <br>
                            <div class="header-left-btn f-left d-none d-lg-block">
                                <button type="submit" class="btn header-btn">Buscar</button>
                            </div>
                        </form>
                        <form action="<?php echo FRONT_ROOT?>Home/viewEntradasAdquiridas" method="post">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                 <button type="submit" class="btn header-btn">Todas las compras</button>
                            </div>
                        </form>
           <br><br><br><br><br><br>

                <div class="row">
                <?php foreach($listaDeDivs as $div){?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-do text-center mb-30">
                            <div class="do-icon">
                                <span  class="flaticon-tasks"></span>
                            </div>
                            <div class="do-caption">
                                <img class="col-lg-10 col-md-6"  src="<?php echo IMAGE_ROOT .  $div['PosterPath'];?>"  style="width:300px; weight:150px; position:relative;" />
                                <h4>Pelicula:  <?= $div['Title'];?></h4>
                                <p>Cine:  <?= $div['NombreCine'];?></p>
                                <p>Sala:  <?= $div['NombreSala'];?></p>
                                <p>Dia:  <?= $div['Dia']; ?></p>
                                <p>Hora:  <?= $div['Hora']; ?></p>
                                <p>Entradas compradas:  <?=  $div['EntradasAdquiridas'];?></p>
                                <p>Total:  <?= $div['Total'];?></p>    
                                
                                                      
                            </div>
                         
                        </div>
                    </div>
                    
                    <?php } ?>
                </div>

           <!-- </div>-->
    